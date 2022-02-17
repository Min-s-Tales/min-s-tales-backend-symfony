<?php

namespace App\Repository;


use App\Entity\User;
use App\Repository\AbstractRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends AbstractRepository
{

    public function __construct(ManagerRegistry $registry, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct($registry, User::class);

        $this->em = $this->getEntityManager();
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        $criteria['deletedAt'] = null;
        /** @var User $user */
        $user = parent::findOneBy($criteria, $orderBy);

        return $user;
    }

    public function count(array $criteria): int
    {
        $criteria['deletedAt'] = null;
        return parent::count($criteria);
    }


    public function findOneByUsername(string $username): ?User
    {
        return $this->findOneBy(['username' => $username]);
    }




}



