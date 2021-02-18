<?php

namespace App\Controller;

use App\Entity\Corp;
use App\Form\CorpType;
use App\Repository\CorpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/corp")
 */
class CorpController extends AbstractController
{
    /**
     * @Route("/", name="corp_index", methods={"GET"})
     */
    public function index(CorpRepository $corpRepository): Response
    {
        return $this->render('admin/corp/index.html.twig', [
            'corps' => $corpRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="corp_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $corp = new Corp();
        $form = $this->createForm(CorpType::class, $corp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($corp);
            $entityManager->flush();

            return $this->redirectToRoute('corp_index');
        }

        return $this->render('admin/corp/new.html.twig', [
            'corp' => $corp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="corp_show", methods={"GET"})
     */
    public function show(Corp $corp): Response
    {
        return $this->render('admin/corp/show.html.twig', [
            'corp' => $corp,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="corp_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Corp $corp): Response
    {
        $form = $this->createForm(CorpType::class, $corp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('corp_index');
        }

        return $this->render('admin/corp/edit.html.twig', [
            'corp' => $corp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="corp_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Corp $corp): Response
    {
        if ($this->isCsrfTokenValid('delete'.$corp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($corp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('corp_index');
    }
}
