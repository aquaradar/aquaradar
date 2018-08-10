<?php

namespace App\Controller;

use App\Entity\Denouncement;
use App\Form\DenouncementType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\FormError;

class DenouncementController extends Controller {

    /**
     * @Route("/denouncement", name="denouncement")
     */
    public function index(Request $request) {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $denouncement = $this->getDenouncementEntity();

        $form = $this->createForm($this->getDenouncementType(), $denouncement, array());

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if (empty($denouncement->getLatitude()) || empty($denouncement->getLongitude())) {
                $form->get('address')->addError(new FormError('Selecione um endereço da lista! O endereço deve ser da cidade de Bauru, SP.'));
            }

            if ($form->isValid()) {

                $denouncement = $form->getData();

                $denouncement->setInserted((new DateTime('NOW')));

                $denouncement->setFosUserId($this->getUser()->getId());

                $em = $this->getDoctrine()->getManager();
                $connection = $em->getConnection();
                $statement = $connection->prepare("SELECT COUNT(1) as existent FROM denouncement WHERE latitude=:latitude AND longitude=:longitude AND fos_user_id=:fos_user_id AND (inserted>=(current_time() - INTERVAL 1 DAY))");
                $statement->bindValue('longitude', $denouncement->getLongitude());
                $statement->bindValue('latitude', $denouncement->getLatitude());
                $statement->bindValue('fos_user_id', $denouncement->getFosUserId());
                $statement->execute();
                $results = $statement->fetch();

                if (empty($results['existent'])) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($denouncement);
                    $entityManager->flush();

                    $this->addFlash('success', 'Denúncia inserida com sucesso!');

                    return $this->redirectToRoute('denouncement');
                }
                $form->addError(new FormError("A denúncia informada já foi cadastrada por esse usuário nas últimas 24 horas"));
            }
        }

        $parameters['form'] = $form->createView();

        return $this->render('denouncement/index.html.twig', $parameters);
    }

    /**
     * Return DenouncementEntity class
     * @return object \App\Entity\Denouncement
     */
    protected function getDenouncementEntity() {
        return new Denouncement;
    }

    /**
     * Return BookType class
     *
     */
    protected function getDenouncementType() {
        return DenouncementType::class;
    }

}
