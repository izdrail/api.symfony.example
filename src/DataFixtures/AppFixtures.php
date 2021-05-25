<?php


namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture implements ContainerAwareInterface
{
    protected $container;


    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadBooks($manager);
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    private function loadBooks(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $book = new Expense();
            $book->setDescription("Some description of the expense  {$i}");
            $book->setValue(random_int(10, 100));
            $manager->persist($book);
        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadUsers(ObjectManager $manager): void
    {
        $passwordEncoder = $this->container->get('security.password_encoder');
        $userAdmin = new User();
        $userAdmin->setName('admin');
        $userAdmin->setSurname('admin');
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('admin@admin.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $encodedPassword = $passwordEncoder->encodePassword($userAdmin, 'admin');
        $userAdmin->setPassword($encodedPassword);
        $manager->persist($userAdmin);
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null): void
    {
        $this->container = $container;
    }


}
