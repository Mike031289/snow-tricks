<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Picture;
use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('category', EntityType::class, [
                'class'        => 'App\Entity\Category',
                'choice_label' => 'name',
            ])
            ->add('pictures', CollectionType::class, [
                'entry_type'    => FileType::class, // Pour les liens
                'entry_options' => [
                    'label' => false,
                    'attr'  => [
                        'placeholder' => 'Entrez un lien URL ou un code embed',
                    ],
                ],
                'label'         => 'Fichier de l\'image',
                'required'      => false,
                'allow_add'     => true,
                'allow_delete'  => true,
            ])
            ->add('videos', CollectionType::class, [
                'entry_type'    => TextType::class, // Pour les liens
                'entry_options' => [
                    'label' => false,
                    'attr'  => [
                        'placeholder' => 'Entrez un lien URL ou un code embed',
                    ],
                ],
                'label' => 'URL de la vidéo',
                'required' => false,
                'allow_add'     => true,
                'allow_delete'  => true,
            ])
            // ->add('medias', CollectionType::class, [
            //     'entry_type'    => TextType::class, // Pour les liens
            //     'entry_options' => [
            //         'label' => false,
            //         'attr'  => [
            //             'placeholder' => 'Entrez un lien URL ou un code embed',
            //         ],
            //     ],
            //     'allow_add'     => true,
            //     'allow_delete'  => true,
            //     'required'      => false,
            //     'label'         => 'Médias du trick',
            // ])
            // Ajoutez le champ pour les médias
            // ->add('medias', CollectionType::class, [
            //     'entry_type'    => MediaType::class, // Utilisez le MediaType pour ajouter des images ou des vidéos
            //     'entry_options' => ['label' => false], // Masquez le label pour chaque champ média
            //     'allow_add'     => true, // Autorise l'ajout dynamique de nouveaux champs média
            //     'allow_delete'  => true, // Autorise la suppression de champs média existants
            //     'by_reference'  => false, // Oblige à utiliser le setter pour chaque média
            // ])
            // ->add('pictures', CollectionType::class, [
            //     'entry_type'    => FileType::class, // Pour les liens
            //     'entry_options' => [
            //         'label' => false,
            //         'attr'  => [
            //             'placeholder' => 'Télécharger les images de la figure',
            //         ],
            //     ],
            //     'allow_add'     => true,
            //     'allow_delete'  => true,
            //     'required'      => false,
            //     'label'         => 'Images du trick',
            // ])
            // ->add('videos', CollectionType::class, [
            //     'entry_type'    => TextType::class, // Pour les liens
            //     'entry_options' => [
            //         'label' => false,
            //         'attr'  => [
            //             'placeholder' => 'Entrez un lien URL ou un code embed',
            //         ],
            //     ],
            //     'allow_add'     => true,
            //     'allow_delete'  => true,
            //     'required'      => false,
            //     'label'         => 'Vidéos du trick',
            // ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
