# Red-Child
Red Child is a League APi Web Interface Tool

We'll be using a few tools to do this, but first you'll need Composer and PHP at the very least. If you get Composer from their website just use their .exe or manual methods to install.

Then pull down this repo and use the Compser install/update from command line in that directory. Do not include the vendor directory into this repo it should be in the `.gitignore` file.

# Installation

Open terminal:
```
git clone git@github.com:loney89/red-child.git
cd red-child
composer install
```

Then open your Apache configuration and add a Virtual Host configuration;
```
<VirtualHost *:80>
	ServerName redchild.dev
	DocumentRoot /path/to/red-child/public
</VirtualHost>
```

Add the developer domain into your computer's host file so you're computer knows where to find the website on the internet (ie - your computer)

On Mac OX edit `/private/etc/hosts` on Linux `/etc/hosts` on Windows `C:\windows\system32\drivers\etc\hosts`


#Folder structure

```
+-- app
|   +-- Application Code 
+-- tests
|   +-- Unit, Integration and Functional Tests to test Application Code
+-- public
|   +-- The Web Root (where Apache or Nginx is configured to use) store any JS and CSS in here for the brower.
|   +-- index.php -- index file that kicks off the website
|   +-- .htaccess -- used to define any rewrite rules
+-- composer.json
```

Used currently:

#Silex
Something aboot Silex
#Guzzle
Something about Guzzle
#Monolog
Something about Monolog
#Twig
Something about Twig
#Doctrine
Something about Doctrine
