<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request)
    {
        $client = new Client();
        $clientForm = $this->createForm(ClientFormType::class, $client);
        $clientForm->handleRequest($request);

        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash(
                'clientPostOk',
                'Client enregistré'
            );
            return $this->redirectToRoute('index');
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'client_form' => $clientForm->createView()
        ]);
    }
}
