<?php

namespace App\Controller\API;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class GetUserEmail {

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
        
    public function __invoke(Request $req) : User
    {
        $email = $req->attributes->get('email');
        return $this->em->getRepository(User :: class)
        ->findOneByEmail($email);
    }
}