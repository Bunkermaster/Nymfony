# Router
## Definition
Routes are defined in the `routes.json` file with the following attribute list:

* name: feature name, will be the URI part of route name
* controller: controller name (without Controller suffix)
* action: action method name (without Action suffix)
* method: Optional, HTTP method, if not specified, route applies to all HTTP verbs

## Route name
Calling a route takes into account the HTTP verb. In order to be able to segregate the action calls, the HTTP verb is added, if specified, as a sub route specification.
Example: `home[GET]`

If no HTTP verb is specified for a route, the string `ALL` will be used in the HTTP verb.
Example: `home[ALL]`

## Example
``` json
{  
  "page_home_post":{
    "name":"home",
    "controller": "Page",
    "action": "homePost",
    "method": "POST"
  }
}
```

## Router dump
```
php bin/console router
```
This command displays the folowing
```
  [Router]
    +-----------+------+-----------+---------+-------+
    |identifier |name  |controller |action   |method |
    +-----------+------+-----------+---------+-------+
    |home       |home  |Page       |home     |GET    |
    +-----------+------+-----------+---------+-------+
    |home       |home  |Page       |homePost |POST   |
    +-----------+------+-----------+---------+-------+
    |about      |about |Page       |about    |N/A    |
    +-----------+------+-----------+---------+-------+
```