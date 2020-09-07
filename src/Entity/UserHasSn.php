<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserHasSnRepository;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 * collectionOperations={
 *      "get",
 *      "post",
 *      "getByIdUser"={
 *          "method" = "GET",
 *          "path"="/user_has_sns/{userId}",
 *          "controller"=App\Controller\API\GetUserSN::class,
 *      },
 * },
 * )
 * @ORM\Table(name="user_has_sn", indexes={
 * @ORM\Index(name="fk_user_has_SN_social_networks1_idx", columns={"social_networks_id_"}), 
 * @ORM\Index(name="fk_user_has_SN_user1", columns={"user_id_"})
 * })
 * @ORM\Entity
 * @UniqueEntity(
 *      fields={"userSNId","socialNetworksId","userId"},
 *      message="This account is already exist ."
 * )
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
     * @ORM\Column(name="userSNId", type="string", nullable=false)
     */
    private $userSNId;

    /**
     * @var string
     *
     * @ORM\Column(name="longAccesstoken", type="text",  nullable=false)
     */
    private $longAccesstoken;

    /**
     * @var string
     *
     * @ORM\Column(name="labelNetwork", type="string",  nullable=false)
     */
    private $labelNetwork;

    /**
     * @var text
     *
     * @ORM\Column(name="pages", type="text")
     */
    private $pages;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    private $photo;

    /**
     * @var SocialNetworks
     *
     * @ORM\ManyToOne(targetEntity="SocialNetworks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="social_networks_id_", referencedColumnName="id_", nullable=false)
     * })
     */
    private $socialNetworksId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id_", referencedColumnName="id", nullable=false)
     * })
     */
    private $userId;

    public function getIduserHasSn(): ?int
    {
        return $this->iduserHasSn;
    }

    public function getLongAccesstoken(): ?string
    {
        return $this->longAccesstoken;
    }

    public function setLongAccesstoken(?string $longAccesstoken): self
    {
        $this->longAccesstoken = $longAccesstoken;

        return $this;
    }

    public function getLabelNetwork(): ?string
    {
        return $this->labelNetwork;
    }

    public function setLabelNetwork(?string $labelNetwork): self
    {
        $this->labelNetwork = $labelNetwork;

        return $this;
    }

    public function getPages(): ?string
    {
        return $this->pages;
    }

    public function setPages(?string $pages): self
    {
        $this->pages = $pages;

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

    public function getUserSNId(): ?string
    {
        return $this->userSNId;
    }

    public function setUserSNId(string $userSNId): self
    {
        $this->userSNId = $userSNId;

        return $this;
    }


}
