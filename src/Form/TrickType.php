<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\Media;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer un nom pour le trick']),
                ],
            ])
            ->add('description', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer une description pour le trick']),
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner un groupe',
                'required' => true,
                'multiple' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner un groupe']),
                ],
            ])
            ->add('picture', EntityType::class, [
                'class' => Media::class,
                'choice_label' => 'name', // Assurez-vous d'avoir un champ 'name' dans l'entité Media pour afficher dans la liste déroulante
                'placeholder' => 'Sélectionner une image',
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner une image']),
                ],
            ])
            ->add('video', EntityType::class, [
                'class' => Media::class,
                'choice_label' => 'name', // Assurez-vous d'avoir un champ 'name' dans l'entité Media pour afficher dans la liste déroulante
                'placeholder' => 'Sélectionner une vidéo',
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner une vidéo']),
                ],
            ])
            ->add('newPicture', FileType::class, [
                'label' => 'Nouvelle image du trick',
                'help' => 'ajoutez une nouvelle image de la figure',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (format accepté : image/*)',
                    ]),
                ],
            ])
            ->add('newVideo', FileType::class, [
                'label' => 'Nouvelle vidéo du trick',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                        'mimeTypes' => [
                            'video/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une vidéo valide (format accepté : video/*)',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
