<?php


namespace App\Service;

use App\Entity\Story;
use App\Entity\User;
use App\Repository\StoryRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class StoryService
{
    private EntityManagerInterface $em;
    private StoryRepository $storyRepository;

    public function __construct(
        EntityManagerInterface $em,
        StoryRepository $storyRepository
    )
    {
        $this->em = $em;
        $this->storyRepository = $storyRepository;
    }

    public function create(Story $story): bool
    {

        $this->em->persist($story);
        $this->em->flush();

        return true;
    }


    public function update(Story $story): bool
    {
        $this->em->persist($story);
        $this->em->flush();

        return true;
    }

    public function delete(Story $story): bool
    {
        $this->em->remove($story);
        $this->em->flush();

        return true;
    }
}
