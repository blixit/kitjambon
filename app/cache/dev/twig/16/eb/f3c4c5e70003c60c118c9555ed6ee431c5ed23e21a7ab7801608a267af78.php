<?php

/* nacderPlatformBundle:Accueil:index.html.twig */
class __TwigTemplate_16ebf3c4c5e70003c60c118c9555ed6ee431c5ed23e21a7ab7801608a267af78 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("nacderPlatformBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "nacderPlatformBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $this->displayParentBlock("title", $context, $blocks);
        echo " - Index";
    }

    // line 7
    public function block_body($context, array $blocks = array())
    {
        // line 8
        echo "  Notre plateforme est un peu vide pour le moment, mais cela viendra !
";
    }

    public function getTemplateName()
    {
        return "nacderPlatformBundle:Accueil:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 8,  36 => 7,  29 => 5,);
    }
}
