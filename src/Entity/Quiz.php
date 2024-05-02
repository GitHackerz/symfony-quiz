<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $matiere = null;

    #[ORM\Column(name: 'dateCreation', type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: 'Veuillez saisir une date de création')]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(name: 'dureeEnMinute')]
    #[Assert\NotBlank(message: 'Veuillez saisir une durée en minute')]
    #[Assert\Positive(message: 'La durée doit être positive')]
    private ?int $dureeEnMinute = null;

    #[ORM\Column(type: Types::SMALLINT, length: 1)]
    #[Assert\NotBlank(message: 'Veuillez saisir une disponibilité')]
    private ?int $disponibilitee = null;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: QuizParticipants::class)]
    #[Assert\NotBlank(message: 'Veuillez saisir un participant')]
    private Collection $quizParticipants;

    #[ORM\OneToMany(mappedBy: 'quiz', targetEntity: Question::class)]
    #[Assert\NotBlank(message: 'Veuillez saisir une question')]
    private Collection $questions;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez saisir un code')]
    #[Assert\Positive(message: 'Le code doit être positif')]
    private ?int $code = null;

    #[ORM\ManyToOne(inversedBy: 'quizzes')]
    private ?User $createur = null;

    public function __construct()
    {
        $this->quizParticipants = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDureeEnMinute(): ?int
    {
        return $this->dureeEnMinute;
    }

    public function setDureeEnMinute(int $dureeEnMinute): static
    {
        $this->dureeEnMinute = $dureeEnMinute;

        return $this;
    }

    public function getDisponibilitee(): ?int
    {
        return $this->disponibilitee;
    }

    public function setDisponibilitee(int $disponibilitee): static
    {
        $this->disponibilitee = $disponibilitee;

        return $this;
    }


    /**
     * @return Collection<int, QuizParticipants>
     */
    public function getQuizParticipants(): Collection
    {
        return $this->quizParticipants;
    }

    public function addQuizParticipant(QuizParticipants $quizParticipant): static
    {
        if (!$this->quizParticipants->contains($quizParticipant)) {
            $this->quizParticipants->add($quizParticipant);
            $quizParticipant->setQuiz($this);
        }

        return $this;
    }

    public function removeQuizParticipant(QuizParticipants $quizParticipant): static
    {
        if ($this->quizParticipants->removeElement($quizParticipant)) {
            // set the owning side to null (unless already changed)
            if ($quizParticipant->getQuiz() === $this) {
                $quizParticipant->setQuiz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

        return $this;
    }
}
