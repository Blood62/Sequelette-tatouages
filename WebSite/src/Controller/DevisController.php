<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Form\DevisType;
use App\Repository\DevisRepository;
use Knp\Component\Pager\PaginatorInterface;
use Swift_Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DevisController extends AbstractController
{
    /**
     * @Route("/admin/devis", name="devis_index", methods={"GET"})
     */
    public function index(DevisRepository $devisRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $pagination=$paginator->paginate(
            $devisRepository->findAllVisibleQuery(),
            $request->query->getInt('page',1),/*page number*/
            10/*limit per page*/
        );


        return $this->render('admin/devis/index.html.twig', [
            //'galerie' => $galerieRepository->findAll(),
            'pagination' => $pagination,
        ]);

    }

    /**
     * @Route("/new", name="devis_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $devi = new Devis();
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($devi);
            $entityManager->flush();



          //  $img=$devi->getImageFile();

            $partieCorp=$devi->getPartieCorp()->getPartie();
            $temp=$devi->getTemp();
            $tarif=$devi->getTarifHoraire()->getValeurTarif();
            $com=$devi->getCommentaire();
            $contact=$devi->getContact();

            $total=((floatval($temp)*$tarif)*1.2);

            $userMes=$request->getUser();



            $messageContent="<h1>Devis effetuer sur le site Terra-Incognita</h1><br><br><p>Merci d'avoir effectuer un devis et de votre confiance:<br><br>le tarif est de : '.$total.' €  TTC<br><br>à effectuer sur : '.$partieCorp.'<br><br>pour une durée approximative de : '.$temp.'h<br><br>commentaire complémentaire: '.$com.'<br><br>contact utilisateur: '.$contact.'<br><br></p>";

            $message = (new \Swift_Message('Demande de devis Terra-Incognita'))
                ->setFrom('alexandre.vienne2006@gmail.com')
                ->setTo('alexandre.vienne2006@gmail.com')

                ->setBody($messageContent, "text/html","UTF-8")
              //  ->attach(Swift_Attachment::fromPath($img))
            ;
            $mailer->send($message);




            return $this->redirectToRoute('galerie_index');
        }

        return $this->render('devis/new.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/devis/{id}", name="devis_show", methods={"GET"})
     */
    public function show(Devis $devi): Response
    {
        return $this->render('admin/devis/show.html.twig', [
            'devi' => $devi,
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="devis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Devis $devi): Response
    {
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('admin/devis/edit.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="devis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Devis $devi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($devi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devis_index');
    }
}
