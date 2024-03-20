<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre prénom']),
                ],
            ])
            ->add('lastName', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre nom de famille']),
                ],
            ])
            ->add('userName', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre nom d\'utilisateur']),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre adresse email']),
                ],
            ])
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre mot de passe']),
                ],
            ])
            ->add('passwordConfirm', PasswordType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez confirmer votre mot de passe']),
                ],
            ])
            ->add('userPicture', FileType::class, [
                'label'       => 'Photo de profil',
                'mapped'      => false, // Since you handle file upload separately
                'required'    => true,
                'constraints' => [
                    new File([
                        'maxSize'          => '1024k',
                        'mimeTypes'        => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Seuls les fichiers de type: PNG, JPG, JPEG sont acceptés',
                    ]),
                    new NotBlank([
                        'message' => 'Veuillez importer votre photo de profil',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
