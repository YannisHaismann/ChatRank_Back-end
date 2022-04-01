<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\SexRepository;
use App\Repository\TypeRepository;
use App\Repository\UserRepository;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use function PHPUnit\Framework\isEmpty;


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
        $errorList = [];

        if($request->get('password') != null) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $request->get('password')
                )
            );
        }else {
            $errorList [] = "error password cannot be null";
        }

        $picture = $request->files->get('file');
        if ($picture != null) {
            $user->setFile($request->files->get('file'));
        } else {
            $fichier = 'default-profile-picture.jpg';
            $user->setUrlProfileImg($fichier);
        }

        $phoneNumber = $request->get('phoneNumber');
        if($phoneNumber != null) {
            $checkPhoneNumber = $userRepository->findOneBy(["phone_number" => $phoneNumber]);
            if ($checkPhoneNumber == null) {
                $user->setPhoneNumber($phoneNumber);
            } else {
                $errorList [] = 'existing phone number error';
            }
        }

        if($request->get('email') != null){
            $email = $request->get('email');
            $checkEmail = $userRepository->findOneBy(["email" => $email]);
            if($checkEmail == null){
                $user->setEmail($email);
            }else{
                $errorList [] = 'existing email error';
            }
        }else{
            $errorList [] = "error email cannot be null";
        }

        if($request->get('firstname') != null){
            $user->setFirstname($request->get('firstname'));
        }else{
            $errorList [] = "error firstname cannot be null";
        }

        if($request->get('lastname') != null){
            $user->setLastname($request->get('lastname'));
        }else{
            $errorList [] = "error lastname cannot be null";
        }

        if($request->get('username') != null){
            $username = $request->get('username');
            $checkUsername = $userRepository->findOneBy(["username" => $username]);
            if($checkUsername == null){
                $user->setUsername($username);
            }else{
                $errorList [] = 'existing username error';
            }
        }else{
            $errorList [] = "error username cannot be null";
        }

        $type = $request->get('type');
        if($type != null) {
            $type = $typeRepository->find((int)$request->get('type'));
            $user->setType($type);
            if($type->getId() == 1){
                $user->setRoles(["ROLE_VIEWER"]);
            }else{
                $user->setRoles(["ROLE_STREAMER"]);
            }
        } else {
            $errorList [] = "error type cannot be null";
        }

        if($request->get('sex') != null){
            $sex = $sexRepository->find((int)$request->get('sex'));
            $user->setSex($sex);
        }else{
            $errorList [] = "error sex cannot be null";
        }

        if($request->get('dateOfBirthday') != null){
            $dateBirthday = new \DateTime($request->get('dateOfBirthday'));
            $user->setDateOfBirthday($dateBirthday);
        }else{
            $errorList [] = "error dateOfBirthday cannot be null";
        }

        $dateUpdate = new \DateTime('now');

        if($errorList != null){
            return new JsonResponse($errorList);
        }

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
