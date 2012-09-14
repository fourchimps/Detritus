FourChimps Detritus
========================

Detritus is a Symfony2 based blog (yes another one) that I'm using to get to 
grips with Symfony2. Things may get ugly and this isnt presented as exemplar 
code. However if you find anything useful in here then I'll consider that
my Good-Deed for the year.

Theres lots of packages and things that may be pulled in as part of this 
repo. I'm not taking credit for others work - License files should be located
in the respective sources etc. 

This isnt for commercial use. See LICENSE.md for details.

1) Installing Detritus
----------------------

install using composer

On a Linux Ubuntu/Mint System (adjust for other distros, OSs as required)

sudo apt-get install curl
git clone git://github.com/fourchimps/Detritus.git
cd Detritus
curl -s https://getcomposer.org/installer | php
composer.phar install --dev
cp app/parameters.yml.dist app/parameters.yml
(edit the file to point to your DB etc)
(point your web root at Detritus/web)
app/console doctrine:database:create
app/console doctrine:schema:update --force
(if you want test data)
app/console doctrine:fixtures:load
app/console assets:install --symlink

Set appropriate permissions on the whole thing

bin/fixpermissions.sh will hack enough permissions to get started. you should implement the acl based permissions as suggested by @fabpot for proper use.

FourChimps
==========

FourChimps.com is my test domain. Its the vendor under which I release exploratory code. It (and the detritus blog this code runs) can be seen at http://detritus.fourchimps.com

Whats running there, may or may not be exactly whats in this repo - dont assume either, however.




