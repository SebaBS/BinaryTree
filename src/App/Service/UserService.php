<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Entity\User;
use App\Repository\UserRepository;

class UserService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserDTO $user1
     * @param UserDTO $user2
     * @return int
     */
    public static function compareUserDTOs(UserDTO $user1, UserDTO $user2): int
    {
        if($user1->getUsername() == $user2->getUsername()) {
            return 0;
        }
        return ($user1->getUsername() < $user2->getUsername()) ? -1 : 1;
    }

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    /**
     * @return UserDTO[]|array
     */
    public function findAllUsers(): array
    {
        /** @var User[] $users */
        $users = $this->userRepository->findAll();
        $result = [];
        foreach ($users as $user) {
            $result[] = $this->buildUserDtoFromUser($user);
        }

        return $result;
    }

    /**
     * @param User $user
     * @return UserDTO
     */
    protected function buildUserDtoFromUser(User $user): UserDTO
    {
        return new UserDTO(
            $user->getId(),
            $user->getUsername()
        );
    }

}