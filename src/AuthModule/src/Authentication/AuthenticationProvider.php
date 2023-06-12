<?php

namespace AuthModule\Authentication;

use AuthModule\Entity\User;
use AuthModule\Service\AuthService;
use Doctrine\ORM\EntityManager;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Mezzio\ProblemDetails\ProblemDetailsResponseFactory;
use Mezzio\Session\SessionInterface;
use Mezzio\Session\SessionMiddleware;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticationProvider implements AuthenticationInterface
{
    private ResponseFactoryInterface $responseFactory;
    private array $config;
    private mixed $user;
    private AuthService $authService;

    private EntityManager $em;

    private ProblemDetailsResponseFactory $problemDetailsResponseFactory;

    public function __construct(
        array $config,
        ResponseFactoryInterface $responseFactory,
        mixed $user,
        EntityManager $em,
        AuthService $authService,
        ProblemDetailsResponseFactory $problemDetailsResponseFactory
    ) {
        $this->config = $config;
        $this->responseFactory = $responseFactory;
        $this->user = $user;
        $this->em = $em;
        $this->authService = $authService;
        $this->problemDetailsResponseFactory = $problemDetailsResponseFactory;
    }

    public function authenticate(ServerRequestInterface $request): ?UserInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if ($session->has(UserInterface::class)) {
            return $this->createUserFromSession($session);
        }


        if ($request->getRequestTarget() == '/api/login') {
            if ($request->getHeaderLine('Content-Type') == 'application/json') {
                $params = json_decode($request->getBody(), true);
            } else {
                $params = $request->getParsedBody();
            }
            if (isset($params['username']) && isset($params['password'])) {
                $userRepo = $this->em->getRepository(User::class);
                $foundUser = $userRepo->findOneBy(['username' => $params['username']]);
                if (!$foundUser instanceof User) {
                    return null;
                }

                $checkPassword = $this->authService->verify(
                    $params['password'],
                    $foundUser->getPassword()
                );

                if (!$checkPassword) {
                    return null;
                }

                $identity = new AuthenticatedIdentity($foundUser);

                $session->set(UserInterface::class, $identity);
                $session->regenerate();
                return $identity;
            }

            //TODO: Implements API Key
        }

        //Guest
        $guest = $this->em->find(User::class, User::GUEST_USER_ID);
        return new AuthenticatedIdentity($guest);
    }

    public function unauthorizedResponse(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getHeaderLine('Content-type') == 'application/json') {
            return $this->problemDetailsResponseFactory->createResponse($request, 403, 'Unauthorized');
        } else {
            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(
                    'Location',
                    '/unauthorized'
                );
        }
    }

    private function createUserFromSession(SessionInterface $session): ?UserInterface
    {
        $userInfo = $session->get(UserInterface::class);
        if (! is_array($userInfo) || ! isset($userInfo['identity'])) {
            return null;
        }

        return new AuthenticatedIdentity($userInfo);
    }
}
