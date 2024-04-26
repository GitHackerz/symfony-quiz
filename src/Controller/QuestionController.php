<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/question')]
class QuestionController extends AbstractController
{
    #[Route('/', name: 'app_question_index', methods: ['GET'])]
    public function index(QuestionRepository $questionRepository): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_login');

        $questions = $questionRepository->findAll();

        foreach ($questions as $question) {
            $choices = explode(" ", $question->getChoix());

            $question->setChoix1(explode('1)', $choices[0])[1]);
            $question->setChoix2(explode('2)', $choices[1])[1]);
            $question->setChoix3(explode('3)', $choices[2])[1]);
        }
        return $this->render('question/index.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_question_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_login');

        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setChoix('1)' . $question->getChoix1() . ' 2)' . $question->getChoix2() . ' 3)' . $question->getChoix3());
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('app_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question/new.html.twig', [
            'question' => $question,
            'form' => $form,
            'quizzes' => $entityManager->getRepository(Quiz::class)->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_question_show', methods: ['GET'])]
    public function show(Question $question): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_login');

        return $this->render('question/show.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_question_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Question $question, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_login');

        $choices = explode(" ", $question->getChoix());

        $question->setChoix1(explode('1)', $choices[0])[1]);
        $question->setChoix2(explode('2)', $choices[1])[1]);
        $question->setChoix3(explode('3)', $choices[2])[1]);
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setChoix('1)' . $question->getChoix1() . ' 2)' . $question->getChoix2() . ' 3)' . $question->getChoix3());
            $entityManager->flush();

            return $this->redirectToRoute('app_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('question/edit.html.twig', [
            'question' => $question,
            'form' => $form,
            'quizzes' => $entityManager->getRepository(Quiz::class)->findAll(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_question_delete', methods: ['GET'])]
    public function delete(Request $request, Question $question, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_login');

        $entityManager->remove($question);
        $entityManager->flush();

        return $this->redirectToRoute('app_question_index', [], Response::HTTP_SEE_OTHER);
    }
}
