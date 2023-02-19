<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/liste-des-taches')]
class TaskController extends AbstractController
{
        
        
    #[Route('/', name: 'app_task_index', methods: ['GET', 'POST'])]
    public function index(Request $request, TaskRepository $taskRepository): Response
    {
        // if ($request->isMethod('POST')) {
        //     $taskIds = $request->request->get('tasks');

        //     if (!empty($taskIds)) {
        //         $entityManager = $this->getDoctrine()->getManager();
        //         $taskIds = implode(',', $taskIds);
        
        //         $tasks = $taskRepository->createQueryBuilder('t')
        //             ->where('t.id IN (:taskIds)')
        //             ->setParameter('taskIds', $taskIds)
        //             ->getQuery()
        //             ->getResult();

        //         foreach ($tasks as $task) {
            //             $entityManager->remove($task);
            //         }
            
            //         $entityManager->flush();
        //     }

        //     return $this->render('app_task_index');
        // }
        
        
        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findAll(),
        ]);
    }

    #[Route('/nouvelle', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TaskRepository $taskRepository): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskRepository->save($task, true);
            
            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskRepository->save($task, true);

            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    
    #[Route('/{id}', name: 'app_task_done', methods: ['POST'])]
    public function done(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        
        
        $user = $this->getUser();
        $lastName = $user->getName();
        $task->setMadeBy($lastName);
        //     // $taskRepository->setMadeBy($lastName);
        $taskRepository->save($task, true);
        
        $this->addFlash('success', 'La tâche est bien enregistrée comme terminée.');
        return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/effacer/{id}', name: 'app_task_delete', methods: ['POST'])]
    public function delete(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $taskRepository->remove($task, true);
        }
        
        return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    }

    
    }

    
    // if ($this->isCsrfTokenValid('done' . $task->getId(), $request->request->get('_token'))) {
        //     $user = $this->getUser();
        //     $lastName = $user->getName();
        //     $task->setMadeBy($lastName);
        //     // $taskRepository->setMadeBy($lastName);
        //     $taskRepository->save($task, true);
        // }
        // return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        
        

        // #[Route('/{id}/supprimer', name: 'app_task_delete_all', methods: ['POST'])]
        // public function deleteAll($ids, Request $request, Task $task, EntityManagerInterface $entityManager, TaskRepository $taskRepository)
        
    // {
    //     $taskIds []= $request->request->get('tasks');
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         if (!is_array($taskIds)) {
    //             $this->addFlash('warning', 'Veuillez sélectionner des tâches à supprimer.');
    //             return $this->redirectToRoute('app_task_index');
    //         }

    //         $tasks = $entityManager->getRepository(Task::class)->findBy(['id' => $taskIds]);

    //         foreach ($tasks as $task) {
        //             $entityManager->remove($task);
    //         }

    //         $entityManager->flush();
    
    //         $this->addFlash('success', count($tasks) . ' tâches ont été supprimées.');

    //         return $this->redirectToRoute('app_task_index');
    //     }

    //     return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    // }
    
    

    
    






    // $taskIds = $request->request->get('tasks');
    // if ($form->isSubmitted() && $form->isValid()) {
        //     if (!is_array($taskIds)) {
            //         $this->addFlash('warning', 'Veuillez sélectionner des tâches à supprimer.');
            //         return $this->redirectToRoute('app_task_index');
            //     }

            //     $tasks = $entityManager->getRepository(Task::class)->findBy(['id' => $taskIds]);

    //     foreach ($tasks as $task) {
    //         $entityManager->remove($task);
    //     }

    //     $entityManager->flush();
    
    //     $this->addFlash('success', count($tasks) . ' tâches ont été supprimées.');

    //     return $this->redirectToRoute('app_task_index');
    // }

    //     return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    // }



    


    //     public function deleteAll($ids)
    // {
    //     $entityManager = $this->getEntityManager();
    //     $queryBuilder = $entityManager->createQueryBuilder();

    //     $queryBuilder->delete(Task::class, 't')
    //         ->where($queryBuilder->expr()->in('t.id', $ids));
    
    //     $query = $queryBuilder->getQuery();
    //     $query->execute();
    // }

    