<?php

namespace App\Controller;



use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UsersService;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UsersController extends ApiBaseController
{
    /**
     * @Route(path="/users/register", name="register_users", methods={"Post"})
     */
    public function register(
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
        $user->setPassword($hashedPassword);
        $result = $usersService->create($user);

        return $this->json(
            [
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * @Route(path="/users/login", name="login_users", methods={"Post"})
     */
    public function login(
        AuthenticationUtils $authenticationUtils,
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse
    {
        $result = false;
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = $userRepository->findOneBy(['email' => $email]);

        dump($password);
        dump($password);
        $hashedPassword = $passwordHasher->hashPassword($user ,$password);

        if($hashedPassword === $user->getPassword()){
            dd('theo');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

//        $result = $u->login($user);

        return $this->json(
            [
                'user' => $user,
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }



}
