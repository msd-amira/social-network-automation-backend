<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoleRepository;

/**
 * @ApiResource(
 * collectionOperations={
 *      "get",
 *      "post",
 *      "getByLabel"={
 *          "method" = "GET",
 *          "path"="/roles/label/{label}",
 *          "controller"=App\Controller\API\GetRoleByLabel::class,
 *      },
 * },
 * )
 * @ORM\Table(name="role", uniqueConstraints={@ORM\UniqueConstraint(name="idrole_UNIQUE", columns={"idrole"})})
 * @ORM\Entity
 */
class Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="idrole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrole;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    public function getIdrole(): ?int
    {
        return $this->idrole;
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

    public function __toString()
    {
        return $this->label;
    }

}
