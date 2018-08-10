<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Form\NotificationType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class NotificationController extends Controller {

    /**
     * @Route("/notification/", name="notification")
     */
    public function index(Request $request) {
        $notification = $this->getNotificationEntity();

        $form = $this->createForm($this->getNotificationType(), $notification, array());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $notification = $form->getData();

            $notification->setInserted(new DateTime('NOW'));

            $notification->setFosUserId($this->getUser()->getId());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($notification);
            $entityManager->flush();
            
            $this->addFlash('success', 'Notificação inserida com sucesso!');

            return $this->redirectToRoute('notification');
        }

        $parameters['form'] = $form->createView();

        return $this->render('notification/index.html.twig', $parameters);
    }

    /**
     * Return NotificationEntity class
     * @return object \App\Entity\Notification
     */
    protected function getNotificationEntity() {
        return new Notification;
    }

    /**
     * Return BookType class
     *
     */
    protected function getNotificationType() {
        return NotificationType::class;
    }

}
