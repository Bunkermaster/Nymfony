# CLITableBuilder

``` php
\Helper\CLITableBuilder::init(array $data, array $headers) : String
```

## Input
Method takes an array as parametre.


## Ouput

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

