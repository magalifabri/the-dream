<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// echo '<pre>';
// echo var_dump($_POST);
// echo '</pre>';

$currencyValueInUSD = [
    "usd" => [
        "name" => "U.S. Dollar",
        "value" => 1,
        "symbol" => "$",
    ],
    "eur" => [
        "name" => "European Euro",
        "value" => 1.14,
        "symbol" => "€",
    ],
    "jpy" => [
        "name" => "Japanese Yen",
        "value" => 0.0087,
        "symbol" => "¥",
    ],
    "gbp" => [
        "name" => "British Pound",
        "value" => 1.35,
        "symbol" => "£",
    ],
    "chf" => [
        "name" => "Swiss Franc",
        "value" => 1.08,
        "symbol" => "CHf",
    ],
];

// echo var_dump($currencyValueInUSD["usd"]["value"]);

// $price = $_POST["price"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["submit"] === "swap") {
        $tmp = $_POST["currencies1"];
        $_POST["currencies1"] = $_POST["currencies2"];
        $_POST["currencies2"] = $tmp;
    }

    $price = $_POST["price"];
    $currency1 = $_POST["currencies1"];
    $conversionRate1 = $currencyValueInUSD[$currency1]["value"];
    $currencySymbol1 = $currencyValueInUSD[$currency1]["symbol"];
    $currency2 = $_POST["currencies2"];
    $conversionRate2 = $currencyValueInUSD[$currency2]["value"];
    $currencySymbol2 = $currencyValueInUSD[$currency2]["symbol"];
    // $fromTo = $_POST["submit"];

    // echo "${currencySymbol1}$price is $currencySymbol2" . round(($conversionRate1 / $conversionRate2) * $price, 2);
}

function selected($currency, $selectName)
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($currency === $_POST[$selectName]) {
            return "selected";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drink Price Converter</title>
</head>

<body>
    <h1>Drink Price Converter</h1>

    <form action="" method="POST">
        <!-- <label for="price">price</label> -->
        <label for="currencies1">From </label>
        <select name="currencies1" id="currencies1">
            <!-- <option value="" selected disabled hidden>Choose a currency</option> -->
            <option value="usd" <?= selected("usd", "currencies1") ?>>U.S. Dollar (USD)</option>
            <option value="eur" <?= selected("eur", "currencies1") ?>>European Euro (EUR)</option>
            <option value="jpy" <?= selected("jpy", "currencies1") ?>>Japanese Yen (JPY)</option>
            <option value="gbp" <?= selected("gbp", "currencies1") ?>>British Pound (GBP)</option>
            <option value="chf" <?= selected("chf", "currencies1") ?>>Swiss Franc (CHF)</option>
        </select>
        <input type="number" step="0.01" id="price" name="price" value="<?= $_POST["price"] ?? "" ?>" placeholder="enter price" required>
        <br>
        <br>
        <label for="currencies2">To</label>
        <select name="currencies2" id="currencies2">
            <!-- <option value="" selected disabled hidden>Choose a currency</option> -->
            <option value="usd" <?= selected("usd", "currencies2") ?>>U.S. Dollar (USD)</option>
            <option value="eur" <?= selected("eur", "currencies2") ?>>European Euro (EUR)</option>
            <option value="jpy" <?= selected("jpy", "currencies2") ?>>Japanese Yen (JPY)</option>
            <option value="gbp" <?= selected("gbp", "currencies2") ?>>British Pound (GBP)</option>
            <option value="chf" <?= selected("chf", "currencies2") ?>>Swiss Franc (CHF)</option>
        </select>

        <?php
        if (!empty($_POST["submit"])) {
            echo $currencySymbol2 . round(($conversionRate1 / $conversionRate2) * $price, 2);
        }
        ?>

        <br>
        <br>
        <input type="submit" name="submit" value="convert">
        <input type="submit" name="submit" value="swap">

    </form>

</body>

</html>