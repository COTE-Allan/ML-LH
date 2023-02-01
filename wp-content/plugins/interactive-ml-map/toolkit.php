<?php

// -----------------------------------------------------------------------------------------------
// Permet de voir une variable de la console en PHP.

function echosol($v)
{
    echo "<script>console.log($v)</script>";
}

// -----------------------------------------------------------------------------------------------
//  Fonction magique pour afficher nos arrays et objets de façon propre.

function pretty_print_r($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
}

// -----------------------------------------------------------------------------------------------
// Transforme un string en slug.

function create_url_slug($urlString)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString);
    return $slug;
}

// -----------------------------------------------------------------------------------------------
// Nettoyage essentiel de TOUTES les valeurs.

function validate_input($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// -----------------------------------------------------------------------------------------------
// Verification en fonction du type de données indiqués.
// [ "numbers", "phone", "shortstr", "longstr", "hyperlink" ]

function verify_input($input, $input_type)
{

    if (empty($input)) {
        // pretty_print_r("return empty");
        return true;
    }
    if ($input_type == "numbers" && is_numeric($input) == false) {
        // pretty_print_r("return numbers");
        return true;
    }
    if ($input_type == "phone" && is_numeric($input) == false || $input_type == "phone" && strlen($input) != 10) {
        // pretty_print_r("return phone");
        return true;
    }

    if ($input_type == "shortstr" && strlen($input) >= 50) {
        // pretty_print_r("return short");
        return true;
    }
    if ($input_type == "longstr" && strlen($input) >= 255) {
        // pretty_print_r("return long");
        return true;
    }
    if ($input_type == "hyperlink" && !filter_var($input, FILTER_VALIDATE_URL)) {
        // pretty_print_r("return hyper");
        return true;
    }

    // pretty_print_r("return false");
    return false;
}
