About the Project
===============

This project is focused on adjustments on the original AMFEXT project from Emanuele Ruffaldi posted on PECL. You can check it in this address: http://pecl.php.net/package/amfext.

The main purpose is to mantain compatibility with new versions of PHP.

We currently have the following branches:

Master - Tested with PHP 5.4.x and PHP 5.6.2

PHP53x - Compatible with PHP 5.3.x 

PHP54x - Compatible with PHP 5.4.x (being used for over a year in production environment)

PHP55x - In development


How to Install
===============

Download the file from github and then:

* cd AMFEXT-FOLDER
* phpize
* chmod +x configure && chmod +x build/shtool (in some cases)
* ./configure
* make clean
* make
* sudo make intall


Below are some information for Git beginners.



How to Install GIT on Linux
===============

* Install Git from apt-get
    * `sudo apt-get install git-core`

* An article explaining how to configure it
    * https://help.github.com/articles/set-up-git

Cloning the repo
===============

* Open terminal and CD into the folder where the code will be placed in (example: cd /home/user/workspace/amfext)
* Once insede the folder, clone the repo:
    * `git clone https://github.com/protetore/amfext.git`
* [Optional] Creating an alias for the project URL:
    * `git remote add amfext https://github.com/protetore/amfext.git`

Updating
===============

* `git pull amfext master`

Commit
===============

Adding one file to commit: `git add /path/to/file`
Adding all changes: `git add .` (under the project root)

Commit command order:

* `git add .` 
* `git commit -m 'Commit Message` (local Commit) 
* `git push -u origin master` (or another banch inste3ad of master)
