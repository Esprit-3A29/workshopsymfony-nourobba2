<?php

namespace App\Controller;

use App\Form\StudentType;
use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{

    #[Route('/students', name: 'app_student')]

    public function ListEtudiant(StudentRepository $repository)
    {
        $students = $repository->findAll();
        return $this->render("etudiant/listEtudiant.html.twig", array("tabStudent" => $students));
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
