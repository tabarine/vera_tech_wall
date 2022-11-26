<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'firstname' => 'Youssef',
            'lastname'  => 'Tabarine'
        ]);
    }

    #[Route('/sayHello/{firstname}/{lastname}', name: 'say.hello')]
    public function sayHello(Request $request, $firstname, $lastname): Response
    {
        return $this->render('first/hello.html.twig', [
            'nom' => $firstname,
            'prenom' => $lastname
        ]);
    }
}
