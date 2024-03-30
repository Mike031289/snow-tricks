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
            ->add('medias', CollectionType::class, [
                'entry_type'    => TextType::class, // Pour les liens
                'entry_options' => [
                    'label' => false,
                    'attr'  => [
                        'placeholder' => 'Entrez un lien URL ou un code embed',
                    ],
                ],
                'allow_add'     => true,
                'allow_delete'  => true,
                'required'      => false,
                'label'         => 'Médias du trick',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
