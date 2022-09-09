<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    #[Route('/api/boards', name: 'all_boards', methods: ['GET'])]
    public function getBoards(): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}', name: 'single_board', methods: ['GET'])]
    public function getBoard(int $boardId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards', name: 'add_board', methods: ['POST'])]
    public function addBoard(): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}', name: 'update_board', methods: ['PUT'])]
    public function updateBoard(int $boardId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}', name: 'delete_board', methods: ['DELETE'])]
    public function deleteBoard(int $boardId): Response
    {
        return new Response(
            'true'
        );
    }
}
