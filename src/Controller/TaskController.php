<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\TaskDTO;
use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class TaskController extends AbstractController
{
    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks', name: 'all_tasks', methods: ['GET'])]
    public function getTasks(int $boardId, int $columnId, ManagerRegistry $doctrine): Response
    {
        $tasks = $doctrine->getRepository(Task::class)->findByBoardAndStatus($boardId, $columnId);
        $formattedTasks = array_map(function (Task $task) {
            return [
              'id' => $task->getId(),
              'name' => $task->getName(),
              'description' => $task->getDescription(),
              'status' => $task->getStatus(),
            ];
        }, $tasks);

        return new JsonResponse([
            'result' => 'success',
            'tasks' => $formattedTasks,
        ]);
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks/{taskId}', name: 'single_task', methods: ['GET'])]
    public function getTask(int $boardId, int $columnId, int $taskId): Response
    {
        return new Response('true');
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks', name: 'single_task', methods: ['POST'])]
    public function addTask(
        int $boardId,
        int $columnId,
        Request $request,
        ValidatorInterface $validator,
        ManagerRegistry $doctrine
    ): Response {
        $taskDto = new TaskDTO(
            $request->get('name'),
            (int)$request->get('status'),
            $request->get('description'),
        );
        $errors = $validator->validate($taskDto);

        if ($errors->count() > 0) {
            return new JsonResponse([
                'result' => 'error',
                'errors' => $errors
            ]);
        }

        try {
            $task = new Task();
            $task->setName($taskDto->getName());
            $task->setDescription($taskDto->getDescription());
            $task->setStatus($taskDto->getStatusId());
            $task->setBoardId($boardId);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
        } catch (Throwable $throwable) {
            return new JsonResponse([
                'result' => 'error',
                'errors' => [
                    'exception occured ' . $throwable->getMessage()
                ]
            ]);
        }

        return new JsonResponse([
            'result' => 'success'
        ]);
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks/{taskId}', name: 'update_task', methods: ['PUT'])]
    public function updateTask(int $boardId, int $columnId, int $taskId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks/{taskId}', name: 'delete_task', methods: ['DELETE'])]
    public function deleteTask(int $boardId, int $columnId, int $taskId): Response
    {
        return new Response(
            'true'
        );
    }
}
