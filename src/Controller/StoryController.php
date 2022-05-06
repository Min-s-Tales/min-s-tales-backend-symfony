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
use Symfony\Component\Routing\Annotation\Route;
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
        $stories = $storyRepository->findAll(); //get any stories

        if ($stories === null) {
            $this->jsonNotFound(); // return json not found is story is null
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
        $tag = $request->query->get('tag', ''); // get tag in query

        $result = false;
        /** @var Tags $tag */
        $tag = $tagsRepository->findOneBy(['label' => $tag]); // get tag by label


        /** @var TagsStory $storiesByTags */
        $storiesByTags = $tagsStoryRepository->findBy(['idTags' => $tag->getId()]); // get stories id by tag id

        $stories = [];
        /** @var TagsStory $i */
        foreach ($storiesByTags as $i) {
            $story = $storyRepository->findOneBy(['idStory' => $i->getIdStory()]); // get stories by story id
            $stories[] = $story;
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
        $story = $serializer->deserialize($request->getContent(), Story::class, 'json'); //get content by json

        $user = new User();
        $user = $this->getUser(); // get user by token

        $tag = new Tags();
        $tag = $tagsRepository->findBy(['id' => $story->getTags()]); // get tags

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
        $story = $storyRepository->findOneBy(['guid' => $guid]); // get story by guid

        if ($story === null) {
            $this->jsonNotFound();
        }

        /** @var Story $story */
        $story = $serializer->deserialize($request->getContent(), Story::class, 'json');


        $result = $storyService->update($story); // update story

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
        $story = $storyRepository->findOneBy(['guid' => $guid]); // get story by guid

        if ($story === null) {
            $this->jsonNotFound();
        }

        /** @var Story $story */
        $story = $serializer->deserialize($request->getContent(), Story::class, 'json');


        $result = $storyService->delete($story); // delete story by guid

        return $this->json(
            [
                'story' => $story,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

}
