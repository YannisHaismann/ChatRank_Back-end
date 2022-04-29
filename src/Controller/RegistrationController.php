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

        $password = $request->get('password');
        $this->verify_password($user, $userPasswordHasher, $password, $errorList);

        $picture = $request->files->get('file');
        $this->verify_picture($picture, $user);

        $phoneNumber = $request->get('phoneNumber');
        $this->verify_phone_number($user, $phoneNumber, $userRepository, $errorList);

        $email = $request->get('email');
        $this->verify_email($email, $user, $userRepository, $errorList);

        $firstname = $request->get('firstname');
        $this->verify_firstname($user, $firstname, $errorList);

        $lastname = $request->get('lastname');
        $this->verify_lastname($user, $lastname, $errorList);

        $username = $request->get('username');
        $this->verify_username($user, $username, $userRepository, $errorList);

        $type = $request->get('type');
        $this->verify_type($user, $type, $typeRepository, $request, $errorList);

        $sex = $request->get('sex');
        $this->verify_sex($user, $sex, $sexRepository, $request, $errorList);

        $dateBirthday = $request->get('dateOfBirthday');
        $this->verify_dateBirthday($user, $dateBirthday, $request, $errorList);

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

    public function valid_phone_number ( $phone ): bool
    {
        $filtered_phone_number = filter_var ( $phone, FILTER_SANITIZE_NUMBER_INT ) ;

        $phone_to_check = str_replace ( "-" , "" , $filtered_phone_number ) ;

        if( strlen ( $phone_to_check ) < 10 || strlen ( $phone_to_check ) > 14 ){
            return false ;
        }else{
            return true ;
        }
    }

    private function verify_password($user, $userPasswordHasher, $password, &$errorList)
    {
        if($password != null){
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $password
                )
            );
        }else{
            $errorList [] = "error password cannot be null";
        }
    }

    private function verify_phone_number($user, mixed $phoneNumber, UserRepository $userRepository, array &$errorList)
    {
        if($phoneNumber != null){
            if($this->valid_phone_number($phoneNumber) == true){
                $checkPhoneNumber = $userRepository->findOneBy(["phone_number" => $phoneNumber]);
                if ($checkPhoneNumber == null){
                    $user->setPhoneNumber($phoneNumber);
                } else{
                    $errorList [] = 'existing phone number error';
                }
            }else{
                $errorList [] = "invalid phone number error";
            }
        }
    }

    private function verify_picture(mixed $picture, User $user)
    {
        if($picture != null){
            $user->setFile($picture);
        }else{
            $fichier = 'default-profile-picture.jpg';
            $user->setUrlProfileImg($fichier);
        }
    }

    private function verify_email(mixed $email, $user, UserRepository $userRepository, array &$errorList)
    {
        if($email != null){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $checkEmail = $userRepository->findOneBy(["email" => $email]);
                if($checkEmail == null){
                    $user->setEmail($email);
                }else{
                    $errorList [] = 'existing email error';
                }
            }else{
                $errorList [] = "invalid email error";
            }
        }else{
            $errorList [] = "error email cannot be null";
        }
    }

    private function verify_firstname(User $user, mixed $firstname, array &$errorList)
    {
        if($firstname != null){
            $user->setFirstname($firstname);
        }
    }

    private function verify_lastname(User $user, mixed $lastname, array &$errorList)
    {
        if($lastname != null){
            $user->setLastname($lastname);
        }
    }

    private function verify_username(User $user, mixed $username, UserRepository $userRepository, array &$errorList)
    {
        if($username != null){
            $checkUsername = $userRepository->findOneBy(["username" => $username]);
            if($checkUsername == null){
                $user->setUsername($username);
            }else{
                $errorList [] = 'existing username error';
            }
        }else{
            $errorList [] = "error username cannot be null";
        }
    }

    private function verify_type(User $user, mixed $type, TypeRepository $typeRepository, $request, array $errorList)
    {
        if($type != null){
            $type = $typeRepository->find((int)$request->get('type'));
            $user->setType($type);
            if($type->getId() == 1){
                $user->setRoles(["ROLE_VIEWER"]);
            }else{
                $user->setRoles(["ROLE_STREAMER"]);
            }
        }else{
            $errorList [] = "error type cannot be null";
        }
    }

    private function verify_sex(User $user, mixed $sex, SexRepository $sexRepository, Request $request, array &$errorList)
    {
        if($sex != null){
            $sex = $sexRepository->find((int)$request->get('sex'));
            $user->setSex($sex);
        }
    }

    /**
     * @throws \Exception
     */
    private function verify_dateBirthday(User $user, mixed $dateBirthday, Request $request, array &$errorList)
    {
        if($dateBirthday != null){
            $dateBirthday = new \DateTime($dateBirthday);
            $user->setDateOfBirthday($dateBirthday);
        }
    }
}
