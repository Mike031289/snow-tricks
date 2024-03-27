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

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('category', EntityType::class, [
                'class' => 'App\Entity\Category',
                'choice_label' => 'name',
            ])
            ->add('media', CollectionType::class, [
                'entry_type' => MediaType::class, // Assuming you have a MediaType form type
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            // ->add('picture', CollectionType::class, [
            //     'entry_type' => MediaType::class, // Assuming MediaType form type is used for picture
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'by_reference' => false,
            // ])
            // ->add('video', CollectionType::class, [
            //     'entry_type' => MediaType::class, // Assuming MediaType form type is used for video
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'by_reference' => false,
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

