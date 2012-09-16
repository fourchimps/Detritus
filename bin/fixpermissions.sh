#! /bin/bash

# www-data group owns everything
chgrp -R www-data ~/source/fourchimps.com/detritus

# owner read/write, group read/wite everything.  
chmod -R 640 ~/source/fourchimps.com/detritus
# Executable directories
chmod -R u+X,g+X ~/source/fourchimps.com/detritus

# wide open cache
chmod -R 777 ~/source/fourchimps.com/detritus/app/logs
chmod -R 777 ~/source/fourchimps.com/detritus/app/cache

# vendors, console, this script are executable by owner
chmod u+x ~/source/fourchimps.com/detritus/app/console
#chmod u+x /var/www/fourchimps.com/detritus/bin/vendors
chmod u+x ~/source/fourchimps.com/detritus/bin/fixpermissions.sh



