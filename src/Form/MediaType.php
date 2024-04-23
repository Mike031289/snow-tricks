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
            ->add('name', TextType::class, [
                'label'    => 'Nom du média',
                'required' => true,
            ])
        ;

            // ->add('pictures', CollectionType::class, [
            //     'entry_type'   => PictureType::class,
            //     'label'        => false,
            //     'allow_add'    => true,
            //     'allow_delete' => true,
            //     'by_reference' => false,
            // ])
            // ->add('videos', CollectionType::class, [
            //     'entry_type'   => VideoType::class,
            //     'label'        => false,
            //     'allow_add'    => true,
            //     'allow_delete' => true,
            //     'by_reference' => false,
            // ])
            // ->add('trick', EntityType::class, [
            //     'class'        => 'App\Entity\Trick',
            //     'choice_label' => 'name',
            // ])
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
