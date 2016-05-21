# ServiceContainer

## Definition
Services are declared in the `/services.json` file with the following attribute list:

* name: Class name with fully qualified Namespaces (ex: `\Helper\Request`)
* param: Array of parameters

## ServiceContainer::getService(String $service, array $params = []) : object


## Declaration Example
``` json
{  
  "Logger":{
    "class":"Monolog\\Logger",
    "param":[
      "App"
    ]
  }
}
```

## ServiceContainer::getServiceCollection() : array

## debug:container
``` bash
php bin/console debug container
```
This command displays the following
```
    Fuck all!!!!! Work in progress
```
