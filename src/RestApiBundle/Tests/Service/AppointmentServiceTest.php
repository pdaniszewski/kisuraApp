<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 20.04.17
 * Time: 17:16
 */

namespace RestApiBundle\Tests\Service;

use RestApiBundle\Entity\Users;
use RestApiBundle\Entity\AppointmentSlot;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use RestApiBundle\Service\AppointmentService;
use Doctrine\ORM\EntityManager;
use RestApiBundle\Entity\Appointment;
use RestApiBundle\Form\AppointmentType;
use Symfony\Component\HttpFoundation\Request;

class AppointmentServiceTest extends KernelTestCase
{
    protected $container;
    protected $appointmentService;
    protected $mockAppointmentService;
    protected $entityManager;

    public function setUp()
    {
        self::bootKernel();
        $this->container = self::$kernel->getContainer();

        $this->appointmentService = $this->container->get('rest_api.appointment.service');

        $entityManager = $this->container->get('doctrine.orm.entity_manager');
        $this->entityManager = $entityManager;
        $this->mockAppointmentService = $this->getMockBuilder(AppointmentService::class)
                                            ->setMethods(['saveAppointment', 'removeAppointment'])
                                            ->enableOriginalConstructor()
                                            ->setConstructorArgs([$entityManager])
                                            ->getMock();
    }

    public function testGetEntityManager()
    {
        $em = $this->mockAppointmentService->getEntityManager();

        $this->assertInstanceOf(EntityManager::class, $em);
    }

    public function testGetAppointment()
    {
        $appointment = $this->mockAppointmentService->getAppointment(1);

        $this->assertInstanceOf(Appointment::class, $appointment);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetAppointmentThrowException()
    {
        $appointment = $this->mockAppointmentService->getAppointment(10000);
    }

    public function testEditAppointment()
    {
        $appointment = $this->entityManager->getRepository(Appointment::class)->find(1);

        // setup form data and change phone number
        $formData = [
            'phone' => '333333333333'
        ];

        $form = $this->container->get('form.factory')->create(AppointmentType::class, $appointment, ['method' => 'PUT']);

        $form->submit($formData);

        $appointment = $this->mockAppointmentService->editAppointment($form);
        $this->assertInstanceOf(Appointment::class, $appointment);

        $this->assertEquals('333333333333', $appointment->getPhone());
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function testEditAppointmentThrowException()
    {
        $appointment = $this->entityManager->getRepository(Appointment::class)->find(1);

        // setup form data and change phone number
        $formData = [
            'phone' => '333333333333'
        ];

        $form = $this->container->get('form.factory')->create(AppointmentType::class, $appointment, ['method' => 'PUT']);

        $this->mockAppointmentService->editAppointment($form);
    }

    public function testAddAppointment()
    {
        $formData = [
            'phone' => '4444444444',
            'createdAt' => new \DateTime(),
            'modifiedAt' => new \DateTime(),
            'slot' => 1,
            'customer' => 'asdfghjklqwertyu',
            'stylist' => 'zxcvbnmasdfghjkl'
        ];

        $form = $this->container->get('form.factory')->create(AppointmentType::class, new Appointment());

        $form->submit($formData);
        $appointment = $this->mockAppointmentService->addAppointment($form);
        $this->assertInstanceOf(Appointment::class, $appointment);

        $this->assertEquals('4444444444', $appointment->getPhone());
    }

    public function testDeleteAppointment()
    {
        $res = $this->mockAppointmentService->deleteAppointment(1);
        $this->assertTrue($res);
    }

}