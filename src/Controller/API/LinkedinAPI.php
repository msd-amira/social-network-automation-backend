<?php

namespace App\Controller\API;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/linkedinApi")
 */
class LinkedinAPI {

    protected $em;

    public function __construct()
    {
    }

    /**
     * @Route("/post/{token}/{data}", name="post_share")
     */
        
    public function postShare(Request $req,string $token, $data)
    {
        $handle = curl_init();
 
       $urlAPI = "https://api.linkedin.com/v2/shares?oauth2_access_token=".$token;

        curl_setopt($handle, CURLOPT_URL, $urlAPI);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS , $data);

        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_AUTOREFERER, true);
        curl_setopt($handle, CURLOPT_ENCODING, "");
        curl_setopt($handle, CURLOPT_TIMEOUT, 2500);

        curl_setopt($handle, CURLOPT_HTTPHEADER, array(
            'Connection: keep-alive',
            'Accept: */*',
            'X-Restli-Protocol-Version: 2.0.0',
            'Content-Type: application/json',
            'cache-control: no-cache',
        ));
        
        curl_setopt($handle, CURLOPT_VERBOSE, true);

        $output = curl_exec($handle);
        $error=curl_error($handle);

        curl_close($handle);
        if ($error) {
            return new Response($error, Response::HTTP_OK) ;
        } else {
            return new Response($output, Response::HTTP_OK) ;
        }
        
    }    
    /**
     * @Route("/postPhoto/{token}/{data}", name="post_photo")
     */
        
    public function postPhoto(Request $req,string $token, $data) : string
    {
        
    }
}