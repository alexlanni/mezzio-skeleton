<?php

declare(strict_types=1);

namespace AuthModule\Handler;

use AuthModule\Hal\Entity\LoginResource;
use Mezzio\Hal\HalResponseFactory;
use Mezzio\Hal\ResourceGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class LoginHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    private ResourceGenerator $resourceGenerator;

    private HalResponseFactory $responseFactory;

    public function __construct(
        TemplateRendererInterface $renderer,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory
    ) {
        $this->renderer = $renderer;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $loginHal = new LoginResource();
        $loginHal->setEmail('aaa@aaa.com');

        $entity = $this->resourceGenerator->fromObject(
            $loginHal,
            $request
        );

        return $this->responseFactory->createResponse($request, $entity, );
    }
}
