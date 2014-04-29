<?php
namespace Campsite\AdminBundle\Twig\Extension;
 
use Symfony\Component\DependencyInjection\ContainerInterface;
 
class MenuExtension extends \Twig_Extension
{
  protected $container;
  
  /**
   * default constructor to accept container
   * 
   * @param ContainerInterface $container 
   */
  public function __construct( ContainerInterface $container )
  {
    $this->container = $container;
  }
  
  /**
   * set extension name
   * 
   * @return String
   */
  public function getName()
  {
    return 'cervantes.menuExtension';
  }
  
  /**
   * register new functions
   * 
   * @return array
   */
  public function getFunctions()
  {
    return array( 
      'mActive' => new \Twig_Function_Method($this, 'activeMenu'),
      'mControllerActive' => new \Twig_Function_Method($this, 'controllerActive'),
      'mBundleActive' => new \Twig_Function_Method($this, 'bundleActive'),
    );
  }
  
  /**
   * checks if the given route is used
   * 
   * @param String $url - route
   * 
   * @return boolean
   */
  public function activeMenu( $url )
  {
    $request = $this->container->get('request');
    $request_url = $request->attributes->get('_route');
    
    return ($request_url == $url) ? true : false;
  }
  
  /**
   * checks if the given controller is used
   * 
   * @param String $controller
   * 
   * @return boolean
   */
  public function controllerActive( $controller )
  {
    $request = $this->container->get('request');
    
    // we only need the real controller name without function (Campsite\AdminBundle\Controller\CategoryController::indexAction)
    $request_controller = explode( '::', $request->attributes->get('_controller') );
    $request_controller = $request_controller[0];
    
    return ($request_controller == $controller) ? true : false;
  }
  
  public function bundleActive( $bundleName )
  {
    $request = $this->container->get('request');
    $request_url = $request->attributes->get('_template');
    $tplParts = explode(':', $request_url);
    
    return ($tplParts[0] == $bundleName) ? true : false;
  }
}