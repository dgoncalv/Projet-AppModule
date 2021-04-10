<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Entity\Module;
use App\Entity\ModuleDetails;
use App\Entity\Semaine;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

class AppModulesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute('semestre', ['semester' => 1], 301);
    }

    /**
     * @param int $semester
     * @return Response
     * @Route("/semestre/{semester<[1-5]>}", name="semestre")
     */
    public function maquetteEnseignement(int $semester): Response
    {
        $semesterModules = $this->getDoctrine()->getRepository(Module::class)->findModulesOfASemester($semester);
        $semaineRepo = $this->getDoctrine()->getRepository(Semaine::class);

        $semesterWeeks = [];
        $week = (int)$this->getWeeks($semester)["firstWeek"];
        if ($semester % 2 != 0) {
            while ($week <= 52) {
                while ($UEModule = current($semesterModules)) {
                    $UE = key($semesterModules);
                    foreach ($UEModule as $module) {
                        $semesterWeeks[$UE][$week][$module['PPN']] = [];
                        $arr = $semaineRepo->findBy(['module' => $module, 'semaine' => $week]);
                        if (!empty($arr)) {
                            $semesterWeeks[$UE][$week][$module['PPN']]['CM'] = $arr[0]->getCM();
                            $semesterWeeks[$UE][$week][$module['PPN']]['TD'] = $arr[0]->getTD();
                            $semesterWeeks[$UE][$week][$module['PPN']]['TP'] = $arr[0]->getTP();
                            $semesterWeeks[$UE][$week][$module['PPN']]['EV'] = $arr[0]->getSurveillances();
                            for ($i = 1; $i < sizeof($arr); $i++) {
                                $semesterWeeks[$UE][$week][$module['PPN']]['CM'] += $arr[$i]->getCM();
                                $semesterWeeks[$UE][$week][$module['PPN']]['TD'] += $arr[$i]->getTD();
                                $semesterWeeks[$UE][$week][$module['PPN']]['TP'] += $arr[$i]->getTP();
                                $semesterWeeks[$UE][$week][$module['PPN']]['EV'] += $arr[$i]->getSurveillances();
                            }
                        }
                    }
                    next($semesterModules);
                }
                reset($semesterModules);
                $week++;
            }
            $week = 1;
        }
        while ($week <= (int)$this->getWeeks($semester)["lastWeek"]) {
            while ($UEModule = current($semesterModules)) {
                $UE = key($semesterModules);
                foreach ($UEModule as $module) {
                    $semesterWeeks[$UE][$week][$module['PPN']] = [];
                    $arr = $semaineRepo->findBy(['module' => $module, 'semaine' => $week]);
                    if (!empty($arr)) {
                        $semesterWeeks[$UE][$week][$module['PPN']]['CM'] = $arr[0]->getCM();
                        $semesterWeeks[$UE][$week][$module['PPN']]['TD'] = $arr[0]->getTD();
                        $semesterWeeks[$UE][$week][$module['PPN']]['TP'] = $arr[0]->getTP();
                        $semesterWeeks[$UE][$week][$module['PPN']]['EV'] = $arr[0]->getSurveillances();
                        for ($i = 1; $i < sizeof($arr); $i++) {
                            $semesterWeeks[$UE][$week][$module['PPN']]['CM'] += $arr[$i]->getCM();
                            $semesterWeeks[$UE][$week][$module['PPN']]['TD'] += $arr[$i]->getTD();
                            $semesterWeeks[$UE][$week][$module['PPN']]['TP'] += $arr[$i]->getTP();
                            $semesterWeeks[$UE][$week][$module['PPN']]['EV'] += $arr[$i]->getSurveillances();
                        }
                    }
                }
                next($semesterModules);
            }
            reset($semesterModules);
            $week++;
        }

        return $this->render('AppModules/MaquetteEnseignement.html.twig', [
            'semesterNumber' => $semester,
            'semesterModules' => $semesterModules,
            'semesterWeeks' => $semesterWeeks
        ]);
    }

    /**
     * @param string $ppn
     * @return Response
     * @Route("/module/{ppn}", name="module", requirements={"ppn"="^M\d{4}([A-Z]{3}){0,1}$"})
     */
    public function ficheModule(string $ppn): Response
    {
        // get the module
        $moduleRepo = $this->getDoctrine()->getRepository(Module::class);
        $module = $moduleRepo->findOneBy(['PPN' => $ppn]);

        // get the responsable
        $enseignantRepo = $this->getDoctrine()->getRepository(Enseignant::class);
        $responsables = $module->getResponsables();
        $moduleResponsables = [];
        foreach ($responsables as $responsable) {
            array_push($moduleResponsables, $enseignantRepo->find($responsable));
        }

        // get the teachers
        $moduleTeachers = $enseignantRepo->findTeachersOfAModule($module);

        $moduleWeeks = [];
        $week = (int)$this->getWeeks($ppn[1])["firstWeek"];
        if ($ppn[1] % 2 != 0) {
            while ($week <= 52) {
                $moduleWeeks[$week] = $this->getDataModule($ppn, $week);
                $week++;
            }
            $week = 1;
        }
        while ($week <= (int)$this->getWeeks($ppn[1])["lastWeek"]) {
            $moduleWeeks[$week] = $this->getDataModule($ppn, $week);
            $week++;
        }

        return $this->render('AppModules/FicheModule.html.twig', [
            'module' => $module,
            'moduleResponsables' => $moduleResponsables,
            'moduleTeachers' => $moduleTeachers,
            'moduleWeeks' => $moduleWeeks,
        ]);
    }

    /**
     * @param int $semester
     * @return array
     */
    public function getWeeks(int $semester): array
    {
        // TODO: Get the school calendar instead of the switch
        switch ($semester) {
            case 1:
            case 3:
                $semesterFirstDay = new DateTime("2019-09-02");
                $semesterLastDay = new DateTime("2020-01-26");
                break;
            case 2:
            case 4:
                $semesterFirstDay = new DateTime("2020-01-27");
                $semesterLastDay = new DateTime("2020-06-22");
                break;
            case 5:
                $semesterFirstDay = new DateTime("2019-09-02");
                $semesterLastDay = new DateTime("2020-06-22");
                break;
            default:
                $semesterFirstDay = $semesterLastDay = "";
                break;
        }
        return [
            "firstWeek" => $semesterFirstDay->format("W"),
            "lastWeek" => $semesterLastDay->format("W")
        ];
    }

    /**
     * @param string $ppn
     * @param int $week
     * @return array
     */
    public function getDataModule(string $ppn, int $week): array
    {
        $weekRepo = $this->getDoctrine()->getRepository(Semaine::class);
        $module = $this->getDoctrine()->getRepository(Module::class)->findOneBy(['PPN' => $ppn]);
        $moduleTeachers = $this->getDoctrine()->getRepository(Enseignant::class)->findTeachersOfAModule($module);
        $detailsRepo = $this->getDoctrine()->getRepository(ModuleDetails::class);

        $arrs = $weekRepo->findBy(['module' => $module, 'semaine' => $week]);
        $i = 0;

        $moduleWeeks = $this->initModuleWeeks($moduleTeachers);
        foreach ($arrs as $arr) {
            $moduleWeeks[$i]['CM']['Hours'] = $arr->getCM();
            $moduleWeeks[$i]['TD']['Hours'] = $arr->getTD();
            $moduleWeeks[$i]['TP']['Hours'] = $arr->getTP();
            foreach ($moduleTeachers['CM'] as $teacher) {
                $moduleWeeks[$i]['CM']['Details'][$teacher['trigramme']] =
                    $detailsRepo->findOneBy([
                        'semaine' => $arr,
                        'module' => $module,
                        'enseignant' => $teacher,
                        'typeCours' => 'CM'
                    ]);
            }
            foreach ($moduleTeachers['TD'] as $teacher) {
                $moduleWeeks[$i]['TD']['Details'][$teacher['trigramme']] =
                    $detailsRepo->findOneBy([
                        'semaine' => $arr,
                        'module' => $module,
                        'enseignant' => $teacher,
                        'typeCours' => 'TD'
                    ]);
            }
            foreach ($moduleTeachers['TP'] as $teacher) {
                $moduleWeeks[$i]['TP']['Details'][$teacher['trigramme']] =
                    $detailsRepo->findOneBy([
                        'semaine' => $arr,
                        'module' => $module,
                        'enseignant' => $teacher,
                        'typeCours' => 'TP'
                    ]);
            }
            $i++;
        }
        return $moduleWeeks;
    }

    /**
     * @param array $moduleTeachers
     * @return array
     */
    public function initModuleWeeks(array $moduleTeachers): array
    {
        $moduleWeeks[0]['CM']['Hours'] = $moduleWeeks[0]['TD']['Hours'] = $moduleWeeks[0]['TP']['Hours'] = 0;
        foreach ($moduleTeachers['CM'] as $teacher) {
            $moduleWeeks[0]['CM']['Details'][$teacher['trigramme']] = [];
        }
        foreach ($moduleTeachers['TD'] as $teacher) {
            $moduleWeeks[0]['TD']['Details'][$teacher['trigramme']] = [];
        }
        foreach ($moduleTeachers['TP'] as $teacher) {
            $moduleWeeks[0]['TP']['Details'][$teacher['trigramme']] = [];
        }
        return $moduleWeeks;
    }
}
