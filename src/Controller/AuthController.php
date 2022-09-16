<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\UserDTO;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class AuthController extends AbstractController
{
    #[Route('/api/auth/signup', name: 'auth_signup', methods: ['POST'])]
    public function signup(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator,
        ManagerRegistry $doctrine
    ): Response {
        if ($request->get('password') !== $request->get('repeatedPassword')) {
            return new JsonResponse([
                'result' => 'error',
                'errors' => [
                    'password' => 'passwords arent equal'
                ],
            ]);
        }

        $userDto = new UserDTO($request->get('username'), $request->get('email'), $request->get('password'));
        $errors = $validator->validate($userDto);

        if ($errors->count() > 0) {
            $formatedViolationList = [];

            foreach ($errors as $violation) {
                $formatedViolationList[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return new JsonResponse(
                [
                    'result' => 'error',
                    'errors' => $formatedViolationList,
                ]
            );
        }

        try {
            $user = new User();
            $user->setIsActive(true)
                ->setUsername($userDto->getUsername())
                ->setEmail($userDto->getEmail())
                ->setPassword($passwordHasher->hashPassword(
                    $user,
                    $userDto->getPassword()
                ));

            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (Throwable $throwable) {
            return new JsonResponse([
                'result' => 'error',
                'errors' => [
                    'system' => 'Can`t create user, try different username.'
                ],
            ]);
        }

        return new JsonResponse(
            ['result' => 'success']
        );
    }
}
