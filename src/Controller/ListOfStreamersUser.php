<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ListOfStreamersUser extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $id = $request->get('id');
        $username = $request->get('username');

        $list = $userRepository->listStreamersWithFilters($id, $username);
        $listViewers = [];

        for($i = 0; $i < count($list[0]['streamers']); $i++){
            $user = $userRepository->find($list[0]['streamers'][$i]);
            $listViewers[] += $user;
        }
        return $listViewers;
    }

}