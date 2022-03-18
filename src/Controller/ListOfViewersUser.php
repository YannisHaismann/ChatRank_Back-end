<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use function Sodium\add;

class ListOfViewersUser extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $id = $request->get('id');
        $username = $request->get('username');
        $date = $request->get('date');
        $type = $request->get('type');

        $list = $userRepository->listViewersWithFilters($id, $username, $date, $type);
        $listViewers = [];

        for($i = 0; $i < count($list[0]['viewers']); $i++){
            $user = $userRepository->find($list[0]['viewers'][$i]);
            $listViewers[] += $user;
        }
        return $listViewers;
    }

}