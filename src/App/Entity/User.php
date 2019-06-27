<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $username;

    /**
     * User constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->setUsername($username);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}