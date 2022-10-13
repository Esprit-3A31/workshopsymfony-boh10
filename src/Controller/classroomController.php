<?php

namespace App\Controller;

use App\Entity\classroom;
use App\Form\classroomType;
use App\Repository\classroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class classroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'classroomController',
        ]);
    }

    #[Route('/addclassroom', name: 'add_classroom')]
    public function addclassroom(ManagerRegistry  $doctrine)
    {
        $classroom= new Classroom();
        $classroom->setid("123");
        $classroom->setname("ahmedmtibaa");
        $classroom->setnb_student("30");
        $em= $doctrine->getManager();
        $em->persist($classroom);
        $em->flush();
       
        return new Response("add classroom");
    }
    #[Route('/addclassroomForm', name: 'addclassroomForm')]
    public function addclassroomForm(Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= new  classroomt();
        $form= $this->createForm(classroomType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->persist($classroom);
             $em->flush();
             return  $this->redirectToRoute("addclassroomForm");
         }
        return $this->renderForm("classroom/add.html.twig",array("Formclassroom"=>$form));
    }

    #[Route('/updateclassroom/{nce}', name: 'update_classroom')]
    public function updateclassroomForm($id,classroomRepository  $repository,Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= $repository->find($id);
        $form= $this->createForm(classroomType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("addclassroomForm");
        }
        return $this->renderForm("classroom/update.html.twig",array("Formclassroom"=>$form));
    }

    #[Route('/removeclassroom/{id}', name: 'remove_classroom')]
    public function remove(ManagerRegistry $doctrine,$id,classroomRepository $repository)
    {
        $classroom= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("addSclassroomForm");
    }

    #[Route('/listclassroom', name: 'listclassroom')]
    public function listclassroom(classroomRepository  $repository)
    {
        $classroms= $repository->findAll();
        return $this->render("classroom/list.html.twig",array("tabclassroom"=>$classrooms));
    }
}
