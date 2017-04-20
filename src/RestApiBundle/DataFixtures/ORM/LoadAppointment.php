<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 19.04.17
 * Time: 12:29
 */

namespace RestApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RestApiBundle\Entity\Appointment;
use RestApiBundle\Entity\AppointmentSlot;
use RestApiBundle\Entity\Users;
use \DateTime;

class LoadAppointmentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // appointment 1
        $curDate = new DateTime();
        $stylist = $manager->getRepository(Users::class)->find('zxcvbnmasdfghjkl');
        $customer = $manager->getRepository(Users::class )->find('asdfghjklqwertyu');
        $slot = $manager->getRepository(AppointmentSlot::class)->find(1);

        $appointment = new Appointment();
        $appointment->setCreatedAt($curDate);
        $appointment->setModifiedAt($curDate);
        $appointment->setStylist($stylist);
        $appointment->setCustomer($customer);
        $appointment->setSlot($slot);
        $appointment->setPhone('03023521552');
        $manager->persist($appointment);
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}