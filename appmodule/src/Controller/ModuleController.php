<?php

namespace App\Controller;

use App\Entity\CSVFile;
use App\Entity\Module;
use App\Form\CSVFileType;
use App\Repository\EnseignantRepository;
use App\Repository\ModuleRepository;
use App\Service\FileUploader;
use Exception;
use Hoa\Protocol\Bin\Resolve;
use SplFileObject;
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
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class ModuleController extends AbstractController
{
    /**
     * @Route("/import_modules", name="import_modules")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param KernelInterface $kernel
     * @return Response
     * @throws Exception
     */
    public function import(Request $request, FileUploader $fileUploader, KernelInterface $kernel): Response
    {
        $file = new CSVFile();
        $name = "modules";
        $form = $this->createForm(CSVFileType::class, [$file,$name]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileCSV = $form->get('csvFile')->getData();

            if ($fileCSV) {
                $fileUploader->upload($fileCSV);
            }
            $application = new Application($kernel);
            $application->setAutoExit(false);

            $input = new ArrayInput(array('command' => 'csv:import:modules'));
            $output = new BufferedOutput();
            $application->run($input, $output);

            var_dump($output->fetch());

            return $this->redirectToRoute('semestre', ['semester' => 1], 301);
        }

        return $this->render('Request/UploadModule.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Rest\View()
     * @Rest\Get ("/api/modules", name="api_liste_modules")
     * @param ModuleRepository $repository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function listeModule(ModuleRepository $repository, SerializerInterface $serializer): Response
    {
        $modules = $repository->findAll(); // concat nom and prenom

        $modulesSerialized = $serializer->serialize($modules, 'csv', ['no_headers' => 'true',
                                                                            'groups' => 'module:read']);
        $headers = "module(PPN) ; module(GPU) intitulé\n";

        $modulesCSV = $headers . str_replace(["\"", ","], ["", " ; "], $modulesSerialized);

        return new Response($modulesCSV, 200, ["Content-Type" => "text/csv"]);
    }

    /**
     * @Rest\View()
     * @Rest\Get ("/api/modules/{PPN}", name="api_get_module")
     * @param Request $request
     * @param ModuleRepository $repository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function getModule(Request $request, ModuleRepository $repository, SerializerInterface $serializer): Response
    {
        $module = $repository->findOneBy(['PPN' => $request->get('PPN')]);

        $moduleSerialized = $serializer->serialize($module, 'csv', ['no_headers' => 'true',
                                                                            'groups' => 'module:read']);
        $headers = "module(PPN) ; module(GPU) intitulé\n";

        $moduleCSV = $headers . str_replace(["\"", ","], ["", " ; "], $moduleSerialized);

        return new Response($moduleCSV, 200, ["Content-Type" => "text/csv"]);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/api/modules", name="api_post_modules")
     * @param Request $request
     * @param ModuleRepository $repository
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function addModules(
        Request $request,
        ModuleRepository $repository,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = $request->getContent();
        $dataTab = explode("\r\n", $data);

        $header = "module(PPN) ; module(GPU) intitulé";
        $comment = '#';

        $ignored = $updated = $created = $conflicted = 0;
        $conflicts = [];

        for ($i = 0; $i < sizeof($dataTab); $i++) {
            if ($dataTab[$i] != "" and !(str_contains($dataTab[$i], $header)) and $dataTab[$i][0] != $comment) {
                $moduleTab = explode(';', $dataTab[$i]);

                $module = new Module();
                $module->setPPN(str_replace(' ', '', $moduleTab[0]));
                $module->setIntitule(substr($moduleTab[1], 1, strlen($moduleTab[1]) - 1));

                $errors = $validator->validate($module);
                if (count($errors) > 0) {
                    if (preg_match("/^M\d{4}([A-Z]{3}){0,1}$/", $module->getPPN())) {
                        $moduleIN = $repository->findOneBy(['PPN' => $module->getPPN()]);
                        if ($module->getIntitule() != "") {
                            if ($moduleIN->getIntitule() != $module->getIntitule()) {
                                $repository->update($moduleIN, $module->getIntitule());
                                $updated++;
                            } else {
                                $ignored++;
                            }
                        } else {
                            $conflicts["ligne " . $i] = "Le module " .
                                                        $module->getPPN() .
                                                        " ne peut être créé car l'intitulé est vide.";
                            $conflicted++;
                        }
                    } else {
                        $conflicts["ligne " . $i] = "Le module " .
                                                    $module->getPPN() .
                                                    " ne peut être créé car le format du PPN n'est pas respecté : 
                                                    M[0-9]{4}([A-Z]{3})? (e.g. M5017DMO)";
                        $conflicted++;
                    }
                } else {
                    $repository->save($module);
                    $created++;
                }
            }
        }
        $informations['created'] = $created . " module(s) créé(s).";
        $informations['updated'] = $updated . " module(s) mis à jour.";
        $informations['ignored'] = $ignored . " module(s) déjà existant(s) avec des valeurs identiques.";
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
     * @Rest\Post("/api/responsables", name="api_post_responsables")
     * @param Request $request
     * @param ModuleRepository $repositoryModule
     * @param EnseignantRepository $repositoryEnseignant
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function addResponsables(Request $request, ModuleRepository $repositoryModule, EnseignantRepository $repositoryEnseignant, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getContent();
        $dataTab = explode("\r\n", $data);

        $header = "module(PPN) ; responsables";
        $comment = '#';

        $conflicted = $updated = 0;
        $conflicts = [];

        // Parcours du tableau de données fourni
        for ($i = 0; $i < sizeof($dataTab); $i++) {
            if ($dataTab[$i] != "" and !(str_contains($dataTab[$i], $header)) and  $dataTab[$i][0] != $comment) {
                // Cas où la chaine n'est ni vide, ni une entête ni un commentaire
                $responsablesTab = explode(";", $dataTab[$i]);

                if (sizeof($responsablesTab) != 2) {
                    // Cas où le point-virgule ne sépare pas deux éléments
                    $conflicted++;
                    $ligne = $i + 1;
                    $conflicts["Ligne " . $ligne] = "Ligne invalide (un argument manquant).";
                } else {
                    $module = $repositoryModule->findOneBy(['PPN' => str_replace(' ', '', $responsablesTab[0])]);
                    if ($module == null) {
                        // Cas où le module n'existe pas dans la BD
                        $conflicted++;
                        $ligne = $i + 1;
                        $conflicts["Ligne " . $ligne] = $responsablesTab[0] . " n'est pas un module enregistré.";
                    } else {
                        $responsables = explode(" ", $responsablesTab[1]);
                        // Parcours des trigrammes dans le cas où plusieurs responsables sont affectés
                        for ($trigramme = 0; $trigramme < sizeof($responsables); $trigramme++) {
                            if ($responsables[$trigramme] != "") {
                                // Cas où le trigramme n'est pas vide
                                $enseignant = $repositoryEnseignant->findOneBy(['trigramme' => $responsables[$trigramme]]);
                                if ($enseignant == null) {
                                    // Cas où le trigramme n'existe pas dans la BD
                                    $conflicted++;
                                    $ligne = $i + 1;
                                    $conflicts["Ligne " . $ligne] = $responsables[$trigramme] . " n'est pas un enseignant enregistré.";
                                } else {
                                    $module->addResponsable($enseignant);
                                    $updated++;
                                }
                            } elseif ($trigramme != 0 or sizeof($responsables) < 2) {
                                // Cas où il n'y a pas de trigramme après le point-virgule
                                $conflicted++;
                                $ligne = $i + 1;
                                $conflicts["Ligne " . $ligne] = "Pas d'enseignant renseigné.";
                            }
                        }
                        $repositoryModule->updateResponsable($module);
                    }
                }
            }
        }

        // Gestion de l'affichage des informations lors de la réponse
        $informations['updated'] = $updated . " module(s) mis à jour.";
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
     * @Rest\Get("/api/responsables", name="api_get_responsables")
     * @param ModuleRepository $repository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function listeResponsables(ModuleRepository $repository, SerializerInterface $serializer): Response
    {
        $modules = $repository->findAll();
        $modulesSerialized = $serializer->serialize($modules, 'csv', ['no_headers' => 'true','groups' => 'responsables:list']);

        // Création de tableaux permettant de preg_replace $modulesSerialized
        $pattern = ["/0,/","/1,/","/2,/","/3,/","/4,/","/5,/","/6,/","/7,/","/8,/","/9,/"];
        $replacement = ["0 ; ","1 ; ","2 ; ","3 ; ","4 ; ","5 ; ","6 ; ","7 ; ","8 ; ","9 ; "];

        // Remplacement de la première virgule (",") de chaque ligne par " ; "
        $moduleCSVIntermediaire = preg_replace($pattern, $replacement, $modulesSerialized);

        $headers = "module(PPN) ; responsables\n";

        // Replacement des virgules entre les trigrammes par des espaces
        $moduleCSV = $headers . str_replace([","], [" "], $moduleCSVIntermediaire);

        return new Response($moduleCSV, 200, ["Content-Type" => "text/csv"]);
    }
}
