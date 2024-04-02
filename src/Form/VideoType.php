<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la vidéo',
            ])
            ->add('url', TextType::class, [
                'label' => 'URL de la vidéo',
            ])
            ->add('trick', EntityType::class, [
                'class' => 'App\Entity\Trick',
                'choice_label' => 'name',
            ])
        ;
            // ->add('videos', CollectionType::class, [
            //     'label' => 'vidéo',
            //     'mapped' => true, // Ne doit pas être mappé à l'entité Media
            //     'required' => false, // Facultatif
            // ])
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
