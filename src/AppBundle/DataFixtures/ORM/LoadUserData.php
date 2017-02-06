<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('tJullion');
        $user->setEmail('tjullion@test.com');
        $user->setPlainPassword('test');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));

        $userManager->updateUser($user, true);

        $user = $userManager->createUser();
        $user->setUsername('bHill');
        $user->setEmail('bhill@test.com');
        $user->setPlainPassword('test');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));

        $userManager->updateUser($user, true);

        $user = $userManager->createUser();
        $user->setUsername('sGourier');
        $user->setEmail('sgourier@test.com');
        $user->setPlainPassword('test');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));

        $userManager->updateUser($user, true);

        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@test.com');
        $user->setPlainPassword('test');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));

        $userManager->updateUser($user, true);
    }
}
