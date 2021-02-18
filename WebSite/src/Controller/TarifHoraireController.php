<?php

namespace App\Controller;

use App\Entity\TarifHoraire;
use App\Form\TarifHoraireType;
use App\Repository\TarifHoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tarif/horaire")
 */
class TarifHoraireController extends AbstractController
{
    /**
     * @Route("/", name="tarif_horaire_index", methods={"GET"})
     */
    public function index(TarifHoraireRepository $tarifHoraireRepository): Response
    {
        return $this->render('admin/tarif_horaire/index.html.twig', [
            'tarif_horaires' => $tarifHoraireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tarif_horaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tarifHoraire = new TarifHoraire();
        $form = $this->createForm(TarifHoraireType::class, $tarifHoraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tarifHoraire);
            $entityManager->flush();

            return $this->redirectToRoute('tarif_horaire_index');
        }

        return $this->render('admin/tarif_horaire/new.html.twig', [
            'tarif_horaire' => $tarifHoraire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tarif_horaire_show", methods={"GET"})
     */
    public function show(TarifHoraire $tarifHoraire): Response
    {
        return $this->render('admin/tarif_horaire/show.html.twig', [
            'tarif_horaire' => $tarifHoraire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tarif_horaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TarifHoraire $tarifHoraire): Response
    {
        $form = $this->createForm(TarifHoraireType::class, $tarifHoraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tarif_horaire_index');
        }

        return $this->render('admin/tarif_horaire/edit.html.twig', [
            'tarif_horaire' => $tarifHoraire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tarif_horaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TarifHoraire $tarifHoraire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarifHoraire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tarifHoraire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tarif_horaire_index');
    }
}
