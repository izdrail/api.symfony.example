<?php

namespace App\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

/**
 * Class ApiUserProvider
 * @package App\Security\User
 */
class ApiUserProvider implements UserProviderInterface
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadUserByUsername($username): ?UserInterface
    {
        $userData =  $this->entityManager->getRepository(User::class)->findByUsernameOrEmail($username);

        if (null !== $userData) {

            $userData->getRoles();

            return $userData;
        }

        throw new UsernameNotFoundException(
           sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class): bool
    {
        return User::class === $class;
    }
}
