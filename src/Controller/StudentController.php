<?php

namespace App\Controller;

use App\Repository\ClassRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository ;
use App\Form\StudentType;
use App\Entity\Student;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/student', name: 'app_student')]
    public function liststudent(StudentRepository $repository)
    {
      $students=$repository->findAll();
      $topStudents=$repository->topStudent();
      $sortByNce = $repository->sortByNCE() ;
      return $this-> render ("student/student.html.twig",array('tabstudents'=>$students,'nce'=>$sortByNce,'top'=>$topStudents));
    }
    #[Route('/addStudentForm', name: 'addStudentForm')]
    public function addStudentForm(Request  $request,ManagerRegistry $doctrine)
    {
        $student= new  Student();
        $form= $this->createForm(StudentType::class,$student);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->persist($student);
             $em->flush();
             return  $this->redirectToRoute("addStudentForm");
         }
        return $this->renderForm("student/add.html.twig",array("FormStudent"=>$form));
    }


#[Route('/showClassroom/{id}', name: 'show_classroom')]
public function showClassroom(ClassRoomRepository $repository, StudentRepository $repo,$id)
{
    $classroom = $repository->find($id);
    $students = $repo->getStudentByClassroom($id);
    return $this->render('Student/showClassroom.html.twig', array('classroom' => $classroom, 'tabstudents' => $students));


}}