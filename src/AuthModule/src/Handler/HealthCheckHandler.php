<?php

declare(strict_types=1);

namespace AuthModule\Handler;

use Mezzio\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class HealthCheckHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        $session = $request->getAttribute(
            SessionInterface::class
        );

        $session->persistSessionFor(60 * 60 * 24 * 7); // persist for 7 days

        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'auth-module::healt-check',
            [] // parameters to pass to template
        ));
    }
}
