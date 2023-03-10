<?php

namespace App\Controller;

use App\Entity\Compagny;
use App\Trait\LoginTrait;
use App\Entity\CompagnyFile;
use App\Form\CompagnyType;
use App\Form\SearchType;
use App\Repository\CompagnyRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// if (trait_exists(Login::class)) {
//    dd("ok");
// } else {
//     dd("pas ok");
// }

#[Route('/entreprises')]
class CompagnyController extends AbstractController
{
    use LoginTrait;

    #[Route('/', name: 'app_compagny_index')]
    public function index(Request $request, CompagnyRepository $compagnyRepository): Response
{
    $searchForm = $this->createForm(SearchType::class);
    $searchForm->handleRequest($request);

    if ($searchForm->isSubmitted() && $searchForm->isValid()) {
        $data = $searchForm->getData();
       
        $compagnies = $data;
        // dd($compagnies);
    } else {
        $compagnies = $compagnyRepository->findAll();
    }

    return $this->render('compagny/index.html.twig', [
        'searchForm' => $searchForm->createView(),
        'compagnies' => $compagnies,
    ]);
}

    #[Route('/nouvelle', name: 'app_compagny_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, CompagnyRepository $compagnyRepository): Response
    {
        $compagny = new Compagny();
        $compagnyFile = new CompagnyFile();
        $compagny->addCompagnyFile($compagnyFile);

        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compagnyRepository->save($compagny, true);
            $this->addFlash('success', " L'entreprise a été ajoutée avec succès");
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
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Compagny $compagny, CompagnyRepository $compagnyRepository): Response
    {
        $form = $this->createForm(CompagnyType::class, $compagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compagnyRepository->save($compagny, true);
            $this->addFlash('success', " L'entreprise {{Compagny.name}} a été modifié avec succès");
            return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('compagny/edit.html.twig', [
            'compagny' => $compagny,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compagny_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Compagny $compagny, CompagnyRepository $compagnyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $compagny->getId(), $request->request->get('_token'))) {
            $compagnyRepository->remove($compagny, true);
        }

        return $this->redirectToRoute('app_compagny_index', [], Response::HTTP_SEE_OTHER);
    }
}
