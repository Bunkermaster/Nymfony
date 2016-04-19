# Exercice MVC
## Introduction
A simple exercise for my students to the different steps of developing a framework.

## Router
Routes are declared in the `routes.json` file. See [Router info](./ROUTER.md)

## Service Container
The service container is fairly easy to use. 
To declare a service:
```
$request = new Request();
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

