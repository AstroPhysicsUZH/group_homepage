# group_homepage
the new group homepage

Basically a html page based on https://html5boilerplate.com/

There is some php:
- the group member section
- the news
- the update hook (internally)


## Group Members
those are taken from the csv file.
To change stuff, add or remove people, just edit the people/people.csv file
and **make sure to save the file as csv (comma separated)**

(see here for libreoffice: http://superuser.com/questions/717243/libreoffice-is-saving-csv-files-with-tabs-as-separators)


## The news / teaching list
check the `news` folder to quickly add news items or teaching lists. see templates.


## The update hook
(This is the same as in the lisa2016 event homepage)
A push to the github repro makes github trigger (call) the hook url that was entered in this repros settings.
(https://github.com/AstroPhysicsUZH/group_homepage/settings/hooks)

The hook itself is a php script, located here:
./hooks/update_hook.php

It has tree security features:

- it exectures only fixed code in the file, no userinput (and only as user wwwrun)
- it checks if origin ip adress is either github or my computer
- the payload is encrypted with a password entered on the settings page ("secret") that only the server knows about.

It probably leads to a huge mess with user rights and ownership of files in the web folders that poor Roland has to clean up at some point with a `chown -R wwwrun:www *` . I'm sorry about that!


## Install
to (re)install the site:
- copy `init.php` into the root of the directory
- `chmod 777 init.php`
-  fire it up from the machine named taurus using a web browser (or change the fixed ip in the script) `http://www.physik.uzh.ch/groups/jetzer/init.php`

use this command to get the file:
`wget https://raw.githubusercontent.com/AstroPhysicsUZH/group_homepage/master/init.php && chmod 777 init.php`

This will create a new clone of the repro and checks out master branch.
The access to `init.php` will then be prohibited by `.htaccess` file.
To update the page simply push to github organisation...
