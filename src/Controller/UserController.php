<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'all_users', methods: ['GET'])]
    public function getUsers(): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/users/{userId}', name: 'get_user', methods: ['GET'])]
    public function getSingleUser(int $userId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/users/{userId}', name: 'update_user', methods: ['PUT'])]
    public function updateSingleUser(int $userId): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/users/{userId}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteSingleUser(int $userId): Response
    {
        return new Response(
            'true'
        );
    }
}
