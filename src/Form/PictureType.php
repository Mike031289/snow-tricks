<?php

namespace App\Form;

use App\Entity\Picture;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom de l\'image',
            ])
            ->add('path', FileType::class, [
                'label' => 'Fichier de l\'image',
                'required' => false,
            ])
            ->add('trick', CollectionType::class, [
                'class'        => 'App\Entity\Trick',
                'choice_label' => 'name',
            ])
        ;
            // ->add('name', TextType::class)
            // ->add('path', CollectionType::class, [
            //     'label'    => 'Image',
            //     'mapped'   => true, // Ne doit pas être mappé à l'entité Media
            //     'required' => false, // Facultatif
            // ])
            // ->add('imageFile', FileType::class, [
            //     'label'    => 'Image',
            //     'required' => false,
            //     'mapped'   => false, // Pour ne pas mapper ce champ à une propriété de l'entité
            //     'attr'     => [
            //         'accept' => 'image/*', // Accepter uniquement les fichiers images
            //     ],
            // ])
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
