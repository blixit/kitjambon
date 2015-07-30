<?php

/* nacderPlatformBundle:Layouts:default.html.twig */
class __TwigTemplate_2822503cf603a11a011764cf6f9486f5b536fb3266f827458280eb3d89415ca6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<head>
<title>";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : $this->getContext($context, "title")), "html", null, true);
        echo "</title>
</head>
<body>
";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["contenu"]) ? $context["contenu"] : $this->getContext($context, "contenu")), "html", null, true);
        echo "
";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["footer"]) ? $context["footer"] : $this->getContext($context, "footer")), "html", null, true);
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "nacderPlatformBundle:Layouts:default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 7,  29 => 6,  23 => 3,  19 => 1,);
    }
}
