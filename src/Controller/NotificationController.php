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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class NotificationController extends Controller {

    /**
     * @Route("/notification/", name="notification")
     */
    public function index(Request $request) {
        
        $entityManager = $this->getDoctrine()->getManager();
        
        $notification = $this->getNotificationEntity();

        $form = $this->createForm($this->getNotificationType(), $notification, array());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $notification = $form->getData();

            $notification->setInserted(new DateTime('NOW'));

            $notification->setFosUserId($this->getUser()->getId());

            $entityManager->persist($notification);
            $entityManager->flush();
            
            $this->addFlash('success', 'Notificação inserida com sucesso!');

            return $this->redirectToRoute('notification');
        }

        $parameters['form'] = $form->createView();

        $parameters['notifications'] = $entityManager->getRepository("App\Entity\Notification")->findBy(
            ['fosUserId' => $this->getUser()->getId()]
        );

        return $this->render('notification/index.html.twig', $parameters);
    }

    /**
     * @Route(
     *      path            = "/notification/status/atualizar/{notificationId}/{statusId}/",
     *      requirements    = {"notificationId": "[0-9]+", "statusId": "[0-9]+"},
     *      methods         = {"GET"}
     * ),
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function atualizarStatusAction(Request $request, $notificationId, $statusId) {

        $entityManager = $this->getDoctrine()->getManager();
        $notification = $entityManager->getRepository("App\Entity\Notification")->find($notificationId);

        $notification->setStatus($statusId);
        $notification->setId($notificationId);

        $entityManager->merge($notification);
        $entityManager->flush();

        return $this->redirectToRoute('notification');
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
