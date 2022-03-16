<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserByUsernameController extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository): ?User
    {
        $username = $request->get('username');

        return $user = $userRepository->findOneBy(["username" => $username]);
    }
}