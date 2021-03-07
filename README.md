# HTML form post data refiller

Helper class for refilling post data into the HTML form fields.

## Install

You can install this package via [Composer](http://getcomposer.org/):

```
composer require kekos/form-refill
```

## Documentation

## Usage

```php
<?php
use Kekos\FormRefill\FormRefill;

$refill = new FormRefill();
$refill->setPostData($_POST);
?>

<form action="" method="POST">
    <label>
        Your name:
        <input
            type="text"
            name="name"
            <?php echo $refill->refillText('name'); ?>
        >
    </label>
    <label>
        Your presentation:
        <textarea name="pres"><?php echo $refill->refillTextarea('pres'); ?></textarea>
    </label>
    <label>
        <input
            type="checkbox"
            name="yes"
            value="1"
            <?php echo $refill->refillCheckbox('yes', '1'); ?>
        >
        Check this box?
    </label>

    Select one:
    <label>
        <input
            type="radio"
            name="food"
            value="hamburger"
            <?php echo $refill->refillRadio('food', 'hamburger'); ?>
        >
        🍔
    </label>
    <label>
        <input
            type="radio"
            name="food"
            value="pizza"
            <?php echo $refill->refillRadio('food', 'pizza'); ?>
        >
        🍕
    </label>

    <label>
        Age:
        <select name="age">
            <option value="0-20"<?php echo $refill->refillOption('age', '0-20'); ?>>
                0-20
            </option>
            <option value="21-30"<?php echo $refill->refillOption('age', '21-30'); ?>>
                21-30
            </option>
            <option value="31-40"<?php echo $refill->refillOption('age', '31-40'); ?>>
                31-40
            </option>
            <option value="41-60"<?php echo $refill->refillOption('age', '41-60'); ?>>
                41-60
            </option>
            <option value="61-70"<?php echo $refill->refillOption('age', '61-70'); ?>>
                61-70
            </option>
            <option value="71+"<?php echo $refill->refillOption('age', '71+'); ?>>
                71+
            </option>
        </select>
    </label>
</form>
```

## Bugs and improvements

Report bugs in GitHub issues or feel free to make a pull request :-)

## License

MIT
