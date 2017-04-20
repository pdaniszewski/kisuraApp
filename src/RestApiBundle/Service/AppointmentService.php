<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 19.04.17
 * Time: 15:47
 */

namespace RestApiBundle\Service;

use Doctrine\ORM\EntityManager;
use RestApiBundle\Entity\Appointment;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AppointmentService
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @var EntityManager
     */
    public $em;

    /**
     * get entity manager
     *
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->em;
    }

    /**
     * @param int $id
     * @return Appointment
     *
     * @throws NotFoundHttpException
     */
    public function getAppointment(int $id): Appointment
    {
        $appointment = $this->getEntityManager()->getRepository(Appointment::class)->find($id);

        if (!$appointment instanceof Appointment) {
            throw new NotFoundHttpException("Appointment doesn't exist.");
        }

        return $appointment;
    }

    /**
     * @param Form $form
     * @return Appointment
     *
     * @throws BadRequestHttpException
     */
    public function addAppointment(Form $form): Appointment
    {
        /** @var Appointment $appointment */
        $appointment = $form->getData();

        $curDate = new \DateTime();
        $appointment->setModifiedAt($curDate);
        $appointment->setCreatedAt($curDate);

        if ($form->isValid())
        {
            $this->saveAppointment($form->getData());
            return $form->getData();
        } else {
            throw new BadRequestHttpException();
        }

    }

    /**
     * @param Form $form
     * @return Appointment
     *
     * @throws BadRequestHttpException
     */
    public function editAppointment(Form $form): Appointment
    {
        /** @var Appointment $appointment */
        $appointment = $form->getData();

        $curDate = new \DateTime();
        $appointment->setModifiedAt($curDate);
        $appointment->setCreatedAt($curDate);

        if ($form->isValid())
        {
            $this->saveAppointment($appointment);
            return $form->getData();
        } else {
            throw new BadRequestHttpException();
        }
    }

    public function deleteAppointment(int $id)
    {
        $appointment = $this->getAppointment($id);

        if($appointment) {
            $this->removeAppointment($appointment);
        } else {
            throw new NotFoundHttpException('Appointment with id ' . $id . ' not found.');
        }
    }

    private function saveAppointment(Appointment $appointment)
    {
        $em = $this->getEntityManager();
        $em->persist($appointment);
        $em->flush();
    }

    private function removeAppointment(Appointment $appointment)
    {
        $em = $this->getEntityManager();
        $em->remove($appointment);
        $em->flush();
    }

}
