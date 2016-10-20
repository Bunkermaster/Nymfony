# Nymfony

Nymfony is not Symfony

## Introduction

A simple exercise for my students to the different steps of developing a framework.

## View

Views are stored in the View/ directory.
Views are rendered from Controllers.
The template manager used to generate views [is Twig](http://twig.sensiolabs.org/)
 
``` php
return $this->render("somepage.html.twig", [
    'key' => 'value'
]);
```

## Helper\Router

Routes are declared in the `core/config/routes.json` file. See [Router info](./core/Helper/ROUTER.md)

## Helper\ServiceContainer

Services are declared in the `core/config/services.json` file. See [ServiceContainer info](./core/Helper/SERVICECONTAINER.md)

## Helper\CLITableBuilder

See [CLITableBuilder info](./core/Helper/CLITABLEBUILDER.md)

## Helper\CLIShellColor

See [CLIShellColor info](./core/Helper/CLISHELLCOLOR.md)

## MIT License

[License](./LICENSE)
