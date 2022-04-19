<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController
{
    #[Route(path: "/apip/login", name: 'api_login', methods: ['POST'])]
    public function login()
    {

    }

    #[Route(path: "apip/logout", name: 'api_logout', methods: ['POST'])]
    public function logout()
    {

    }
}