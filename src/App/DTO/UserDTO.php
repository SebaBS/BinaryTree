<?php


namespace App\DTO;


class UserDTO extends AbstractDTO implements NodeContentDTO
{
    /**
     * @var string
     */
    protected $username;

    /**
     * UserDTO constructor.
     *
     * @param int $id
     * @param string $username
     */
    public function __construct(int $id, string $username)
    {
        $this->setUsername($username);
        parent::__construct($id);
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

    public function toArray(): array
    {
        $parent = parent::toArray();
        return array_merge($parent, [
            'username' => $this->getUsername()
        ]);
    }
}