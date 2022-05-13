<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ModifyPasswordController extends AbstractController
{
    public function __invoke(Request $request,
                             UserRepository $userRepository,
                             UserPasswordHasherInterface $userPasswordHasher,
                             EntityManagerInterface $entityManager){

        $id_user = $request->get('id');

        $new_password = $request->get('password');

        $user = $userRepository->find(intval($id_user));

        $password_hash = $userPasswordHasher->hashPassword(
            $user,
            $new_password
        );

        $user->setPassword($password_hash);
        $entityManager->persist($user);
        $entityManager->flush();

        return $user;
    }
}