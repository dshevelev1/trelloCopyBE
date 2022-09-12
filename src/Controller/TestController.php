<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'alsdsds', methods: ['GET'])]
    public function test(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user->setUsername('test1');
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            'test1'
        );
        $user->setPassword($hashedPassword);
        $user->setEmail('test1@test.ru');
        $user->setIsActive(true);
        $em = $doctrine->getManager();
        $em->persist($user);
        $em->flush();
        return new Response('hi');
    }
}
