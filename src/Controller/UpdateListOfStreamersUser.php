<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UpdateListOfStreamersUser extends AbstractController
{

    public function __invoke(Request $request, UserRepository $userRepository)
    {
        $id_user = $request->get('id_user');
        $id_streamer = $request->get('id_streamer');

        $user = $userRepository->find(intval($id_user));
        $list = $userRepository->listStreamersWithFilters($id_user, 'null');

        if($list != null) {
            for ($i = 0; $i < count($list[0]['streamers']); $i++) {
                if ($list[0]['streamers'][$i] == $id_streamer) {
                    $list -= $id_streamer;
                } else {
                    $list += $id_streamer;
                }
                $entityManager = $this->getDoctrine()->getManager();
                $user->setStreamers($list);
                $entityManager->persist($user);
                $entityManager->flush();
            }
        }else {
            $list += $id_streamer;
            $entityManager = $this->getDoctrine()->getManager();
            $user->setStreamers($list);
            $entityManager->persist($user);
            $entityManager->flush();
        }

        $streamer = $userRepository->find(intval($id_streamer));
        $list1 = $userRepository->listViewersWithFilters($id_streamer, 'null', null, null);

        if($list1 != null) {
            for ($i = 0; $i < count($list1[0]['viewers']); $i++) {
                if ($list1[0]['viewers'][$i] == $id_user) {
                    $list1 -= $id_user;
                } else {
                    $list1 += $id_user;
                }
                $entityManager = $this->getDoctrine()->getManager();
                $streamer->setViewers($list1);
                $entityManager->persist($streamer);
                $entityManager->flush();
            }
        }else{
            $list1 += $id_user;
            $entityManager = $this->getDoctrine()->getManager();
            $streamer->setViewers($list1);
            $entityManager->persist($streamer);
            $entityManager->flush();
        }
        return 'good';
    }

}