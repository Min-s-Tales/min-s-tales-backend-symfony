<?php


namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UsersService
{
    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    public function __construct(
        EntityManagerInterface $em,
        UserRepository $userRepository
    )
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
    }

    public function create(User $user): bool
    {

        $this->em->persist($user);
        $this->em->flush();

        return true;
    }

    public function login(User $user): bool
    {


        return true;
    }

    public function update(User $user): bool
    {

        return true;
    }

    public function delete(User $user): bool
    {


        return true;
    }
}
