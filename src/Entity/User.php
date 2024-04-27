<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $role = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(min: 6)]
    #[Assert\NotBlank]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $section = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $numTel = null;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: Quiz::class)]
    private Collection $quizzes;

    #[ORM\OneToMany(mappedBy: 'participant', targetEntity: QuizParticipants::class)]
    private Collection $quizParticipants;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AvisProduit::class)]
    private Collection $avisProduits;

    public function __construct()
    {
        $this->quizzes = new ArrayCollection();
        $this->quizParticipants = new ArrayCollection();
        $this->avisProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * @return Collection<int, Quiz>
     */
    public function getQuizzes(): Collection
    {
        return $this->quizzes;
    }

    public function addQuiz(Quiz $quiz): static
    {
        if (!$this->quizzes->contains($quiz)) {
            $this->quizzes->add($quiz);
            $quiz->setCreateur($this);
        }

        return $this;
    }

    public function removeQuiz(Quiz $quiz): static
    {
        if ($this->quizzes->removeElement($quiz)) {
            // set the owning side to null (unless already changed)
            if ($quiz->getCreateur() === $this) {
                $quiz->setCreateur(null);
            }
        }

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
            $quizParticipant->setParticipant($this);
        }

        return $this;
    }

    public function removeQuizParticipant(QuizParticipants $quizParticipant): static
    {
        if ($this->quizParticipants->removeElement($quizParticipant)) {
            // set the owning side to null (unless already changed)
            if ($quizParticipant->getParticipant() === $this) {
                $quizParticipant->setParticipant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AvisProduit>
     */
    public function getAvisProduits(): Collection
    {
        return $this->avisProduits;
    }

    public function addAvisProduit(AvisProduit $avisProduit): static
    {
        if (!$this->avisProduits->contains($avisProduit)) {
            $this->avisProduits->add($avisProduit);
            $avisProduit->setUser($this);
        }

        return $this;
    }

    public function removeAvisProduit(AvisProduit $avisProduit): static
    {
        if ($this->avisProduits->removeElement($avisProduit)) {
            // set the owning side to null (unless already changed)
            if ($avisProduit->getUser() === $this) {
                $avisProduit->setUser(null);
            }
        }

        return $this;
    }
}
