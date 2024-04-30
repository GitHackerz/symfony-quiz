<?php

namespace App\Controller;

use App\Form\UserProfileFrontType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserControllerFront extends AbstractController
{

    #[Route('/profile', name: 'app_user_profile_front', methods: ['GET', 'POST'])]
    public function profile(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_login');

        $user = $this->getUser();
        $form = $this->createForm(UserProfileFrontType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $newFilename = uniqid() . '.' . $image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $this->getUser()->setImage($newFilename);
            }
            $this->getUser()->setPassword(password_hash($this->getUser()->getPassword(), PASSWORD_DEFAULT));
            $entityManager->persist($this->getUser());
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/profile-front.html.twig', [
            'user' => $this->getUser(),
            'form' => $form->createView()
        ]);
    }


}
