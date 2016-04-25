BaconPackagistBundle
===============

[![Codacy Badge](https://api.codacy.com/project/badge/grade/27b91b375ac346d0bdcb5efeb49ab080)](https://www.codacy.com/app/adan-grg/BaconPackagistBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a0e52843-cfb0-43ee-95b2-2d775ceb1fe4/mini.png)](https://insight.sensiolabs.com/projects/a0e52843-cfb0-43ee-95b2-2d775ceb1fe4)

Este bundle é responsável por criar um serviço no Symfony para a integração com a API do [Packagist](https://packagist.org)

## Instalação

Para instalar o bundle basta rodar o seguinte comando abaixo:

```bash
$ composer require baconmanager/packagist-bundle
```
Agora adicione os seguintes bundles no arquivo AppKernel.php:

```php
<?php
// app/AppKernel.php
public function registerBundles()
{
    // ...
    new Bacon\Bundle\PackagistBundle\BaconPackagistBundle(),
    // ...
}
```
No arquivo **app/config/config.yml** adicione as seguintes configurações:

```yaml
bacon_packagist:
    api:
        base_url: https://packagist.org
```

Utilizando o bundle:

```php
<?php
// src/AppBundle/Controller/DefaultController.php

public function indexAction()
{
    $api  = $this->get('bacon_packagist.api');

    // Pesquisa nomes de bibliotecas com a referencia
    $return = $api
        ->api('search.json','GET')
        ->setParameters([
            'q' => 'symfony2'
        ])
        ->getResponse()
    ;
    var_dump($return);
   

    // Pesquisa detalhes de uma determinada biblioteca
    /*
    $return = $api
        ->api('packages/swiftmailer/swiftmailer.json','GET')
        ->getResponse()
    ;
    var_dump($return);
    */
}
```
