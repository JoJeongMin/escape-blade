# escape-blade

Partial Plugin is CakePHP escape.

## Usage

AppView.php
```
use EscapeBlade\View\EscapeBladeTrait;

class AppView extends View {
    use EscapeBladeTrait;
}
```

example.ctp
```
<?php $test = 'test'; ?>
{! '<span style="color=red">' . $test . '</span>' !}
```

print
```
<span style="color=red">test</span>
```
