<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Entity\User;
use App\Exception\Service\UserNotFoundServiceException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class UserService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var EntityManager
     */
    protected $em;

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
     * @param EntityManager $em
     * @param UserRepository $userRepository
     */
    public function __construct(EntityManager $em, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    /**
     * @param string $username
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addNewUser(string $username): void
    {
        $user = new User($username);
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @param int $userId
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws UserNotFoundServiceException
     */
    public function removeUser(int $userId): void
    {
        $user = $this->userRepository->find($userId);
        if (!$user instanceof User) {
            throw new UserNotFoundServiceException('User with id: '. $userId . ' was not found');
        }

        $this->em->remove($user);
        $this->em->flush();
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