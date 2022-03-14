<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\StudentRepository;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Student;

class StudentController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/student/new', name: 'student_new_form')]
    public function newForm()
    {
        $template = 'student/new.html.twig';
        $args = [
        ];
        return $this->render($template, $args);
    }

    #[Route('/student/processNewForm', name: 'student_process_new_form')]
    public function processNewForm(Request $request)
    {
        // extract name values from POST data
        $firstName = $request->request->get('firstName');
        $surname = $request->request->get('surname');

        // forward this to the createAction() method
        return $this->create($firstName, $surname);
    }

    #[Route('/student', name: 'student_list')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $studentRepository = $doctrine->getRepository(Student::class);
        $students = $studentRepository->findAll();

        $template = 'student/list.html.twig';
        $args = [
            'students' => $students
        ];
        return $this->render($template, $args);
    }

    #[Route('/student/{id}', name: 'student_show')]
    public function show(Student $student): Response
    {
        $template = 'student/show.html.twig';
        $args = [
            'student' => $student
        ];

        if (!$student) {
            $template = 'error/404.html.twig';
        }
        return $this->render($template, $args);
    }

//    #[Route('/student/create/{firstName}/{surname}', name: 'student_create')]
//        $student = new Student();
//        $student->setFirstName($firstName);
//        $student->setSurname($surname);
//
//        $em = $doctrine->getManager();
//
//        // tells Doctrine you want to (eventually) save the Product (no queries yet)
//        $em->persist($student);
//
//        // actually executes the queries (i.e. the INSERT query)
//        $em->flush();
//
//        return $this->redirectToRoute('student_show', [
//            'id' => $student->getId()
//        ]);

//        return new Response('Created new student with id '.$student->getId());

    public function create(string $firstName, string $surname): Response
    {
        $student = new Student();
        $student->setFirstName($firstName);
        $student->setSurname($surname);
        $em = $this->doctrine->getManager();
        $em->persist($student);
        $em->flush();

        return $this->redirectToRoute('student_list');
    }

    #[Route('/student/delete/{id}', name: 'student_delete')]
    public function delete(Student $student, ManagerRegistry $doctrine)
    {
        // store ID so can report it later
        $id = $student->getId();

        // tells Doctrine you want to (eventually) delete the Student (no queries yet)
        $em = $doctrine->getManager();
        $em->remove($student);

        // actually executes the queries (i.e. the DELETE query)
        $em->flush();

        return new Response('Deleted student with id '.$id);
    }

    #[Route('/student/update/{id}/{newFirstName}/{newSurname}', name: 'student_update')]
    public function update(Student $student, string $newFirstName, string $newSurname, ManagerRegistry $doctrine)
    {
        $student->setFirstName($newFirstName);
        $student->setSurname($newSurname);

        $em = $doctrine->getManager();
        $em->flush();

        return $this->redirectToRoute('student_show', [
            'id' => $student->getId()
        ]);
    }

}
