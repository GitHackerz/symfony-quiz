<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'label' => 'Question',
            ])
            ->add('choix1', null, [
                'label' => 'Choix 1',
            ])
            ->add('choix2', null, [
                'label' => 'Choix 2',
            ])
            ->add('choix3', null, [
                'label' => 'Choix 3',
            ])
            ->add('reponseCorrecte', null, [
                'label' => 'Reponse Correcte',
            ])
            ->add('quiz', null, [
                'label' => 'Quiz',
                'choice_label' => 'Matiere',
            ])
            ->add('score', null, [
                'label' => 'Score',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
