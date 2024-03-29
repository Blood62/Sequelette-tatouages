<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/admin/administration", name="administration")
     */
    public function index()
    {
        return $this->render('admin/administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }
}
