<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    public function index(Request $request)
    {
        $client = new Client();
        $clientForm = $this->createForm(ClientFormType::class, $client);
        $clientForm->handleRequest($request);

        if ($clientForm->isSubmitted() && $clientForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash('clientPost', 'Client enregistré');
            return $this->redirectToRoute('index');

        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'client_form' => $clientForm->createView()
        ]);
    }
}
