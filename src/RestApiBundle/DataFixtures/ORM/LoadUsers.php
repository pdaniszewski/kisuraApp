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
use RestApiBundle\Entity\Users;
use \DateTime;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // user 1
        $curDate = new DateTime();
        $user = new Users();
        $user->setId('zxcvbnmasdfghjkl');
        $user->setFirstname('Paul');
        $user->setPassword('somepass');
        $user->setCreatedAt($curDate);
        $user->setModifiedAt($curDate);
        $user->setEmail('some_email@kisura.com');
        $user->setLastname('Paulowski');
        $user->setGender('male');
        $manager->persist($user);
        $manager->flush();

        // user 2
        $curDate = new DateTime();
        $user = new Users();
        $user->setId('asdfghjklqwertyu');
        $user->setFirstname('Peter');
        $user->setPassword('somepass1');
        $user->setCreatedAt($curDate);
        $user->setModifiedAt($curDate);
        $user->setEmail('client_email@gmail.com');
        $user->setLastname('CLientLastname');
        $user->setGender('male');
        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}