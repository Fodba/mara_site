<?php

namespace App\Form;

use App\Entity\Medium;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('telephone')
            ->add('email')
            ->add('photo')
            ->add('photo_texte')
            ->add('biographie')
            ->add('pratique')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medium::class,
        ]);
    }
}
