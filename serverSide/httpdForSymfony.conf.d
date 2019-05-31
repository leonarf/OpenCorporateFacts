<VirtualHost *:80>
    DocumentRoot "/var/www/OpenCorporateFacts/public"
    DirectoryIndex index.php

    <Directory "/var/www/OpenCorporateFacts/public">
        AllowOverride All
        Order Allow,Deny
        Allow from All
    </Directory>
</VirtualHost>
