<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/api/auth/signup', name: 'auth_signup', methods: ['POST'])]
    public function signup(): Response
    {
        return new Response(
            'true'
        );
    }

    #[Route('/api/auth/signin', name: 'auth_signin', methods: ['POST'])]
    public function signin(): Response
    {
        return new Response(
            'true'
        );
    }
}
