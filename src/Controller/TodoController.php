<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();      
        if (!$session->has('todos')) {
            $todos = [
                'Livre' => "Clean Code",
                'cours' => "AWS Architecte",
                'dev'   => "Symfony6", 
            ];
            $session->set('todos',$todos);
            $this->addFlash('info', "La liste des todos viens d'être initialisée");
        } 
        return $this->render('todo/index.html.twig');
    }

    #[Route('/todo/add/{key}/{value}', name: 'app_todo.add')]
    public function addTodo(Request $request, $key, $value)
    {
        $session = $request->getSession();
        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if(isset($todos[$key])) {
                $this->addFlash('error', "le todo d'id $key existe déja dans la liste");
            } else {
                $todos[$key] = $value;
                $session->set('todos',$todos);
                $this->addFlash('success', "Le todo d'id $key a été ajouté avec succès");
            }

        } else {
            $this->addFlash('error', "La liste des todos n'est pas encore initialiser");
        }
        return $this->redirectToRoute('todo');
    }
}
