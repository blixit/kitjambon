<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/hello')) {
            // kitjambon_comment_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_comment_homepage')), array (  '_controller' => 'KITJAMBON\\CommentBundle\\Controller\\DefaultController::indexAction',));
            }

            // kitjambon_transfert_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_transfert_homepage')), array (  '_controller' => 'KITJAMBON\\TransfertBundle\\Controller\\DefaultController::indexAction',));
            }

        }

        // kitjambon_membre_homepage
        if (0 === strpos($pathinfo, '/test') && preg_match('#^/test/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_membre_homepage')), array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/me')) {
            // kitjambon_membre_account_restreint
            if ($pathinfo === '/membre/restricted') {
                return array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\AccountController::restrictedAction',  '_route' => 'kitjambon_membre_account_restreint',);
            }

            // kitjambon_site_menu_main
            if ($pathinfo === '/menu/main') {
                return array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\MenuController::mainAction',  '_route' => 'kitjambon_site_menu_main',);
            }

        }

        // kitjambon_site_accueil
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'kitjambon_site_accueil');
            }

            return array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\DefaultController::indexAction',  '_route' => 'kitjambon_site_accueil',);
        }

        if (0 === strpos($pathinfo, '/accueil')) {
            // kitjambon_site_accueil2
            if (preg_match('#^/accueil/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_site_accueil2')), array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\AccueilController::indexAction',));
            }

            // kitjambon_site_presentation
            if (rtrim($pathinfo, '/') === '/accueil/persentation') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'kitjambon_site_presentation');
                }

                return array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\AccueilController::indexAction',  '_route' => 'kitjambon_site_presentation',);
            }

        }

        // nacder_platform_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>claude)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nacder_platform_homepage')), array (  '_controller' => 'nacder\\PlatformBundle\\Controller\\DefaultController::indexAction',));
        }

        // nacder_plateform_accueil
        if (rtrim($pathinfo, '/') === '/platform/accueil') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'nacder_plateform_accueil');
            }

            return array (  '_controller' => 'nacder\\PlatformBundle\\Controller\\AccueilController::indexAction',  '_route' => 'nacder_plateform_accueil',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
