<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Table(name="user", indexes={@ORM\Index(name="fk_users_role1_idx", columns={"role"}), @ORM\Index(name="fk_user_language1_idx", columns={"languageId"})})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=20, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=20, nullable=false)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var Role
     *@ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="idrole", onDelete="CASCADE")
     * })
     */
    private $role;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Groups("user:write")
     * @SerializedName("password")
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="nameCompany", type="string", length=45, nullable=false)
     */
    private $namecompany;

    /**
     * @var int
     *
     * @ORM\Column(name="phoneNumber", type="integer", nullable=false)
     */
    private $phonenumber;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Language", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="languageId", referencedColumnName="id_" , onDelete="CASCADE")
     * })
     */
    private $languageId ;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhoneNumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getLanguageID(): ?Language
    {
        return $this->languageId;
    }

    public function setLanguageID(?Language $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getNameCompany(): ?string
    {
        return $this->namecompany;
    }

    public function setNameCompany(string $namecompany): self
    {
        $this->namecompany = $namecompany;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): ?Role
    {
        $role = $this->role;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_USER';

        return $role;
    }

    public function setRoles(?Role $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = md5($password);

        return $this;
    }
    
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
