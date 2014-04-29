<?php

namespace Campsite\UserBundle\Handler;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * LogoutSuccessHandler
 */
class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
  /**
   * The router
   *
   * @var Symfony\Component\Routing\Router
   */
  protected $router;

  /**
   * Constructor
   *
   * @param Router $router The router object
   */
  public function __construct(Router $router)
  {
    $this->router = $router;
  }

  /**
   * onLogoutSuccess function which is invoked before user logges out
   *
   * @param Request $request The request object
   *
   * @see Symfony\Component\Security\Http\Logout.LogoutSuccessHandlerInterface::onLogoutSuccess()
   *
   * @return Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function onLogoutSuccess(Request $request)
  {
    $cookie = new Cookie('Timeout', null);

    $response = new Response();
    $response->headers->setCookie($cookie);
    $response->send();

    $response = new RedirectResponse($this->router->generate('fos_user_security_login'));

    return $response;
  }

}