<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FindUsersStreamerController extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $username = $request->get('filter');

        return $listUsersStreamer [] = $userRepository->findAllUsersStreamer($username);
    }
}