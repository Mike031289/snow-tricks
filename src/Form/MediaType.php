<?php

namespace App\Form;

use App\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('trick', EntityType::class, [
                'class' => 'App\Entity\Trick',
                'choice_label' => 'name',
            ])
            ->add('picture', CollectionType::class, [
                'label' => 'Image',
                'mapped' => true, // Ne doit pas être mappé à l'entité Media
                'required' => false, // Facultatif
            ])
            ->add('video', CollectionType::class, [
                'label' => 'vidéo',
                'mapped' => true, // Ne doit pas être mappé à l'entité Media
                'required' => false, // Facultatif
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
