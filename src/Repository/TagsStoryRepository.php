<?php

namespace App\Repository;


use App\Entity\Tags;
use App\Entity\TagsStory;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TagsStory|null find($id, $lockMode = null, $lockVersion = null)
 * @method TagsStory|null findOneBy(array $criteria, array $orderBy = null)
 * @method TagsStory[]    findAll()
 * @method TagsStory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagsStoryRepository extends AbstractRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TagsStory::class);

        $this->em = $this->getEntityManager();
    }

    public function count(array $criteria): int
    {
        return parent::count($criteria);
    }



}



