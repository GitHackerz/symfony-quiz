<?php

namespace App\Form;

use App\Entity\QuizParticipants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizParticipantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $questions = $options['questions'];

        foreach ($questions as $question) {
            $builder->add('question_' . $question->getId(), HiddenType::class, [
                'mapped' => false, // This field is not mapped to any property of the entity
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuizParticipants::class,
            'questions' => [], // Define an empty array as default for questions
        ]);
    }
}
