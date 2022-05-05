<?php

namespace App\Controller;



use App\Entity\Story;
use App\Entity\Tags;
use App\Entity\TagsStory;
use App\Entity\User;
use App\Repository\StoryRepository;
use App\Repository\TagsRepository;
use App\Repository\TagsStoryRepository;
use App\Repository\UserRepository;
use App\Service\StoryService;
use App\Service\UsersService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class StoryController extends ApiBaseController
{

    /**
     * @Route(path="/api/story", name="story_index", methods={"GET"})
     */
    public function index(
        StoryRepository $storyRepository,
        SerializerInterface $serializer,
        Request $request
    ): JsonResponse
    {
        $result = false;
        $stories = $storyRepository->findAll();

        if ($stories === null) {
            $this->jsonNotFound();
        }

        $result = true;

        return $this->json(
            [
                'story' => $stories,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * @Route(path="/api/story/tag", name="story_by_tag", methods={"GET"})
     */
    public function getStoryByTags(
        StoryRepository $storyRepository,
        TagsStoryRepository $tagsStoryRepository,
        TagsRepository $tagsRepository,
        SerializerInterface $serializer,
        Request $request
    ): JsonResponse
    {
        $tag = $request->query->get('tag', '');

        $result = false;
        /** @var Tags $tag */
        $tag = $tagsRepository->findOneBy(['label' => $tag]);


        /** @var TagsStory $storiesByTags */
        $storiesByTags = $tagsStoryRepository->findBy(['idTags' => $tag->getId()]);

        $stories = $storyRepository->findBy(['idStory' => $storiesByTags]);


        $result = true;

        return $this->json(
            [
                'story' => $stories,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * @Route(path="/api/story", name="story_create", methods={"POST"})
     */
    public function create(
        StoryService $storyService,
        SerializerInterface $serializer,
        TagsRepository $tagsRepository,
        Request $request
    ): JsonResponse
    {
        $result = false;
        $story = new Story();

        /** @var Story $story */
        $story = $serializer->deserialize($request->getContent(), Story::class, 'json');

        $user = new User();
        $user = $this->getUser();

        $tag = new Tags();
        $tag = $tagsRepository->findBy(['id' => $story->getTags()]);

        if ($tag === null){
            $story->setTags($tag);
        }
        if ($user === null) {
            $this->jsonNotFound();
        }

        $result = $storyService->create($story, $user);


        return $this->json(
            [
                'story' => $story,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }





    /**
     * @Route(path="/api/story/{guid}", name="story_update", methods={"PUT"})
     */
    public function update(
        string $guid,
        StoryRepository $storyRepository,
        StoryService $storyService,
        SerializerInterface $serializer,
        Request $request
    ): JsonResponse
    {
        $result = false;
        $story = $storyRepository->findOneBy(['guid' => $guid]);

        if ($story === null) {
            $this->jsonNotFound();
        }

        /** @var Story $story */
        $story = $serializer->deserialize($request->getContent(), Story::class, 'json');


        $result = $storyService->update($story);

        return $this->json(
            [
                'story' => $story,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * @Route(path="/api/story/{guid}", name="story_delete", methods={"DELETE"})
     */
    public function delete(
        string $guid,
        StoryRepository $storyRepository,
        StoryService $storyService,
        SerializerInterface $serializer,
        Request $request
    ): JsonResponse
    {
        $result = false;
        $story = $storyRepository->findOneBy(['guid' => $guid]);

        if ($story === null) {
            $this->jsonNotFound();
        }

        /** @var Story $story */
        $story = $serializer->deserialize($request->getContent(), Story::class, 'json');


        $result = $storyService->delete($story);

        return $this->json(
            [
                'story' => $story,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

}
