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
        $listStreamers = [];

        for($i = 0; $i < count($list); $i++){
            $user = $userRepository->find($list[$i]);
            $listStreamers [] = $user;
        }

        if($username == 'usernameDesc'){
            usort($listStreamers, function($a, $b) {
                return $a->getUsername() <=> $b->getUsername();
            });
        }elseif($username == 'usernameAsc'){
            usort($listStreamers, function($a, $b) {
                return $b->getUsername() <=> $a->getUsername();
            });
        }
        return $listStreamers;
    }

}