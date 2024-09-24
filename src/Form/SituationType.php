<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\Situation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SituationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('texte')
            ->add('identifiant')
            ->add('demande', EntityType::class, [
                'class' => Demande::class,
                'choice_label' => 'identifiant',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Situation::class,
        ]);
    }
}
