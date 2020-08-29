<?php

namespace App\Controller;

use App\Entity\Argonaut;
use App\Form\ArgonautType;
use App\Repository\ArgonautRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET","POST"})
     * @param Request $request
     * @param ArgonautRepository $argonautRepository
     * @return Response
     */
    public function index(Request $request, ArgonautRepository $argonautRepository): Response
    {
        $argonaut = new Argonaut();
        $form = $this->createForm(ArgonautType::class, $argonaut, [
            'action' => $this->generateUrl('home'),
            'method' => 'GET',
        ]);
        $form->handleRequest($request);
        $errors = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($argonaut);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        $argonauts = $argonautRepository->findAll();

        return $this->render('home/index.html.twig', [
            'argonauts' => $argonauts,
            'argonaut' => $argonaut,
            'form' => $form->createView(),
        ]);
    }
}
