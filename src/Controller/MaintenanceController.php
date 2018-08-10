<?php

namespace App\Controller;

use App\Entity\Maintenance;
use App\Form\MaintenanceType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class MaintenanceController extends Controller {

    /**
     * @Route("/maintenance/", name="maintenance")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index(Request $request) {

        $maintenance = $this->getMaintenanceEntity();

        $form = $this->createForm($this->getMaintenanceType(), $maintenance, array());

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $maintenance = $form->getData();

            if (empty($maintenance->getLatitude()) || empty($maintenance->getLongitude())) {
                $form->get('address')->addError(new FormError('Selecione um endereço da lista!'));
            }

            if ($form->isValid()) {

                $maintenance->setInserted(new DateTime('NOW'));

                $maintenance->setFosUserId($this->getUser()->getId());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($maintenance);
                $entityManager->flush();

                $this->addFlash('success', 'Manutenção inserida com sucesso!');

                return $this->redirectToRoute('maintenance');
            }
        }

        $parameters['form'] = $form->createView();

        return $this->render('maintenance/index.html.twig', $parameters);
    }

    /**
     * Return MaintenanceEntity class
     * @return object \App\Entity\Maintenance
     */
    protected function getMaintenanceEntity() {
        return new Maintenance;
    }

    /**
     * Return BookType class
     *
     */
    protected function getMaintenanceType() {
        return MaintenanceType::class;
    }

}
