# Proyect of Practical Action with IoT

## Prepare the environment *Composer*

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
composer global require "fxp/composer-asset-plugin:^1.2.0"
```

*Retrive the Token from the URL given on the install of composer-asset-plugin and paste on the command line when needed*


## Get the Proyect

```
git clone https://github.com/renziito/iot
cd iot 
composer install
```


