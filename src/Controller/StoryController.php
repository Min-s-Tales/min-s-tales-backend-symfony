<?php

namespace App\Controller;



use App\Repository\UserRepository;
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
     * @Route(path="/api/story", name="story_create", methods={"Post"})
     */
    public function create(): JsonResponse
    {
        $result = false;
        $history = $this->getUser();

        return $this->json(
            [
                'history' => $history,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

}
