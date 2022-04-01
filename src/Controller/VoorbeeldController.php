<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoorbeeldController extends AbstractController
{
    /**
     * @Route("/voorbeeld", name="voorbeeld")
     */
    public function index(): Response
    {
        return $this->render('voorbeeld/index.html.twig', [
            'controller_name' => 'VoorbeeldController',
        ]);
    }
}
