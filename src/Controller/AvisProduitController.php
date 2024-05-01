<?php

namespace App\Controller;

use App\Entity\AvisProduit;
use App\Entity\User;
use App\Form\AvisProduitType;
use App\Repository\AvisProduitRepository;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use App\Service\BadwordDetectorService;
use App\Service\MailerService;
use App\Service\SmsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
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

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/new', name: 'app_avis_produit_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ProduitRepository $produitRepository, UserRepository $userRepository, MailerService $mailerService, SmsService $smsService, BadwordDetectorService $badwordDetectorService): Response
    {
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login', Response::HTTP_SEE_OTHER);
        }

        if ($badwordDetectorService->detect($request->request->get('contenu'))) {
            return $this->redirectToRoute('app_produit_show', ['id' => $request->request->get('produit')], Response::HTTP_SEE_OTHER);
        }

        $data = $request->request->all();

        $avisProduit = new AvisProduit();
        $avisProduit->setNote($data['note']);
        $avisProduit->setContenu($data['contenu']);
        $avisProduit->setUser($this->getUser());
        $avisProduit->setProduit($produitRepository->find($data['produit']));

        $smsService->sendSms('Un nouvel avis a été ajouté' . $avisProduit->getContenu() . ' par ' . $this->getUser()->getNom() . ' ' . $this->getUser()->getPrenom() . ' pour le produit ' . $avisProduit->getProduit()->getNom() . ' avec la note ' . $avisProduit->getNote() . ' sur 5');
        $mailerService->sendTwigEmail($this->getUser()->getEmail(),
            'Thank you for your review!',
            'emails/avis_produit.html.twig', [
                'review' => $avisProduit,
                'user' => $this->getUser(),
            ]
        );
        $entityManager->persist($avisProduit);
        $entityManager->flush();

        return $this->redirectToRoute('app_produit_show', ['id' => $data['produit']], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_avis_produit_show', methods: ['GET'])]
    public function show(AvisProduit $avisProduit): Response
    {
        return $this->render('avis_produit/show.html.twig', [
            'avis_produit.html.twig' => $avisProduit,
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
