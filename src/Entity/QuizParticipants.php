<?php

namespace App\Entity;

use App\Repository\QuizParticipantsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuizParticipantsRepository::class)]
class QuizParticipants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'quizParticipants')]
    #[Assert\NotBlank(message: 'Veuillez saisir un quiz')]
    private ?Quiz $quiz = null;
    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez saisir un score')]
    private ?int $score = null;

    #[ORM\ManyToOne(inversedBy: 'quizParticipants')]
    private ?User $participant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }

    public function getParticipant(): ?User
    {
        return $this->participant;
    }

    public function setParticipant(?User $participant): static
    {
        $this->participant = $participant;

        return $this;
    }
}
