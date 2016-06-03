# Helper\ConfigurationManager

## Definition
Configuration is declared in the `/config.json` file with the following attribute list:

* key: String identifying the configuration value
* value: array|string|int|float|bool the value of the configuration
Note: Objects cannot be concidered as values

## Declaration Example
``` json
{
  "APP_DEV_MODE":true,
  "APP_DEFAULT_ROUTE":"home",
  "APP_DB_HOST":"localhost",
  "APP_DB_PORT":"3306",
  "APP_DB_NAME":"nymfony",
  "APP_DB_USER":"root",
  "APP_DB_PASS":"root",
  "APP_DB_DRIVER":"pdo_mysql"
}
```

## ConfigurationManager::getConfig(string $key, $value = null) : array|string|int|float|bool

* $key identifies the configuration entry
* $value is set if you want to add dynamic configuration without going through the ```/config.json``` file.

Returns the ```value``` associated with the ```key```

## ServiceContainer::getServiceCollection() : array

Returns an array with all ```key=>value``` conbinations.

## debug config
``` bash
php bin/console debug config
```

This command displays the following
```
  [App Configuration]
    APP_ROOT_DIR = '/Users/yann/Sites/Nymfony/'
    APP_VIEW_DIR = '/Users/yann/Sites/Nymfony/View/'
    APP_LOG_DIR = '/Users/yann/Sites/Nymfony/logs/'
    APP_LOG_FILE = '/Users/yann/Sites/Nymfony/logs/app.log'
    APP_DEV_LOG_FILE = '/Users/yann/Sites/Nymfony/logs/dev.log'
    APP_JSON_QUERY_STRING_FLAG = 'json'
    APP_DEV_MODE = true
    APP_DEFAULT_ROUTE = 'home'
    APP_DB_HOST = 'localhost'
    APP_DB_PORT = '3306'
    APP_DB_NAME = 'nymfony'
    APP_DB_USER = 'root'
    APP_DB_PASS = 'root'
    APP_DB_DRIVER = 'pdo_mysql'
```
