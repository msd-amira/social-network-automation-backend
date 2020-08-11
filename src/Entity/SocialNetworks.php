<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="social_networks", uniqueConstraints={@ORM\UniqueConstraint(name="idsocial_networks_UNIQUE", columns={"id_"})})
 * @ORM\Entity
 */
class SocialNetworks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=45, nullable=false)
     */
    private $img;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

    
    /**
     * @var string
     *
     * @ORM\Column(name="descriptionDetails", type="string", nullable=false)
     */
    private $descriptionDetails;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionDetails(): ?string
    {
        return $this->descriptionDetails;
    }

    public function setDescriptionDetails(string $descriptionDetails): self
    {
        $this->descriptionDetails = $descriptionDetails;

        return $this;
    }


}
