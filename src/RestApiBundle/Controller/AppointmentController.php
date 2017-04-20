<?php

namespace RestApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use RestApiBundle\Entity\Appointment;
use RestApiBundle\Form\AppointmentType;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
* @Route(
 *      "/",
 *      host="localhost"
 * )
 */
class AppointmentController extends FOSRestController
{
    /**
     * @Rest\Get("/appointment/{id}")
     * @Rest\RequestParam(name="id", requirements="\d+", nullable=false, description="appointment id.")
     */
    public function getAction(int $id): Appointment
    {
        // get service and return Appointment
        return $this->get('rest_api.appointment.service')->getAppointment($id);
    }

    /**
     * @Rest\Post("/appointment")
     * @Rest\View(statusCode = 201)
     */
    public function addAction(Request $request): Appointment
    {
        $form = $this->createForm(AppointmentType::class, new Appointment());
        $form->handleRequest($request);

        return $this->get('rest_api.appointment.service')->addAppointment($form);
    }

    /**
     * @Rest\Put("/appointment/{id}")
     * @Rest\RequestParam(name="id", requirements="\d+", nullable=false, description="appointment id.")
     */
    public function editAction(Request $request, int $id)
    {
        $appointment = $this->get('rest_api.appointment.service')->getAppointment($id);

        if($appointment) {
            $form = $this->createForm(AppointmentType::class, $appointment, ['method' => 'PUT']);
            $form->handleRequest($request);

            $this->get('rest_api.appointment.service')->editAppointment($form);

        } else {
            throw new NotFoundHttpException('Appointment with id ' . $id . ' not found.');
        }
    }

    /**
     * @Rest\Delete("/appointment/{id}")
     *
     * @Rest\RequestParam(name="id", requirements="\d+", nullable=false, description="appointment id.")
     *
     * @Rest\View(statusCode=204)
     */
    public function deleteAction(int $id)
    {
        $this->get('rest_api.appointment.service')->deleteAppointment($id);
    }
}
