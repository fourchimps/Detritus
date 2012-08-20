#! /bin/bash

# www-data group owns everything
chgrp -R www-data /var/www/fourchimps.com/detritus

# owner read/write, group read/wite everything.  
chmod -R 640 /var/www/fourchimps.com/detritus
# Executable directories
chmod -R u+X,g+X /var/www/fourchimps.com/detritus

# wide open cache
chmod -R 777 /var/www/fourchimps.com/detritus/app/logs
chmod -R 777 /var/www/fourchimps.com/detritus/app/cache

# vendors, console, this script are executable by owner
chmod u+x /var/www/fourchimps.com/detritus/app/console
#chmod u+x /var/www/fourchimps.com/detritus/bin/vendors
chmod u+x /var/www/fourchimps.com/detritus/bin/fixpermissions.sh



