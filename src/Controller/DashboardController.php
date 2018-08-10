<?php

namespace App\Controller;

use App\Entity\Maintenance;
use App\Form\MaintenanceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends Controller {

    /**
     * @Route("/dashboard/", name="dashboard")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare(
            "SELECT 
                (SELECT COUNT(1) AS count_denouncements FROM denouncement) as count_denouncements,
                (SELECT COUNT(1) AS count_users FROM fos_user) as count_users,
                (SELECT COUNT(1) AS count_maintenance FROM maintenance) as count_maintenance,
                (SELECT COUNT(1) AS count_notifications FROM notification WHERE type=0) as count_vazamento,
                (SELECT COUNT(1) AS count_notifications FROM notification WHERE type=1) as count_faltadagua"
        );
        $statement->execute();
        $results = $statement->fetch();
        $parameters = [
            'dashboard' =>
                [
                    'count_denouncements' => $results['count_denouncements'] ?? 0,
                    'count_users' => $results['count_users'] ?? 0,
                    'count_maintenance' => $results['count_maintenance'] ?? 0,
                    'count_vazamento' => $results['count_vazamento'] ?? 0,
                    'count_faltadagua' => $results['count_faltadagua'] ?? 0,
                ]
            ];

        return $this->render('dashboard/index.html.twig', $parameters);
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
