<?php

namespace App\Controller;

use App\Entity\Chamber;
use App\Form\ChamberType;
use App\Repository\ChamberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chamber')]
class ChamberController extends AbstractController
{
    #[Route('/', name: 'app_chamber_index', methods: ['GET'])]
    public function index(ChamberRepository $chamberRepository): Response
    {
        return $this->render('chamber/index.html.twig', [
            'chambers' => $chamberRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_chamber_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChamberRepository $chamberRepository): Response
    {
        $chamber = new Chamber();
        $form = $this->createForm(ChamberType::class, $chamber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chamberRepository->add($chamber, true);

            return $this->redirectToRoute('app_chamber_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chamber/new.html.twig', [
            'chamber' => $chamber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chamber_show', methods: ['GET'])]
    public function show(Chamber $chamber): Response
    {
        return $this->render('chamber/show.html.twig', [
            'chamber' => $chamber,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chamber_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chamber $chamber, ChamberRepository $chamberRepository): Response
    {
        $form = $this->createForm(ChamberType::class, $chamber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chamberRepository->add($chamber, true);

            return $this->redirectToRoute('app_chamber_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chamber/edit.html.twig', [
            'chamber' => $chamber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chamber_delete', methods: ['POST'])]
    public function delete(Request $request, Chamber $chamber, ChamberRepository $chamberRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chamber->getId(), $request->request->get('_token'))) {
            $chamberRepository->remove($chamber, true);
        }

        return $this->redirectToRoute('app_chamber_index', [], Response::HTTP_SEE_OTHER);
    }
}
