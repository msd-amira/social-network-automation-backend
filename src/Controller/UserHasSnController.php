<?php

namespace App\Controller;

use App\Entity\UserHasSn;
use App\Form\UserHasSnType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/has/sn")
 */
class UserHasSnController extends AbstractController
{
    /**
     * @Route("/", name="user_has_sn_index", methods={"GET"})
     */
    public function index(): Response
    {
        $userHasSns = $this->getDoctrine()
            ->getRepository(UserHasSn::class)
            ->findAll();

        return $this->render('user_has_sn/index.html.twig', [
            'user_has_sns' => $userHasSns,
        ]);
    }

    /**
     * @Route("/new", name="user_has_sn_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userHasSn = new UserHasSn();
        $form = $this->createForm(UserHasSnType::class, $userHasSn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userHasSn);
            $entityManager->flush();

            return $this->redirectToRoute('user_has_sn_index');
        }

        return $this->render('user_has_sn/new.html.twig', [
            'user_has_sn' => $userHasSn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iduserHasSn}", name="user_has_sn_show", methods={"GET"})
     */
    public function show(UserHasSn $userHasSn): Response
    {
        return $this->render('user_has_sn/show.html.twig', [
            'user_has_sn' => $userHasSn,
        ]);
    }

    /**
     * @Route("/{iduserHasSn}/edit", name="user_has_sn_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserHasSn $userHasSn): Response
    {
        $form = $this->createForm(UserHasSnType::class, $userHasSn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_has_sn_index');
        }

        return $this->render('user_has_sn/edit.html.twig', [
            'user_has_sn' => $userHasSn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iduserHasSn}", name="user_has_sn_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserHasSn $userHasSn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userHasSn->getIduserHasSn(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userHasSn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_has_sn_index');
    }
}
