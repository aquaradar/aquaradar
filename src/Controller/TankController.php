<?php

namespace App\Controller;

use App\Entity\Tank;
use App\Form\TankType;
use App\Repository\TankRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tank")
 * @Security("has_role('ROLE_ADMIN')")
 */
class TankController extends Controller {

    /**
     * @Route("/", name="tank_index", methods="GET")
     */
    public function index(TankRepository $tankRepository): Response {
        return $this->render('tank/index.html.twig', ['tanks' => $tankRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tank_new", methods="GET|POST")
     */
    public function new(Request $request): Response {
        $tank = new Tank();
        $form = $this->createForm(TankType::class, $tank);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (empty($tank->getLatitude()) || empty($tank->getLongitude())) {
                $form->get('address')->addError(new FormError('Selecione um endereço da lista! O endereço deve ser da cidade de Bauru, SP.'));
            }

            if ($form->isValid()) {
                try {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($tank);
                    $em->flush();

                    if ($tank->getId()) {
                        $this->addFlash('success', 'Manutenção inserida com sucesso!');
                        return $this->redirectToRoute('tank_new');
                    }
                } catch (UniqueConstraintViolationException $e) {
                    $form->get('address')->addError(new FormError('Já existe um reservatório cadastrado nesse endereço!'));
                }
            }
        }

        return $this->render('tank/new.html.twig', [
                    'tank' => $tank,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tank_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tank $tank): Response {
        $form = $this->createForm(TankType::class, $tank);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (empty($tank->getLatitude()) || empty($tank->getLongitude())) {
                $form->get('address')->addError(new FormError('Selecione um endereço da lista! O endereço deve ser da cidade de Bauru, SP.'));
            }
            if ($form->isValid()) {
                try {
                    $this->getDoctrine()->getManager()->flush();

                    $this->addFlash('success', 'Manutenção inserida com sucesso!');

                    return $this->redirectToRoute('tank_edit', ['id' => $tank->getId()]);
                } catch (UniqueConstraintViolationException $e) {
                    $form->get('address')->addError(new FormError('Já existe um reservatório cadastrado nesse endereço!'));
                }
            }
        }

        return $this->render('tank/edit.html.twig', [
                    'tank' => $tank,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tank_delete", methods="DELETE")
     */
    public function delete(Request $request, Tank $tank): Response {
        if ($this->isCsrfTokenValid('delete' . $tank->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tank);
            $em->flush();
        }

        return $this->redirectToRoute('tank_index');
    }

}
