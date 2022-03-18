<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

use Psr\Log\LoggerInterface;
use Twig\Environment;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private Environment $twig;
    private LoggerInterface $logger;

    public function __construct(Environment $twig, LoggerInterface $logger)
    {
        $this->twig = $twig;
        $this->logger = $logger;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {
        $this->logger->error('access denied exception');

        $template = 'error/accessDenied.html.twig';
        $args = [];
        $html = $this->twig->render($template, $args);
        return new Response($html);
    }
}