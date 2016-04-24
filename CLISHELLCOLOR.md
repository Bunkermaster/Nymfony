# CLIShellColor

``` php
\Helper\CLIShellColor::mecho(String $string[, String $FGColor = null[, String $BGColor = null]]) : void
```

## Input

### String $string

String to colorize with shell colors.

### String $FGColor = null

String specifying the foreground color.
See ```\Helper\CLIShellColor::$FGColors``` for reference.

### String $BGColor = null

String specifying the background color.
See ```\Helper\CLIShellColor::$BGColors``` for reference.

## Output

Method echoes the ```$string``` with ```$FGColor``` as foreground and ```$BGColor``` as background shell colors.
