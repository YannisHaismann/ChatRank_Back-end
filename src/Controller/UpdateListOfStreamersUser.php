<?php

namespace App\Controller;

use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UpdateListOfStreamersUser extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $id_user = $request->get('id');
        $id_streamer = $request->get('id_streamer');
        $a_ajouter = true;

        $user = $userRepository->find(intval($id_user));
        $list = $userRepository->listStreamersWithFilters($id_user, 'null');

        if(count($list[0]['streamers']) >= 0) {
            for ($i = 0; $i < count($list[0]['streamers']); $i++) {
                if ($list[0]['streamers'][$i] == $id_streamer) {
                    unset($list[0]['streamers'][$i]);
                    $a_ajouter = false;
                    $entityManager = $this->getDoctrine()->getManager();
                    $user->setStreamers($list[0]['streamers']);
                    $entityManager->persist($user);
                    $entityManager->flush();
                }
            }
        }else {
            $list[0]['streamers'][] = $id_streamer;
            $entityManager = $this->getDoctrine()->getManager();
            $user->setStreamers($list[0]['streamers']);
            $entityManager->persist($user);
            $entityManager->flush();
        }
        if ($a_ajouter == true) {
            $list[0]['streamers'][] = $id_streamer;
            $entityManager = $this->getDoctrine()->getManager();
            $user->setStreamers($list[0]['streamers']);
            $entityManager->persist($user);
            $entityManager->flush();
        }

        $streamer = $userRepository->find(intval($id_streamer));
        $list1 = $userRepository->listViewersWithFilters($id_streamer, 'null', 'null', 'null');
        $a_ajouter = true;

        if(count($list1[0]['viewers']) >= 0) {
            for ($i = 0; $i < count($list1[0]['viewers']); $i++) {
                if ($list1[0]['viewers'][$i] == $id_user) {
                    unset($list1[0]['viewers'][$i]);
                    $a_ajouter = false;
                    $entityManager = $this->getDoctrine()->getManager();
                    $streamer->setViewers($list1[0]['viewers']);
                    $entityManager->persist($streamer);
                    $entityManager->flush();
                }
            }
        }else{
            $list1[0]['viewers'][] = $id_user;
            $entityManager = $this->getDoctrine()->getManager();
            $streamer->setViewers($list1[0]['viewers']);
            $entityManager->persist($streamer);
            $entityManager->flush();
        }
        if($a_ajouter == true) {
            $list1[0]['viewers'][] = $id_user;
            $entityManager = $this->getDoctrine()->getManager();
            $streamer->setViewers($list1[0]['viewers']);
            $entityManager->persist($streamer);
            $entityManager->flush();
        }
        return $user;
    }
}