<?php

namespace App\Controller;

use App\Entity\CSVFile;
use App\Entity\Enseignant;
use App\Form\CSVFileType;
use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use App\Service\FileUploader;
use Exception;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class EnseignantController
 * @package App\Controller
 */
class EnseignantController extends AbstractController
{
    /**
     * @Route("/enseignants", name="enseignants_list")
     * @param EnseignantRepository $repository
     * @return Response
     */
    public function listEnseignants(EnseignantRepository $repository)
    {
        $enseignants = $repository->findAllTeachersByStatus();

        return $this->render('Enseignant/ListeEnseignants.html.twig', [
            'enseignants' => $enseignants
        ]);
    }

    /**
     * @Route("/enseignants/add", name="enseignants_add")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param KernelInterface $kernel
     * @return Response
     * @throws Exception
     */
    public function addEnseignants(Request $request, FileUploader $fileUploader, KernelInterface $kernel, EnseignantRepository $repository): Response
    {
        $file = new CSVFile();
        $name = "enseignants";
        $CSVForm = $this->createForm(CSVFileType::class, [$file,$name]);
        $CSVForm->handleRequest($request);
        if ($CSVForm->isSubmitted() && $CSVForm->isValid()) {
            $fileCSV = $CSVForm->get('csvFile')->getData();

            if ($fileCSV) {
                $fileUploader->upload($fileCSV);
            }
            $application = new Application($kernel);
            $application->setAutoExit(false);

            $input = new ArrayInput(array('command' => 'csv:import:enseignants'));
            $output = new BufferedOutput();
            $application->run($input, $output);

            var_dump($output->fetch());

            return $this->redirectToRoute('semestre', ['semester' => 1], 301);
        }

        $enseignant = new Enseignant();
        $enseignantForm = $this->createForm(EnseignantType::class, $enseignant);
        $enseignantForm->handleRequest($request);
        if ($enseignantForm->isSubmitted()) {
            if ($enseignantForm->isValid()) {
                $repository->save($enseignant);
                $this->addFlash('add_enseignant_success', 'Succès : l\'enseignant a bien été ajouté !');

                return $this->redirectToRoute('semestre', ['semester' => 1], 301);
            } else {
                $this->addFlash('add_enseignant_fail', 'Echec : l\'enseignant n\'a pas pu être ajouté !');
            }
        }

        return $this->render('Request/UploadEnseignant.html.twig', [
            'CSVForm' => $CSVForm->createView(),
            'enseignantForm' => $enseignantForm->createView(),
        ]);
    }

    /**
     * @Route("/enseignants/{trigramme}", name="enseignant")
     */
    public function ficheEnseignant(string $trigramme, EnseignantRepository $repository): Response
    {
        $enseignant = $repository->findOneBy(['trigramme' => $trigramme]);

        return $this->render('Enseignant/FicheEnseignant.html.twig', [
            'enseignant' => $enseignant
        ]);
    }

    /**
     * @Route("/enseignants/{trigramme}/edit", name="enseignant_edit")
     */
    public function editEnseignant(Request $request, string $trigramme, EnseignantRepository $repository): Response
    {
        $enseignant = $repository->findOneBy(['trigramme' => $trigramme]);

        $enseignantUpdate = new Enseignant();

        $enseignantForm = $this->createForm(EnseignantType::class, $enseignant);
        $enseignantForm->handleRequest($request);
        if ($enseignantForm->isSubmitted()) {
            if ($enseignantForm->isValid()) {
                $repository->update($enseignant, $enseignant->getServiceDu(), $enseignant->getStatut(), $enseignant->getContact());
                $this->addFlash('add_enseignant_success', 'Succès : l\'enseignant a bien été modifié !');

                return $this->redirectToRoute('enseignant', ['trigramme' => $trigramme], 301);
            } else {
                $this->addFlash('add_enseignant_fail', 'Echec : l\'enseignant n\'a pas pu être modifié !');
            }
        }

        return $this->render('Enseignant/EditEnseignant.html.twig', [
            'enseignant' => $enseignant,
            'enseignantForm' => $enseignantForm->createView(),
        ]);
    }

