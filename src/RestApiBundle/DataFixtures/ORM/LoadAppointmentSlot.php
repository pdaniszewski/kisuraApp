<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 18.04.17
 * Time: 22:37
 */

namespace RestApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RestApiBundle\Entity\AppointmentSlot;
use RestApiBundle\Entity\Users;
use \DateTime;

class LoadAppointmentSlotData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // slot 1
        $stylist = $manager->getRepository(Users::class)->find('zxcvbnmasdfghjkl');

        // to skip auto generator for id
        $metadata = $manager->getClassMetadata(AppointmentSlot::class);
        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);

        $slot = new AppointmentSlot();
        $slot->setId(1);
        $slot->setStart(new DateTime('2017-05-01 09:00:00'));
        $slot->setEnd(new DateTime('2017-05-01 10:00:00'));
        $slot->setStatus(1);
        $slot->setStylist($stylist);
        $manager->persist($slot);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}