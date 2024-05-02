<?php

namespace App\Form;

use App\Entity\Quiz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', null, [
                'label' => 'Code Quiz',
            ])
            ->add('dureeEnMinute', null, [
                'label' => 'Durée en minute',
            ])
            ->add('disponibilitee', null, [
                'label' => 'Disponibilitée'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
