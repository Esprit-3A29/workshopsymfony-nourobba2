<?php

namespace App\Controller;

use App\Form\StudentType;
use App\Entity\Student;
use App\Form\SearchformType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends AbstractController
{

    #[Route('/students', name: 'app_student')]

    public function ListEtudiant(Request $request, StudentRepository $repository)
    {
        $students = $repository->findAll();
        $sortByMoyenne = $repository->sortByMoyenne();
        $formSearch = $this->createForm(SearchformType::class);
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted()) {
            $ref = $formSearch->get('ref')->getData();
            //var_dump($nce).die();
            $result = $repository->searchStudent($ref);
            return $this->renderForm(
                "etudiant/listEtudiant.html.twig",
                array(
                    "tabStudent" => $result,
                    "sortByMoyenne" => $sortByMoyenne,
                    "searchForm" => $formSearch
                )
            );
        }
        return $this->renderForm(
            "etudiant/listEtudiant.html.twig",
            array(
                "tabStudent" => $students,
                "sortByMoyenne" => $sortByMoyenne,
                "searchForm" => $formSearch
            )
        );
    }

    #[Route('/addStudent2', name: 'addStudent2')]
    public function addStudent2(StudentRepository $repository, Request $request)
    {
        $student = new Student;
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $repository->add($student, true);
            return $this->redirectToRoute("app_student");
        }
        return $this->renderForm("etudiant/add2.html.twig", array("Studentform" => $form));
    }
}
