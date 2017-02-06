<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 06/02/2017
 * Time: 15:03
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\EventCategory;


class LoadEventCategoriesData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $cat1 = new EventCategory();
        $cat2 = new EventCategory();
        $cat3 = new EventCategory();
        $cat4 = new EventCategory();

        $cat1->setName('fête');
        $cat1->setColor('000');

        $cat2->setName('apero');
        $cat2->setColor('00ff00');

        $cat3->setName('dîner');
        $cat3->setColor('0000ff');

        $cat4->setName('anniversaire');
        $cat4->setColor('ff0000');

        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);
        $manager->persist($cat4);

        $manager->flush();
    }
}