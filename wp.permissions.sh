sudo chown -R apache /var/www/html/freshfrommexico.com
sudo chgrp -R apache /var/www/html/freshfrommexico.com
sudo chmod 2775 /var/www/html/freshfrommexico.com
find /var/www/html/freshfrommexico.com -type d -exec sudo chmod 2775 {} \;
find /var/www/html/freshfrommexico.com -type f -exec sudo chmod 664 {} \;

