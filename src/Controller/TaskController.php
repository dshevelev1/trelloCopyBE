<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\TaskDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks', name: 'all_tasks', methods: ['GET'])]
    public function getTasks(int $boardId, int $columnId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks/{taskId}', name: 'single_task', methods: ['GET'])]
    public function getTask(int $boardId, int $columnId, int $taskId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}/tasks', name: 'single_task', methods: ['POST'])]
    public function addTask(int $boardId, int $columnId, Request $request): Response
    {
        $task = new TaskDTO($request->get('name'), $columnId, $request->get('description'));
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
