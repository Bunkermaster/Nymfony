# Exercice MVC
## Introduction
A simple exercise for my students to the different steps of developing a framework.

## Service Container
The service container is fairly easy to use. 
To declare a service:
```
$request = new \Helper\Request();
Container::register($request);
```
To get a service:
```
$request = Container::getService('HelperRequest');
```

## View
Views are stored in the View/ directory.
Views are rendered from Controllers.  
 
```
return $this->render("somepage.php");
```

## Helper\Router

Routes are declared in the `/routes.json` file. See [Router info](./Helper/ROUTER.md)

## Helper\ServiceContainer

Services are declared in the `/services.json` file. See [ServiceContainer info](./Helper/SERVICECONTAINER.md)

## Helper\CLITableBuilder

See [CLITableBuilder info](./Helper/CLITABLEBUILDER.md)

## Helper\CLIShellColor

See [CLIShellColor info](./Helper/CLISHELLCOLOR.md)

## MIT License

[License](./LICENSE)
