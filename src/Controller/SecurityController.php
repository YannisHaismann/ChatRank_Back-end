<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController
{
    #[Route(path: "/apip/login", name: 'api_login', methods: ['POST'])]
    public function login()
    {
        $user = $this->getUser();
        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'password' => $user->getPassword(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'username' => $user->getUsername(),
            "date_of_birthday" => $user->getDateOfBirthday(),
            "url_profile_img" => $user->getUrlProfileImg(),
            "phone_number" => $user->getPhoneNumber(),
            "type" => $user->getType()->getName(),
            "sex" => $user->getSex()->getName(),
            "viewers" => $user->getViewers(),
            "streamers" => $user->getStreamers(),
            "date_of_update" => $user->getDateOfUpdate(),
        ]);
    }

    #[Route(path: "apip/logout", name: 'api_logout', methods: ['POST'])]
    public function logout()
    {

    }
}
