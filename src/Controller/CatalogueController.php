<?php

namespace App\Controller;

use App\Entity\Catalogue;
use App\Form\CatalogueType;
use App\Repository\CatalogueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/catalogue')]
class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue_index', methods: ['GET'])]
    public function index(CatalogueRepository $catalogueRepository): Response
    {
        return $this->render('catalogue/index.html.twig', [
            'catalogues' => $catalogueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_catalogue_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CatalogueRepository $catalogueRepository): Response
    {
        $catalogue = new Catalogue();
        $form = $this->createForm(CatalogueType::class, $catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catalogueRepository->save($catalogue, true);

            return $this->redirectToRoute('app_catalogue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('catalogue/new.html.twig', [
            'catalogue' => $catalogue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_catalogue_show', methods: ['GET'])]
    public function show(Catalogue $catalogue): Response
    {
        return $this->render('catalogue/show.html.twig', [
            'catalogue' => $catalogue,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_catalogue_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Catalogue $catalogue, CatalogueRepository $catalogueRepository): Response
    {
        $form = $this->createForm(CatalogueType::class, $catalogue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catalogueRepository->save($catalogue, true);

            return $this->redirectToRoute('app_catalogue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('catalogue/edit.html.twig', [
            'catalogue' => $catalogue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_catalogue_delete', methods: ['POST'])]
    public function delete(Request $request, Catalogue $catalogue, CatalogueRepository $catalogueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catalogue->getId(), $request->request->get('_token'))) {
            $catalogueRepository->remove($catalogue, true);
        }

        return $this->redirectToRoute('app_catalogue_index', [], Response::HTTP_SEE_OTHER);
    }
}
