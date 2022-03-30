<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CountOfViewersUser extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $id = $request->get('id');

        $user = $userRepository->find(intval($id));
        $list = $user->getViewers();
        return count($list);
    }

}