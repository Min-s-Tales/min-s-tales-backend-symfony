<?php


namespace App\Service;

use App\Entity\Story;
use App\Entity\Tags;
use App\Entity\User;
use App\Repository\StoryRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Validator\Constraints\Uuid;
use function PHPUnit\Framework\any;

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

        $tag = new Tags();

        $tag->setLabel('totot');
        $this->em->persist($tag);
        $this->em->flush();

        $story->setTag($tag);

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
