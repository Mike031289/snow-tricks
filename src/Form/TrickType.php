<?php

namespace App\Form;

use App\Entity\Trick;
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
            ->add('image', CollectionType::class, [
                'label' => 'Fichiers de l\'image',
                'entry_type' => FileType::class,
                'entry_options' => [
                    'attr' => ['class' => 'form-control mb-3'],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'mapped' => false,
            ])
            ->add('videoUrl', CollectionType::class, [
                'label' => 'Lien de la vidéo',
                'entry_type' => TextType::class,
                'entry_options' => [
                    'attr' => ['class' => 'form-control mb-3'],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'mapped' => false,
            ])
            // ->add('image', FileType::class, [
            //     'label'    => 'Fichiers de l\'image',
            //     'required' => false,
            //     'mapped'   => false,
            //     'multiple' => true,
            // ])
            
            // ->add('videoUrl', TextType::class, [
            //     'label'    => 'Lien de la video',
            //     'required' => false,
            //     'mapped'   => false,
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
