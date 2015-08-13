<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/css/c88d111')) {
            // _assetic_c88d111
            if ($pathinfo === '/css/c88d111.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'c88d111',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_c88d111',);
            }

            if (0 === strpos($pathinfo, '/css/c88d111_')) {
                // _assetic_c88d111_0
                if ($pathinfo === '/css/c88d111_menu-imbrique_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'c88d111',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_c88d111_0',);
                }

                if (0 === strpos($pathinfo, '/css/c88d111_s')) {
                    // _assetic_c88d111_1
                    if ($pathinfo === '/css/c88d111_signin_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'c88d111',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_c88d111_1',);
                    }

                    // _assetic_c88d111_2
                    if ($pathinfo === '/css/c88d111_sticky-footer-navbar_3.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'c88d111',  'pos' => 2,  '_format' => 'css',  '_route' => '_assetic_c88d111_2',);
                    }

                }

                if (0 === strpos($pathinfo, '/css/c88d111_bootstrap')) {
                    // _assetic_c88d111_3
                    if ($pathinfo === '/css/c88d111_bootstrap_4.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'c88d111',  'pos' => 3,  '_format' => 'css',  '_route' => '_assetic_c88d111_3',);
                    }

                    // _assetic_c88d111_4
                    if ($pathinfo === '/css/c88d111_bootstrap-social_5.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'c88d111',  'pos' => 4,  '_format' => 'css',  '_route' => '_assetic_c88d111_4',);
                    }

                }

                // _assetic_c88d111_5
                if ($pathinfo === '/css/c88d111_starter-template_6.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'c88d111',  'pos' => 5,  '_format' => 'css',  '_route' => '_assetic_c88d111_5',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/b2e2302')) {
                // _assetic_b2e2302
                if ($pathinfo === '/js/b2e2302.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b2e2302',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_b2e2302',);
                }

                // _assetic_b2e2302_0
                if ($pathinfo === '/js/b2e2302_advertisement_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b2e2302',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_b2e2302_0',);
                }

            }

            if (0 === strpos($pathinfo, '/js/4510f6d')) {
                // _assetic_4510f6d
                if ($pathinfo === '/js/4510f6d.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4510f6d',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_4510f6d',);
                }

                if (0 === strpos($pathinfo, '/js/4510f6d_')) {
                    // _assetic_4510f6d_0
                    if ($pathinfo === '/js/4510f6d_bootstrap.min_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '4510f6d',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_4510f6d_0',);
                    }

                    // _assetic_4510f6d_1
                    if ($pathinfo === '/js/4510f6d_docs.min_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '4510f6d',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_4510f6d_1',);
                    }

                    // _assetic_4510f6d_2
                    if ($pathinfo === '/js/4510f6d_ie10-viewport-bug-workaround_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '4510f6d',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_4510f6d_2',);
                    }

                    if (0 === strpos($pathinfo, '/js/4510f6d_part_4_')) {
                        // _assetic_4510f6d_3
                        if ($pathinfo === '/js/4510f6d_part_4_advertisement_1.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '4510f6d',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_4510f6d_3',);
                        }

                        // _assetic_4510f6d_4
                        if ($pathinfo === '/js/4510f6d_part_4_query_2.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '4510f6d',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_4510f6d_4',);
                        }

                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        // kj_site_homepage
        if (0 === strpos($pathinfo, '/Symfony/hello') && preg_match('#^/Symfony/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'kj_site_homepage')), array (  '_controller' => 'KJ\\SiteBundle\\Controller\\DefaultController::indexAction',));
        }

        // kitjambon_comment_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_comment_homepage')), array (  '_controller' => 'KITJAMBON\\CommentBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/download/view')) {
            // kitjambon_transfert_download_view
            if (preg_match('#^/download/view/(?P<eix>\\d{1})/(?P<abrege>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_transfert_download_view')), array (  '_controller' => 'KITJAMBON\\TransfertBundle\\Controller\\DownloadController::viewAction',));
            }

            // kitjambon_transfert_download_view2
            if (preg_match('#^/download/view/(?P<eix>\\d{1})/(?P<abrege>[^/]++)/(?P<dir>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_transfert_download_view2')), array (  '_controller' => 'KITJAMBON\\TransfertBundle\\Controller\\DownloadController::viewAction',));
            }

        }

        // kitjambon_membre_homepage
        if (0 === strpos($pathinfo, '/test') && preg_match('#^/test/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_membre_homepage')), array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\DefaultController::indexAction',));
        }

        // kitjambon_membre_account_restreint
        if ($pathinfo === '/membre/restricted') {
            return array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\AccountController::restrictedAction',  '_route' => 'kitjambon_membre_account_restreint',);
        }

        // kitjambon_membre_account_adblockrestreint
        if ($pathinfo === '/adblockRestricted') {
            return array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\AccountController::adblockRestrictedAction',  '_route' => 'kitjambon_membre_account_adblockrestreint',);
        }

        if (0 === strpos($pathinfo, '/me')) {
            if (0 === strpos($pathinfo, '/membre')) {
                // kitjambon_membre_membre_view
                if (0 === strpos($pathinfo, '/membre/view') && preg_match('#^/membre/view/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_membre_membre_view')), array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\MembreController::viewAction',));
                }

                // kitjambon_membre_membre_profil
                if (0 === strpos($pathinfo, '/membre/profil') && preg_match('#^/membre/profil/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_membre_membre_profil')), array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\MembreController::profilAction',));
                }

                if (0 === strpos($pathinfo, '/membre/liste')) {
                    // kitjambon_membre_membre_liste
                    if (preg_match('#^/membre/liste(?:/(?P<page>\\d+))?$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_membre_membre_liste')), array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\MembreController::listeAction',  'page' => 1,  'eix' => 1,));
                    }

                    // kitjambon_membre_membre_liste2
                    if (preg_match('#^/membre/liste(?:/(?P<page>\\d+)(?:/(?P<eix>\\d{1}))?)?$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_membre_membre_liste2')), array (  '_controller' => 'KITJAMBON\\MembreBundle\\Controller\\MembreController::listeAction',  'page' => 1,  'eix' => 1,));
                    }

                }

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

            return array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\AccueilController::indexAction',  '_route' => 'kitjambon_site_accueil',);
        }

        if (0 === strpos($pathinfo, '/accueil')) {
            // kitjambon_site_accueil2
            if ($pathinfo === '/accueil') {
                return array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\AccueilController::indexAction',  '_route' => 'kitjambon_site_accueil2',);
            }

            // kitjambon_site_presentation
            if ($pathinfo === '/accueil/persentation') {
                return array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\AccueilController::indexAction',  '_route' => 'kitjambon_site_presentation',);
            }

        }

        if (0 === strpos($pathinfo, '/cours')) {
            // kitjambon_site_cours_index
            if ($pathinfo === '/cours') {
                return array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\CoursController::indexAction',  '_route' => 'kitjambon_site_cours_index',);
            }

            // kitjambon_site_cours_view
            if (0 === strpos($pathinfo, '/cours/view') && preg_match('#^/cours/view/(?P<eix>\\d{1})$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'kitjambon_site_cours_view')), array (  '_controller' => 'KITJAMBON\\SiteBundle\\Controller\\CoursController::viewAction',));
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

        // _welcome
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_welcome');
            }

            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\WelcomeController::indexAction',  '_route' => '_welcome',);
        }

        if (0 === strpos($pathinfo, '/demo')) {
            if (0 === strpos($pathinfo, '/demo/secured')) {
                if (0 === strpos($pathinfo, '/demo/secured/log')) {
                    if (0 === strpos($pathinfo, '/demo/secured/login')) {
                        // _demo_login
                        if ($pathinfo === '/demo/secured/login') {
                            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::loginAction',  '_route' => '_demo_login',);
                        }

                        // _demo_security_check
                        if ($pathinfo === '/demo/secured/login_check') {
                            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => '_demo_security_check',);
                        }

                    }

                    // _demo_logout
                    if ($pathinfo === '/demo/secured/logout') {
                        return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::logoutAction',  '_route' => '_demo_logout',);
                    }

                }

                if (0 === strpos($pathinfo, '/demo/secured/hello')) {
                    // acme_demo_secured_hello
                    if ($pathinfo === '/demo/secured/hello') {
                        return array (  'name' => 'World',  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',  '_route' => 'acme_demo_secured_hello',);
                    }

                    // _demo_secured_hello
                    if (preg_match('#^/demo/secured/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',));
                    }

                    // _demo_secured_hello_admin
                    if (0 === strpos($pathinfo, '/demo/secured/hello/admin') && preg_match('#^/demo/secured/hello/admin/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello_admin')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloadminAction',));
                    }

                }

            }

            // _demo
            if (rtrim($pathinfo, '/') === '/demo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_demo');
                }

                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::indexAction',  '_route' => '_demo',);
            }

            // _demo_hello
            if (0 === strpos($pathinfo, '/demo/hello') && preg_match('#^/demo/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::helloAction',));
            }

            // _demo_contact
            if ($pathinfo === '/demo/contact') {
                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::contactAction',  '_route' => '_demo_contact',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
