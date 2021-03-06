<?php

namespace App\Controller;



use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UsersService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
//use Symfony\Component\Mailer\MailerInterface;


class UsersController extends ApiBaseController
{
    /**
     * @Route(path="/users", name="list_users", methods={"Get"})
     */
    public function test():JsonResponse{
        return $this->json(['test'=>'test']);
    }


    /**
     * @Route(path="/user/register", name="register_users", methods={"Post"})
     */
    public function register(
        //MailerInterface $mailer,
        UsersService $usersService,
        UserPasswordHasherInterface $passwordHasher,
        SerializerInterface $serializer,
        Request $request): JsonResponse
    {
        $result = false;
        $user = new User();
        /** @var User $user */
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');

        $hashedPassword = $passwordHasher->hashPassword($user ,$user->getPassword());
        $user->setPassword($hashedPassword); // hash password in user and set in user
        $result = $usersService->create($user); // create user


        return $this->json(
            [
                'result' => $result,
                'user' => $user,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * @Route(path="/api/user/login", name="login_users", methods={"Post"})
     */
    public function login(): JsonResponse
    {
        $result = false;
        $user = $this->getUser(); // get token

        return $this->json(
            [
                'user' => $user,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

}
