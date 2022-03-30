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
        $username = $request->get('filter');

        $user = $userRepository->find(intval($id));
        $list = $user->getStreamers();
        $listViewers = [];

        for($i = 0; $i < count($list); $i++){
            $user = $userRepository->find($list[$i]);
            $listViewers [] = $user;
        }

        if($username == 'usernameDesc'){
            usort($listViewers, function($a, $b) {
                return $a->getUsername() <=> $b->getUsername();
            });
        }elseif($username == 'usernameAsc'){
            usort($listViewers, function($a, $b) {
                return $b->getUsername() <=> $a->getUsername();
            });
        }
        return $listViewers;
    }

}