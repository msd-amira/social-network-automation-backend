<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserHasSn
 * @ApiResource()
 * @ORM\Table(name="user_has_sn", indexes={@ORM\Index(name="fk_user_has_SN_social_networks1_idx", columns={"social_networks_id_"}), @ORM\Index(name="fk_user_has_SN_user1_idx", columns={"user_id_"})})
 * @ORM\Entity
 */
class UserHasSn
{
    /**
     * @var int
     *
     * @ORM\Column(name="iduser_has_SN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduserHasSn;

    /**
     * @var string
     *
     * @ORM\Column(name="access_token", type="string", length=45, nullable=false)
     */
    private $accessToken;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=45, nullable=true)
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var SocialNetworks
     *
     * @ORM\ManyToOne(targetEntity="SocialNetworks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="social_networks_id_", referencedColumnName="id_")
     * })
     */
    private $socialNetworksId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id_", referencedColumnName="id")
     * })
     */
    private $userId;

    public function getIduserHasSn(): ?int
    {
        return $this->iduserHasSn;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getSocialNetworksId(): ?SocialNetworks
    {
        return $this->socialNetworksId;
    }

    public function setSocialNetworksId(?SocialNetworks $socialNetworksId): self
    {
        $this->socialNetworksId = $socialNetworksId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }


}
