<?php

namespace App\Controller;

use App\Entity\RolesHabilitations;
use App\Form\RolesHabilitationsType;
use App\Repository\RolesHabilitationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/roleshabilitations')]
class RolesHabilitationsController extends AbstractController
{
    #[Route('/', name: 'app_roles_habilitations_index', methods: ['GET'])]
    public function index(RolesHabilitationsRepository $rolesHabilitationsRepository): Response
    {
        
        return $this->render('roles_habilitations/index.html.twig', [
            'roles_habilitations' => $rolesHabilitationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_roles_habilitations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rolesHabilitation = new RolesHabilitations();
        $form = $this->createForm(RolesHabilitationsType::class, $rolesHabilitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rolesHabilitation);
            $entityManager->flush();

            return $this->redirectToRoute('app_roles_habilitations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('roles_habilitations/new.html.twig', [
            'roles_habilitation' => $rolesHabilitation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_roles_habilitations_show', methods: ['GET'])]
    public function show(RolesHabilitations $rolesHabilitation): Response
    {
        return $this->render('roles_habilitations/show.html.twig', [
            'roles_habilitation' => $rolesHabilitation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_roles_habilitations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RolesHabilitations $rolesHabilitation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RolesHabilitationsType::class, $rolesHabilitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_roles_habilitations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('roles_habilitations/edit.html.twig', [
            'roles_habilitation' => $rolesHabilitation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_roles_habilitations_delete', methods: ['POST'])]
    public function delete(Request $request, RolesHabilitations $rolesHabilitation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rolesHabilitation->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($rolesHabilitation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_roles_habilitations_index', [], Response::HTTP_SEE_OTHER);
    }
}
