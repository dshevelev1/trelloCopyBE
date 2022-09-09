<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ColumnController extends AbstractController
{
    #[Route('/api/boards/{boardId}/columns', name: 'all_columns', methods: ['GET'])]
    public function getColumns(int $boardId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}', name: 'single_column', methods: ['GET'])]
    public function getColumn(int $boardId, int $columnId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}/columns/{columnId}', name: 'update_column', methods: ['PUT'])]
    public function updateColumn(int $boardId, int $columnId): Response
    {
        return new Response(
            'true'
        );
    }
}
