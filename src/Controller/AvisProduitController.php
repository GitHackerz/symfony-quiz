<?php

namespace App\Controller;

use App\Entity\AvisProduit;
use App\Form\AvisProduitType;
use App\Repository\AvisProduitRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avis/produit')]
class AvisProduitController extends AbstractController
{
    #[Route('/', name: 'app_avis_produit_index', methods: ['GET'])]
    public function index(AvisProduitRepository $avisProduitRepository): Response
    {
        return $this->render('avis_produit/index.html.twig', [
            'avis_produits' => $avisProduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_avis_produit_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ProduitRepository $produitRepository): Response
    {
        $data = $request->request->all();

        $avisProduit = new AvisProduit();
        $avisProduit->setNote($data['note']);
        $avisProduit->setContenu($data['contenu']);
        $avisProduit->setUser($this->getUser());
        $avisProduit->setProduit($produitRepository->find($data['produit']));

        $entityManager->persist($avisProduit);
        $entityManager->flush();

        // redirect to porject with id
        return $this->redirectToRoute('app_produit_show', ['id' => $data['produit']], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_avis_produit_show', methods: ['GET'])]
    public function show(AvisProduit $avisProduit): Response
    {
        return $this->render('avis_produit/show.html.twig', [
            'avis_produit' => $avisProduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_avis_produit_edit', methods: ['POST'])]
    public function edit(Request $request, AvisProduit $avisProduit, EntityManagerInterface $entityManager): Response
    {
        $data = $request->request->all();
        $avisProduit->setContenu($data['contenu']);

        $entityManager->persist($avisProduit);
        $entityManager->flush();

        return $this->redirectToRoute('app_produit_show', ['id' => $data['produit']], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/delete', name: 'app_avis_produit_delete', methods: ['POST'])]
    public function delete(Request $request, AvisProduit $avisProduit, EntityManagerInterface $entityManager): Response
    {
        $data = $request->request->all();
        $entityManager->remove($avisProduit);
        $entityManager->flush();

        return $this->redirectToRoute('app_produit_show', ['id' => $data['produit']], Response::HTTP_SEE_OTHER);
    }
}
