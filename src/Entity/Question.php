<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'question', length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir un titre')]
    private ?string $titre = null;

    #[ORM\Column]
    private ?string $choix = null;

    #[Assert\NotBlank(message: 'Veuillez saisir un choix')]
    private ?string $choix1 = null;

    #[Assert\NotBlank(message: 'Veuillez saisir un choix')]
    private ?string $choix2 = null;

    #[Assert\NotBlank(message: 'Veuillez saisir un choix')]
    private ?string $choix3 = null;

    #[ORM\Column(type: 'smallint', length: 1)]
    #[Assert\NotBlank(message: 'Veuillez saisir une réponse correcte')]
    private ?int $reponseCorrecte = null;

    #[ORM\ManyToOne(targetEntity: Quiz::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(name: 'quiz')]
    #[Assert\NotBlank(message: 'Veuillez saisir un quiz')]
    private ?Quiz $quiz = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez saisir un score')]
    #[Assert\Positive(message: 'Le score doit être positif')]
    private ?int $score = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getChoix(): ?string
    {
        return $this->choix;
    }

    public function setChoix(string $choix): static
    {
        $this->choix = $choix;

        return $this;
    }

    public function getChoix1(): ?string
    {
        return $this->choix1;
    }

    public function setChoix1(string $choix): static
    {
        $this->choix1 = $choix;

        return $this;
    }

    public function getChoix2(): ?string
    {
        return $this->choix2;
    }

    public function setChoix2(string $choix): static
    {
        $this->choix2 = $choix;

        return $this;
    }

    public function getChoix3(): ?string
    {
        return $this->choix3;
    }

    public function setChoix3(string $choix): static
    {
        $this->choix3 = $choix;

        return $this;
    }

    public function getReponseCorrecte(): ?int
    {
        return $this->reponseCorrecte;
    }

    public function setReponseCorrecte(int $reponseCorrecte): static
    {
        $this->reponseCorrecte = $reponseCorrecte;

        return $this;
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
}
