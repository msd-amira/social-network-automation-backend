<?php

namespace App\Controller\API;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/appDev")
 */
class KeysAppDevloperes {

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/addSetting/{id}/{key}/{label}", name="add_settings")
     */
        
    public function addSettings(Request $req,string $id, string $key, string $label)
    {
        $data = array(
            'socialNetwork'=> $label,
            'AppID'=> $id, 
            'KeySecret'=> $key);
         $fp = fopen('results.json', 'a+');
        $res = fwrite($fp, json_encode($data));
        fwrite($fp,"\n");
        fclose($fp);
        if ($res === false) {
            return new Response("Cannot be added !", Response::HTTP_OK) ;
        } else {
            return new Response($res, Response::HTTP_FAILED_DEPENDENCY) ;
        }
        
        
    }

    
    /**
     * @Route("/getSetting/{label}", name="get_settings")
     */
        
    public function getSetting(string $label)
    {
        $fp = fopen('results.json', 'r') or die("Unable to open file!");
        while(!feof($fp)) {
           $line = json_decode(fgets($fp));
         /*   var_dump($line->socialNetwork);
           var_dump($label); */
             if ($line->socialNetwork===$label){
                return new Response(json_encode($line), Response::HTTP_OK) ;
             }
          }
          fclose($fp);
          throw new \Exception('nothing found !');
    }
}