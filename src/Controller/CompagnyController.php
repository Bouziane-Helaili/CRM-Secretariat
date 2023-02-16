<?php

namespace App\Controller;

use App\Entity\Compagny;
use App\Entity\CompagnyFile;
use App\Form\CompagnyType;
use App\Repository\CompagnyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entreprises')]
class CompagnyController extends AbstractController
{
    #[Route('/', name: 'app_compagny_index', methods: ['GET'])]
    public function index(CompagnyRepository $compagnyRepository): Response
    {
        return $this->render('compagny/index.html.twig', [
            'compagnies' => $compagnyRepository->findAll(),
        ]);
    }

    #[Route('/nouvelle', name: 'app_compagny_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompagnyRepository $compagnyRepository): Response
    {
        $compagny = new Compagny();
        $compagnyFile = new CompagnyFile();
        $compagny -> addCompagnyFile( $compagnyFile);



        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compagnyRepository->save($compagny, true);

            return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compagny/new.html.twig', [
            'compagny' => $compagny,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compagny_show', methods: ['GET'])]
    public function show(Compagny $compagny): Response
    {
        return $this->render('compagny/show.html.twig', [
            'compagny' => $compagny,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_compagny_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compagny $compagny, CompagnyRepository $compagnyRepository): Response
    {
        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compagnyRepository->save($compagny, true);

            return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compagny/edit.html.twig', [
            'compagny' => $compagny,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compagny_delete', methods: ['POST'])]
    public function delete(Request $request, Compagny $compagny, CompagnyRepository $compagnyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagny->getId(), $request->request->get('_token'))) {
            $compagnyRepository->remove($compagny, true);
        }

        return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
    }
}
