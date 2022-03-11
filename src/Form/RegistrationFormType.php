<?php

namespace App\Form;

use App\Entity\Sex;
use App\Entity\Type;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('urlProfileImg', FileType::class, [
                //'label' => false,
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'image', 'accept' => ".png,.jpg,.jpeg"],
            ])
            ->add('firstname', TextType::class, [
                //'label' => false,
            ])
            ->add('lastname', TextType::class, [
                //'label' => false,
            ])
            ->add('username', TextType::class, [
                //'label' => false,
            ])
            ->add('email', TextType::class, [
                //'label' => false,
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                //'label' => false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
                //'label' => false,
            ])
            ->add('dateOfBirthday', DateType::class, [
                //'label' => false,
                'widget' => 'single_text'

            ])
            ->add('type', EntityType::class, [
                //'label' => false,
                'class' => Type::class,
                'choice_label' => 'name',
            ])
            ->add('sex', EntityType::class, [
                //'label' => false,
                'class' => Sex::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
