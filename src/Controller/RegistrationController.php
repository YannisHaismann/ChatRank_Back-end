<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\SexRepository;
use App\Repository\TypeRepository;
use App\Repository\UserRepository;
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
    public function __invoke(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator,
                             AppAuthenticator $authenticator, EntityManagerInterface $entityManager, TypeRepository $typeRepository, SexRepository $sexRepository,
                             UserRepository $userRepository ): Response
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

        $email = $request->get('email');
        $checkEmail = $userRepository->findOneBy(["email" => $email]);
        if($checkEmail == null){
            $user->setEmail($email);
        }else{
            return new Response(content: 'invalid email');
        }

        $user->setFirstname($request->get('firstname'));
        $user->setLastname($request->get('lastname'));

        $username = $request->get('username');
        $checkUsername = $userRepository->findOneBy(["username" => $username]);
        if($checkUsername == null){
            $user->setUsername($username);
        }else{
            return new Response(content: 'invalid username');
        }

        $type = $typeRepository->find((int)$request->get('type'));
        $user->setType($type);

        if((int)$request->get('type') == 1){
            $user->setRoles(["ROLE_VIEWER"]);
        }else{
            $user->setRoles(["ROLE_STREAMER"]);
        }

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
