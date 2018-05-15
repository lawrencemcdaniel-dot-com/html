sudo chown -R apache /var/www/html/blog.lawrencemcdaniel.com
sudo chgrp -R apache /var/www/html/blog.lawrencemcdaniel.com
sudo chmod 2775 /var/www/html/blog.lawrencemcdaniel.com
find /var/www/html/blog.lawrencemcdaniel.com -type d -exec sudo chmod 2775 {} \;
find /var/www/html/blog.lawrencemcdaniel.com -type f -exec sudo chmod 664 {} \;

