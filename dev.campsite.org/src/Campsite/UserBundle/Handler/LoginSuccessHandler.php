<?php

namespace Campsite\UserBundle\Handler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

/**
 * LoginSuccessHandler
 */
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
  /**
   * The router
   *
   * @var Symfony\Component\Routing\Router
   */
  protected $router;

  /**
   *
   * The secutiry
   *
   * @var Symfony\Component\Security\Core\SecurityContext
   */
  protected $security;

  /**
   * Constructor
   *
   * @param Router          $router   The router object
   * @param SecurityContext $security The security object
   */
  public function __construct(Router $router, SecurityContext $security)
  {
    $this->router = $router;
    $this->security = $security;
  }

  /**
   * onAuthenticationSuccess function which is invoked after user is authenticated
   *
   * @param Request        $request The request object
   * @param TokenInterface $token   The tokeninterface object
   *
   * @see Symfony\Component\Security\Http\Authentication.AuthenticationSuccessHandlerInterface::onAuthenticationSuccess()
   *
   * @return Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function onAuthenticationSuccess(Request $request, TokenInterface $token)
  {
    $userCookie = array(
      'name'  => 'Timeout',
      'value' => 'Timeout',
    );

    $response = new Response();
    $response->headers->setCookie(new Cookie($userCookie['name'], $userCookie['value']));
    $response->send();

    //$cookies = $response->headers->getCookies();
    return new RedirectResponse($this->router->generate('category'));
  }

}