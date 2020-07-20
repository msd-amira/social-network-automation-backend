<?php

namespace App\Controller\API;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Role;
use Symfony\Component\HttpFoundation\Request;

class GetRoleByLabel {

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        
    public function __invoke(Request $req) : Role
    {
        $label = $req->attributes->get('label');
        return $this->em->getRepository(Role :: class)
        ->findOneByLabel($label);
    }
}