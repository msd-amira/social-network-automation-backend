<?php

namespace App\Controller;

use App\Entity\SocialNetworks;
use App\Form\SocialNetworksType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/social/networks")
 */
class SocialNetworksController extends AbstractController
{
    /**
     * @Route("/", name="social_networks_index", methods={"GET"})
     */
    public function index(): Response
    {
        $socialNetworks = $this->getDoctrine()
            ->getRepository(SocialNetworks::class)
            ->findAll();

        return $this->render('social_networks/index.html.twig', [
            'social_networks' => $socialNetworks,
        ]);
    }

    /**
     * @Route("/new", name="social_networks_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $socialNetwork = new SocialNetworks();
        $form = $this->createForm(SocialNetworksType::class, $socialNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($socialNetwork);
            $entityManager->flush();

            return $this->redirectToRoute('social_networks_index');
        }

        return $this->render('social_networks/new.html.twig', [
            'social_network' => $socialNetwork,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="social_networks_show", methods={"GET"})
     */
    public function show(SocialNetworks $socialNetwork): Response
    {
        return $this->render('social_networks/show.html.twig', [
            'social_network' => $socialNetwork,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="social_networks_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SocialNetworks $socialNetwork): Response
    {
        $form = $this->createForm(SocialNetworksType::class, $socialNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('social_networks_index');
        }

        return $this->render('social_networks/edit.html.twig', [
            'social_network' => $socialNetwork,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="social_networks_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SocialNetworks $socialNetwork): Response
    {
        if ($this->isCsrfTokenValid('delete'.$socialNetwork->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($socialNetwork);
            $entityManager->flush();
        }

        return $this->redirectToRoute('social_networks_index');
    }
}
