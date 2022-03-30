<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ListOfViewersUser extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $id = $request->get('id');
        $filter = $request->get('filter');

        $user = $userRepository->find(intval($id));
        $list = $user->getViewers();
        $listViewers = [];

        for($i = 0; $i < count($list); $i++){
            $user = $userRepository->find($list[$i]);
            $listViewers[] = $user;
        }

        switch ($filter){
            case 'usernameAsc':
                usort($listViewers, function($a, $b) {
                    return $b->getUsername() <=> $a->getUsername();
                });
                break;
            case 'usernameDesc':
                usort($listViewers, function($a, $b) {
                return $a->getUsername() <=> $b->getUsername();
            });
                break;
            case 'dateAsc':
                usort($listViewers, function($a, $b) {
                    return $b->getDateOfUpdate() <=> $a->getDateOfUpdate();
                });
                break;
            case 'dateDesc':
                usort($listViewers, function($a, $b) {
                    return $a->getDateOfUpdate() <=> $b->getDateOfUpdate();
                });
                break;
            case 'typeAsc':
                usort($listViewers, function($a, $b) {
                    return $b->getType()->getId() <=> $a->getType()->getId();
                });
                break;
            case 'typeDesc':
                usort($listViewers, function($a, $b) {
                    return $a->getType()->getId() <=> $b->getType()->getId();
                });
                break;
        }
        return $listViewers;
    }

}