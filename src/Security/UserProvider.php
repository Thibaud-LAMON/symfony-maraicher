<?php

namespace App\Security;

use App\Entity\Admins;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\Service\DatabaseConnection;


class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    private $databaseConnection;

    public function __construct(DatabaseConnection $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }
    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me.
     *
     * If you're not using these features, you do not need to implement
     * this method.
     *
     * @throws UserNotFoundException if the user is not found
     */
    public function loadUserByIdentifier($identifier): UserInterface
    {
        // récupére les données de l'utilisateur
        $stmt = $this->databaseConnection->getConnection()->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->execute(['username' => $identifier]);

        $userData = $stmt->fetch();

        if ($userData) {
            $user = new Admins();
            $user->setUsername($userData['username']);
            $user->setPassword($userData['password']);

            return $user;
        }

        throw new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
    }


    /**
     * @deprecated since Symfony 5.3, loadUserByIdentifier() is used instead
     */
    public function loadUserByUsername($username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof Admins) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', $user::class));
        }

        // Recharge les données de l'utilisateur comme dans loadUserByIdentifier
        return $this->loadUserByIdentifier($user->getUsername());
    }


    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass(string $class): bool
    {
        return Admins::class === $class || is_subclass_of($class, Admins::class);
    }

    /**
     * Upgrades the hashed password of a user, typically for using a better hash algorithm.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // Mettre à jour le mot de passe hashé dans la base de données
        $stmt = $this->databaseConnection->getConnection()->prepare("UPDATE admins SET password = :password WHERE username = :username");
        $stmt->execute([
            'password' => $newHashedPassword,
            'username' => $user->getUsername(),
        ]);

        $user->setPassword($newHashedPassword);
    }

}
