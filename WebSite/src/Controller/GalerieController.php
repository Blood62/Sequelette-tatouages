<?php

namespace App\Controller;

use App\Entity\Galerie;
use App\Form\GalerieType;
use App\Repository\GalerieRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/galerie")
 */
class GalerieController extends AbstractController
{
    /**
     * @Route("/", name="galerie_index", methods={"GET"})
     */
    public function index(GalerieRepository $galerieRepository,
                          PaginatorInterface $paginator, Request $request): Response
    {
        $pagination=$paginator->paginate(
            $galerieRepository->findAllVisibleQuery(),
            $request->query->getInt('page',1),/*page number*/
            6/*limit per page*/
        );


        return $this->render('galerie/index.html.twig', [
            //'galerie' => $galerieRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/admin/new", name="galerie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $galerie = new Galerie();
        $form = $this->createForm(GalerieType::class, $galerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($galerie);
            $entityManager->flush();



            return $this->redirectToRoute('galerie_index');
        }

        return $this->render('admin/galerie/new.html.twig', [
            'galerie' => $galerie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="galerie_show", methods={"GET"})
     */
    public function show(Galerie $galerie): Response
    {
        return $this->render('galerie/show.html.twig', [
            'galerie' => $galerie,
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="galerie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Galerie $galerie): Response
    {
        $form = $this->createForm(GalerieType::class, $galerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('galerie_index');
        }

        return $this->render('admin/galerie/edit.html.twig', [
            'galerie' => $galerie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="galerie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Galerie $galerie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galerie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($galerie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('galerie_index');
    }
}
