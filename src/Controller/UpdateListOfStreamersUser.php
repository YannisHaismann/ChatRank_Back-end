<?php

namespace App\Controller;

use App\Repository\UserRepository;
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
        $list = $user->getStreamers();

        if(count($list) >= 0) {
            for ($i = 0; $i < count($list); $i++) {
                if ($list[$i] == $id_streamer) {
                    unset($list[$i]);
                    $a_ajouter = false;
                    $entityManager = $this->getDoctrine()->getManager();
                    $user->setStreamers($list);
                    $entityManager->persist($user);
                    $entityManager->flush();
                }
            }
        }else {
            $list[] = $id_streamer;
            $entityManager = $this->getDoctrine()->getManager();
            $user->setStreamers($list);
            $entityManager->persist($user);
            $entityManager->flush();
        }
        if ($a_ajouter == true) {
            $list[] = $id_streamer;
            $entityManager = $this->getDoctrine()->getManager();
            $user->setStreamers($list);
            $entityManager->persist($user);
            $entityManager->flush();
        }

        $streamer = $userRepository->find(intval($id_streamer));
        $list1 = $streamer->getViewers();
        $a_ajouter = true;

        if(count($list1) >= 0) {
            for ($i = 0; $i < count($list1); $i++) {
                if ($list1[$i] == $id_user) {
                    unset($list1[$i]);
                    $a_ajouter = false;
                    $entityManager = $this->getDoctrine()->getManager();
                    $streamer->setViewers($list1);
                    $entityManager->persist($streamer);
                    $entityManager->flush();
                }
            }
        }else{
            $list1[] = $id_user;
            $entityManager = $this->getDoctrine()->getManager();
            $streamer->setViewers($list1);
            $entityManager->persist($streamer);
            $entityManager->flush();
        }
        if($a_ajouter == true) {
            $list1[] = $id_user;
            $entityManager = $this->getDoctrine()->getManager();
            $streamer->setViewers($list1);
            $entityManager->persist($streamer);
            $entityManager->flush();
        }
        return $user;
    }
}