<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\SexRepository;
use App\Repository\TypeRepository;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class RegistrationController extends AbstractController
{

    /**
     * @throws \Exception
     */
    public function __invoke(Request                    $request, UserPasswordHasherInterface $userPasswordHasher,
                             UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator,
                             EntityManagerInterface     $entityManager, TypeRepository $typeRepository, SexRepository $sexRepository): Response
    {
        $user = new User();

        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $request->get('password')
            )
        );

        $picture = $request->files->get('file');
        if ($picture != null) {
            $user->setFile($request->files->get('file'));
        } else {
            $fichier = 'default-profile-picture.jpg';
            $user->setUrlProfileImg($fichier);
        }

        $user->setEmail($request->get('email'));
        $user->setFirstname($request->get('firstname'));
        $user->setLastname($request->get('lastname'));
        $user->setUsername($request->get('username'));
        $type = $typeRepository->find((int)$request->get('type'));
        $user->setType($type);
        $sex = $sexRepository->find((int)$request->get('sex'));
        $user->setSex($sex);
        $dateBirthday = new \DateTime($request->get('dateOfBirthday'));
        $user->setDateOfBirthday($dateBirthday);
        $user->setPhoneNumber($request->get('phoneNumber'));
        $dateUpdate = new \DateTime('now');
        $user->setDateOfUpdate($dateUpdate);
        $entityManager->persist($user);
        $entityManager->flush();

        return $userAuthenticator->authenticateUser(
            $user,
            $authenticator,
            $request
        );
    }
}
