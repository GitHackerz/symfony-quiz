<?php

namespace App\Form;

use App\Entity\QuizParticipants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizParticipantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $questions = $options['questions'];

        foreach ($questions as $question) {
            $builder->add('question_' . $question->getId(), ChoiceType::class, [
                'label' => $question->getTitre(),
                'choices' => [
                    $question->getChoix1() => 1,
                    $question->getChoix2() => 2,
                    $question->getChoix3() => 3,
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'questions' => [], // Pass quiz object to the form
        ]);

    }
}
