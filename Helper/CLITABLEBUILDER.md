# CLITableBuilder

``` php
\Helper\CLITableBuilder::init(array $data, array $headers, $separatorLines = false, $repeatHeader = false) : String
```

* bool $separatorLines specifies if there will be seperator lines between data lines. ```false``` by default.
Note: Header will always be seperated from the data lines by a seperator line 
* bool|int $repeatHeader will decide if the header is repeated every int $repeatHeader lines. ```false``` by default.

## Input
Method takes an array as parametre.


## Ouput

### Basic

```
  [Router]
    +-----------+------+-----------+---------+-------+
    |identifier |name  |controller |action   |method |
    +-----------+------+-----------+---------+-------+
    |home       |home  |Page       |home     |GET    |
    +-----------+------+-----------+---------+-------+
    |home       |home  |Page       |homePost |POST   |
    +-----------+------+-----------+---------+-------+
    |about      |about |Page       |about    |ALL    |
    +-----------+------+-----------+---------+-------+
```

### No separator

```
  [Router]
    +-----------+------+-----------+---------+-------+
    |identifier |name  |controller |action   |method |
    +-----------+------+-----------+---------+-------+
    |home       |home  |Page       |home     |GET    |
    |home       |home  |Page       |homePost |POST   |
    |about      |about |Page       |about    |ALL    |
    +-----------+------+-----------+---------+-------+
```
or
```
  [Router]
    +-----------+------+-----------+---------+-------+
    |identifier |name  |controller |action   |method |
    +-----------+------+-----------+---------+-------+
    |home       |home  |Page       |home     |GET    |
    |home       |home  |Page       |homePost |POST   |
    +-----------+------+-----------+---------+-------+
    |identifier |name  |controller |action   |method |
    +-----------+------+-----------+---------+-------+
    |about      |about |Page       |about    |ALL    |
    +-----------+------+-----------+---------+-------+
```
