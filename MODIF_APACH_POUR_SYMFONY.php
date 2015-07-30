Modifications pour Symfony

Welcome to your new Symfony project.
This script will guide you through the basic configuration of your project. You can also do the same by editing the ‘app/config/parameters.yml’ file directly.
RECOMMENDATIONS
To enhance your Symfony experience, it’s recommended that you fix the following:
Set "xdebug.max_nesting_level" to e.g. "250" in php.ini* to stop Xdebug's infinite recursion protection erroneously throwing a fatal error in your project.
Install and/or enable a PHP accelerator (highly recommended).
Set "realpath_cache_size" to e.g. "1024" in php.ini* to improve performance on windows.
* Changes to the php.ini file must be done in "C:\wamp\bin\apache\apache2.4.9\bin\php.ini".


Ajouter xcache.ini à php.ini
