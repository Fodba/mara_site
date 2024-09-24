<?php

namespace App\Controller\Gestion;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gestion/messages')]
class MessageGestionController extends AbstractController
{
    #[Route('/', name: 'app_gestion_message_index')]
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->render('gestion/message/index.html.twig', [
            'titre' => 'Gestion des messages',
            'messages' => $messageRepository->findAll(),
        ]);
    }
    #[Route('/{id}', name: 'app_gestion_message_show', methods: ['GET'])]
    public function show(Message $message,EntityManagerInterface $entityManager): Response
    {
        return $this->render('gestion/message/show.html.twig', [
            'message' => $message,
            // 'titre' => $message['titre'],
            // 'messages' => $messages,
            // 'situations' => $situations,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gestion_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Message $message, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gestion/message/edit.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gestion_message_delete', methods: ['POST'])]
    public function delete(Request $request, Message $message, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gestion_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
