<?php

// -----------------------------------------------------------------------------------------------
// Si j'ai fait un post grâce au formulaire de création, 
// j'utilise les informations pour ajouter l'antenne à la liste.

function antenna_post()
{
    global $error_name_msg, $error_adress_msg, $error_dsc_msg, $error_img_msg, $error_lnk_msg, $error_mrk_msg, $error_phone_msg;

    // En cas de post ; remove.
    if (isset($_POST["ml-remove"])) {
        wp_delete_term($_POST["ml-id"], "antenne");
        create_banner("supprimée");
    }
    // En cas de post ; lock / unlock.
    if (isset($_POST["ml-lock"])) {
        update_term_meta($_POST["ml-id"], "ml-opening-check", $_POST["ml-lock"]);
        create_banner("modifiée");
    }
    // En cas de post ; création / édition.
    if (isset($_POST["ml-name"])) {
        // Nettoyage des données
        $name = $_POST["ml-name"];
        $description = $_POST["ml-description"];
        $error = false;

        // Vérification si name est vide
        if (verify_input($name, "shortstr")) {
            $error = true;
            $error_name_msg = "Le nom de l'antenne est trop long.";
        }
        if (verify_input($description, "longstr")) {
            $error = true;
            $error_dsc_msg = "La description est beaucoup trop longue.";
        }
        if (verify_input($_POST["ml-adress"], "longstr")) {
            $error = true;
            $error_adress_msg = "L'adresse de l'antenne est trop longue";
        }
        if (verify_input($_POST["ml-phone"], "phone")) {
            $error = true;
            $error_phone_msg = "Ce numéro de téléphone est incorrect.";
        }
        if (verify_input($_POST["ml-link"], "hyperlink")) {
            $error = true;
            $error_lnk_msg = "Ce lien est invalide.";
        }
        if (verify_input($_POST["ml-longitude"], "numbers")) {
            $error = true;
            $error_mrk_msg = "Veuillez placer un point sur la carte.";
        }
        if (verify_input($_POST["ml-latitude"], "numbers")) {
            $error = true;
            $error_mrk_msg = "Veuillez placer un point sur la carte.";
        }
        if (verify_input($_POST["image_attachment_id"], "numbers")) {
            $error = true;
            $error_img_msg = "Veuillez insérer une image.";
        }
        if (verify_input($_POST["ml-post-type"], "shortstr")) {
            $error = true;
        }
        // Tout est conforme : J'envoi les données
        if ($error === false) {
            switch ($_POST["ml-post-type"]) {
                case 'create':
                    wp_insert_term($name, "antenne", array(
                        "description" => $_POST["ml-description"],
                        "slug" => create_url_slug($_POST["ml-name"]),
                    ));
?>
                    <script>
                        window.location.href = "?page=antennas&success=créée"
                    </script>
                <?php
                    break;

                case 'edit':
                    wp_update_term($_POST["ml-id"], "antenne", array(
                        "name" => $_POST["ml-name"],
                        "slug" => create_url_slug($_POST["ml-name"]),
                        "description" => $_POST["ml-description"],
                    ));

                ?>
                    <script>
                        window.location.href = "?page=antennas&success=éditée"
                    </script>
<?php
                    break;
            }
        }
    }
}
