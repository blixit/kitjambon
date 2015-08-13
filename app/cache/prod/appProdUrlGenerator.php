<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appProdUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes = array(
        'kitjambon_comment_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'KITJAMBON\\CommentBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/hello',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'kitjambon_transfert_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'KITJAMBON\\TransfertBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/hello',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'kitjambon_membre_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/test',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'kitjambon_membre_account_restreint' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\AccountController::restrictedAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/membre/restricted',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'kitjambon_site_menu_main' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\MenuController::mainAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/menu/main',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'kitjambon_site_accueil' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'kitjambon_site_accueil2' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\AccueilController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/accueil',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'kitjambon_site_presentation' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\AccueilController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/accueil/persentation/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'nacder_platform_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'nacder\\PlatformBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (    'name' => 'claude',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => 'claude',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/hello',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'nacder_plateform_accueil' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'nacder\\PlatformBundle\\Controller\\AccueilController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/platform/accueil/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
