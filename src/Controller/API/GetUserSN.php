<?php

namespace App\Controller\API;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\UserHasSn;
use Symfony\Component\HttpFoundation\Request;

class GetUserSN {

    protected $em;
    // private $social_networks_user;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        // $this->social_networks_user = new UserHasSn;
    }
        
    public function __invoke(Request $req)
    {
        $social_networks_user = new UserHasSn;
        $idUser = $req->attributes->get('userId');
        $social_networks_user = $this->em->getRepository(UserHasSn :: class)
        ->findByuserId($idUser);
        if ($social_networks_user != null) {
            return $social_networks_user;
        }
        throw new \Exception('nothing found !');
    }
}