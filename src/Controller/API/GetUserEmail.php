<?php

namespace App\Controller\API;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class GetUserEmail {

    protected $em;
    // private $user;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        // $this->user = new User;
    }
        
    public function __invoke(Request $req) : User
    {
        $user = new User;
        $email = $req->attributes->get('email');
        $user = $this->em->getRepository(User :: class)
        ->findOneByEmail($email);
        if ($user != null) {
            if (password_verify ( $req->attributes->get('pwd') , $user->getpassword())) {
                return $user;
            } 
        }
        throw new \Exception('Password or Email wrong !');
    }
}