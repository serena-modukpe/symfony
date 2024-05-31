<?php

namespace App\Controller;

use App\Entity\Habilitations;
use App\Form\HabilitationsType;
use App\Repository\HabilitationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/habilitations')]
class HabilitationsController extends AbstractController
{
    #[Route('/', name: 'app_habilitations_index', methods: ['GET'])]
    public function index(HabilitationsRepository $habilitationsRepository): Response
    {
        return $this->render('habilitations/index.html.twig', [
            'habilitations' => $habilitationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_habilitations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $habilitation = new Habilitations();
        $form = $this->createForm(HabilitationsType::class, $habilitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($habilitation);
            $entityManager->flush();

            return $this->redirectToRoute('app_habilitations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('habilitations/new.html.twig', [
            'habilitation' => $habilitation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habilitations_show', methods: ['GET'])]
    public function show(Habilitations $habilitation): Response
    {
        return $this->render('habilitations/show.html.twig', [
            'habilitation' => $habilitation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_habilitations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Habilitations $habilitation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HabilitationsType::class, $habilitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_habilitations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('habilitations/edit.html.twig', [
            'habilitation' => $habilitation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habilitations_delete', methods: ['POST'])]
    public function delete(Request $request, Habilitations $habilitation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$habilitation->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($habilitation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_habilitations_index', [], Response::HTTP_SEE_OTHER);
    }
}
