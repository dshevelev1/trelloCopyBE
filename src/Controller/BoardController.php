<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\BoardDTO;
use App\Entity\Board;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class BoardController extends AbstractController
{
    #[Route('/api/boards', name: 'all_boards', methods: ['GET'])]
    public function getBoards(ManagerRegistry $doctrine): Response
    {
        $boards = $doctrine->getRepository(Board::class)->findAll();
        $boardsFormatted = array_map(function (Board $board) {
            return [
                'id' => $board->getId(),
                'name' => $board->getName(),
                'description' => $board->getDescription()
            ];
        }, $boards);

        return new JsonResponse([
            'result' => 'success',
            'boards' => $boardsFormatted
        ]);
    }

    #[Route('/api/boards/{boardId}', name: 'single_board', methods: ['GET'])]
    public function getBoard(int $boardId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards', name: 'add_board', methods: ['POST'])]
    public function addBoard(
        Request $request,
        ValidatorInterface $validator,
        ManagerRegistry $doctrine
    ): Response {
        $boardDto = new BoardDTO($request->get('name'), $request->get('description'));

        $errors = $validator->validate($boardDto);

        if ($errors->count() > 0) {
            return new JsonResponse([
               'result' => 'error',
               'errors' => $errors
            ]);
        }

        try {
            $board = new Board();
            $board->setName($boardDto->getName());
            $board->setDescription($boardDto->getDescription());

            $em = $doctrine->getManager();
            $em->persist($board);
            $em->flush();
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

    #[Route('/api/boards/{boardId}', name: 'update_board', methods: ['PUT'])]
    public function updateBoard(int $boardId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/boards/{boardId}', name: 'delete_board', methods: ['DELETE'])]
    public function deleteBoard(int $boardId, ManagerRegistry $doctrine): Response
    {
        try {
            $board = $doctrine->getRepository(Board::class)->find($boardId);

            if ($board !== null) {
                $entityManager = $doctrine->getManager();
                $entityManager->remove($board);
                $entityManager->flush();

                return new JsonResponse([
                    'result' => 'success'
                ]);
            }
        } catch (Throwable $throwable) {
            return new JsonResponse([
                'result' => 'error',
                'error' => $throwable->getMessage()
            ]);
        }

        return new JsonResponse([
            'result' => 'error',
            'error' => 'Not found'
        ]);
    }
}
