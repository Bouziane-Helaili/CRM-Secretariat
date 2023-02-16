<?php

namespace App\Controller;

use App\Entity\CategoryFile;
use App\Form\CategoryFileType;
use App\Repository\CategoryFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories')]
class CategoryFileController extends AbstractController
{
    #[Route('/', name: 'app_category_file_index', methods: ['GET'])]
    public function index(CategoryFileRepository $categoryFileRepository): Response
    {
        return $this->render('category_file/index.html.twig', [
            'category_files' => $categoryFileRepository->findAll(),
        ]);
    }

    #[Route('/nouvelle', name: 'app_category_file_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoryFileRepository $categoryFileRepository): Response
    {
        $categoryFile = new CategoryFile();
        $form = $this->createForm(CategoryFileType::class, $categoryFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryFileRepository->save($categoryFile, true);

            return $this->redirectToRoute('app_category_file_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category_file/new.html.twig', [
            'category_file' => $categoryFile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_file_show', methods: ['GET'])]
    public function show(CategoryFile $categoryFile): Response
    {
        return $this->render('category_file/show.html.twig', [
            'category_file' => $categoryFile,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_category_file_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoryFile $categoryFile, CategoryFileRepository $categoryFileRepository): Response
    {
        $form = $this->createForm(CategoryFileType::class, $categoryFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryFileRepository->save($categoryFile, true);

            return $this->redirectToRoute('app_category_file_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category_file/edit.html.twig', [
            'category_file' => $categoryFile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_file_delete', methods: ['POST'])]
    public function delete(Request $request, CategoryFile $categoryFile, CategoryFileRepository $categoryFileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryFile->getId(), $request->request->get('_token'))) {
            $categoryFileRepository->remove($categoryFile, true);
        }

        return $this->redirectToRoute('app_category_file_index', [], Response::HTTP_SEE_OTHER);
    }
}