    /**
     * @Rest\View()
     * @Rest\Get ("/api/enseignants", name="api_liste_enseignants")
     * @param EnseignantRepository $repository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function getEnseignants(EnseignantRepository $repository, SerializerInterface $serializer): Response
    {
        $enseignants = $repository->findAllForCSV(); // concat nom and prenom

        $enseignantsSerialized = $serializer->serialize($enseignants, 'csv', ['no_headers' => 'true']);
        $headers = "trigramme ; Prénom Nom ; service dû ; statut ; contact\n";

        $enseignantsCSV = $headers . str_replace(
            [";  ;", "; \n"],
            [";;", ";\n"],
            str_replace(["\"", ","], ["", " ; "], $enseignantsSerialized)
        );

        return new Response($enseignantsCSV, 200, ["Content-Type" => "text/csv"]);
    }

    /**
     * @Rest\View()
     * @Rest\Get ("/api/enseignants/{trigramme}", name="api_get_enseignant")
     * @param Request $request
     * @param EnseignantRepository $repository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function getEnseignant(
        Request $request,
        EnseignantRepository $repository,
        SerializerInterface $serializer
    ): Response {
        $enseignant = $repository->findOneByTrigrammeForCSV($request->get('trigramme'));

        $enseignantSerialized = $serializer->serialize($enseignant, 'csv', ['no_headers' => 'true']);
        $headers = "trigramme ; Prénom Nom ; service dû ; statut ; contact\n";

        $enseignantCSV = $headers . str_replace(
            [";  ;", "; \n"],
            [";;", ";\n"],
            str_replace(["\"", ","], ["", " ; "], $enseignantSerialized)
        );

        return new Response($enseignantCSV, 200, ["Content-Type" => "text/csv"]);
    }

    /**
     * @Rest\View()
     * @Rest\Post ("/api/enseignants", name="api_post_enseignants")
     * @param Request $request
     * @param EnseignantRepository $repository
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function postEnseignants(Request $request, EnseignantRepository $repository, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $data = $request->getContent();
        $dataTab = explode("\r\n", $data);

        $header = "trigramme ; Prénom Nom ; service dû ; statut ; contact";
        $comment = "#";

        $ignored = 0;
        $conflicted = 0;
        $conflicts = [];
        $updated = 0;
        $created = 0;

        for ($i = 0; $i < sizeof($dataTab); $i++) {
            if ($dataTab[$i] != "" and !(str_contains($dataTab[$i], $header)) and $dataTab[$i][0] != $comment) {
                $enseignantTab = explode(';', $dataTab[$i]);

                if (sizeof($enseignantTab) != 5) {
                    $conflicts["ligne " . $i] = "5 valeurs attendues mais " . sizeof($enseignantTab) . " valeurs lues";
                } else {
                    $enseignant = new Enseignant();
                    $enseignant->setTrigramme(str_replace(' ', '', $enseignantTab[0]));
                    if (sizeof(explode(' ', $enseignantTab[1])) == 4) {
                        $enseignant->setPrenom(explode(' ', $enseignantTab[1])[1]);
                        $enseignant->setNom(explode(' ', $enseignantTab[1])[2]);
                    } else {
                        $enseignant->setPrenom("");
                        $enseignant->setNom("");
                    }
                    $enseignant->setServiceDu(floatval($enseignantTab[2]));
                    $enseignant->setStatut(str_replace(' ', '', $enseignantTab[3]));
                    $enseignant->setContact(str_replace(' ', '', $enseignantTab[4]));

                    $errors = $validator->validate($enseignant);
                    if (count($errors) > 0) {
                        if (strlen($enseignant->getTrigramme()) >= 3 and strlen($enseignant->getTrigramme()) <= 4) {
                            if ($enseignant->getPrenom() != "" and $enseignant->getNom() != "") {
                                $enseignantIN = $repository->findOneBy(['trigramme' => $enseignant->getTrigramme()]);
                                if ($enseignantIN != null) {
                                    if (
                                        $enseignantIN->getPrenom() == $enseignant->getPrenom()
                                        and $enseignantIN->getNom() == $enseignant->getNom()
                                    ) {
                                        if (
                                            $enseignantIN->getServiceDu() != $enseignant->getServiceDu()
                                            or $enseignantIN->getStatut() != $enseignant->getStatut()
                                            or $enseignantIN->getContact() != $enseignant->getContact()
                                        ) {
                                            $repository->update(
                                                $enseignantIN,
                                                $enseignant->getServiceDu(),
                                                $enseignant->getStatut(),
                                                $enseignant->getContact()
                                            );
                                            $updated++;
                                        } else {
                                            $ignored++;
                                        }
                                    } else {
                                        $conflicts["ligne " . $i] = '[' .
                                            $enseignant->getTrigramme() .
                                            '] ' .
                                            $enseignant->getPrenom() .
                                            ' ' .
                                            $enseignant->getNom() .
                                            " ne peut être créé car il existe déjà 
                                            un enseignant portant ce trigramme : " .
                                            $enseignantIN->getPrenom() .
                                            ' ' . $enseignantIN->getNom() . '.';
                                        $conflicted++;
                                    }
                                } else {
                                    $enseignantIN = $repository->findOneBy(["prenom" => $enseignant->getPrenom(),
                                                                            "nom" => $enseignant->getNom()]);
                                    $conflicts["ligne " . $i] = '[' .
                                        $enseignant->getTrigramme() . '] ' .
                                        $enseignant->getPrenom() . ' ' . $enseignant->getNom() .
                                        " ne peut être créé car il existe déjà sous un autre trigramme : " .
                                        $enseignantIN->getTrigramme() . '.';
                                    $conflicted++;
                                }
                            } else {
                                $conflicts["ligne " . $i] = '[' .
                                    $enseignant->getTrigramme() . '] ' .
                                    $enseignant->getPrenom() . ' ' .
                                    $enseignant->getNom() .
                                    " ne peut être créé car le prénom et le nom ne peuvent être vide.";
                                $conflicted++;
                            }
                        } else {
                            $conflicts["ligne " . $i] = '[' . $enseignant->getTrigramme() . '] ' .
                                $enseignant->getPrenom() . ' ' .
                                $enseignant->getNom() .
                                " ne peut être créé car son trigramme doit avoir une longueur entre 3 et 4.";
                            $conflicted++;
                        }
                    } else {
                        $repository->save($enseignant);
                        $created++;
                    }
                }
            }
        }
        $informations['created'] = $created . " enseignant(s) créé(s).";
        $informations['updated'] = $updated . " enseignant(s) mis à jour.";
        $informations['ignored'] = $ignored . " enseignant(s) déjà existant(s) avec des valeurs identiques.";
        $informations['conflicted'][0] = $conflicted . " lignes rencontrant des conflits :";
        $informations['conflicted'][1] = $conflicts;

        return new JsonResponse(
            $serializer->serialize($informations, 'json'),
            Response::HTTP_CREATED,
            [],
            true
        );
    }

    /**
     * @Rest\View()
     * @Rest\Delete ("/api/enseignants/{trigramme}", name="api_delete_enseignant")
     * @param Request $request
     * @param EnseignantRepository $repository
     */
    public function deleteEnseignant(Request $request, EnseignantRepository $repository): Response
    {
        $enseignant = $repository->findOneBy(['trigramme' => $request->get('trigramme')]);

        if ($enseignant == null) {
            return new Response("Aucun enseignant trouvé sous le trigramme renseigné", Response::HTTP_BAD_REQUEST);
        }
        $repository->delete($enseignant);

        return new Response("L'enseignant a bien été supprimé", 200, ["Content-Type" => "text/csv"]);
    }
}
