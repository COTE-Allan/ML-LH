<?php

// Création du formulaire de nos antennes.
function form_create_antennas($terms)
{
    global $error_name_msg, $error_adress_msg, $error_dsc_msg, $error_img_msg, $error_lnk_msg, $error_mrk_msg, $error_phone_msg;
    antenna_post();
    // En cas d'upload je récupère l'ID de l'image inséré puis je fais un update option qui met à jour une "variable" qui contient l'ID de la photo
    if (isset($_POST["submit_image_selector"]) && isset($_POST["image_attachment_id"])) :
        update_option("media_selector_attachment_id", absint($_POST["image_attachment_id"]));
    else :
        update_option("media_selector_attachment_id", 0);
    endif;

?>
    <h1><span class="dashicons dashicons-plus-alt"></span> Veuillez remplir les champs ci-dessous pour créer une antenne</h1>
    <form class="ml-form" action="" method="POST">
        <div class="ml-form-main">
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-name">
                    Nom de l'antenne <span>*</span> :
                </label>
                <input type="text" name="ml-name" id="ml-name" class="ml-form-main-item-input" placeholder="Veuillez saisir le nom de votre antenne">
                <?php if (isset($error_name_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_name_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-opening">Horaires <span>*</span> :</label>
                <input type="text" name="ml-opening" id="ml-opening" class="ml-form-main-item-input" value="Du lundi au vendredi, de 8h30 à 12h00 puis de 13h30 à 17h00.">
                <?php if (isset($error_opn_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_opn_msg ?></span>
                <?php } ?>
                <div>
                    <input type="checkbox" id="ml-opening-check" name="ml-opening-check" style="display:none" checked>
                </div>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-description">
                    Description <span>*</span> :
                </label>
                <textarea name="ml-description" id="ml-description" class="ml-form-main-item-input" placeholder="Description de votre antenne" cols="30" rows="5"></textarea>
                <?php if (isset($error_dsc_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_dsc_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-phone">
                    Telephone <span>*</span> :
                </label>
                <input type="text" name="ml-phone" id="ml-phone" class="ml-form-main-item-input" placeholder="Numéro de téléphone de l'antenne">
                <?php if (isset($error_phone_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_phone_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-adress">
                    Adresse <span>*</span> :
                </label>
                <input type="text" name="ml-adress" id="ml-adress" class="ml-form-main-item-input" placeholder="L'adresse de l'antenne">
                <?php if (isset($error_adress_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_adress_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-link">
                    Lien google map <span>*</span> :
                </label>
                <input type="text" name="ml-link" id="ml-link" class="ml-form-main-item-input" placeholder="(Exemple: https://)">
                <?php if (isset($error_lnk_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_lnk_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <img id="image-preview" src="<?= wp_get_attachment_url(get_option("media_selector_attachment_id")); ?>" height="100">
                <input id="upload_image_button" type="button" class="button" value="<?php _e("Ajouter une image"); ?>" />
                <input type="hidden" name="image_attachment_id" id="image_attachment_id" value="<?= get_option("media_selector_attachment_id"); ?>">
                <?php if (isset($error_img_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_img_msg  ?></span>
                <?php } ?>
            </div>

            <input class="ml-form-main-submit submit-desktop" type="submit" value="Créer mon antenne">

            <input type="hidden" name="ml-longitude" id="ml-longitude">
            <input type="hidden" name="ml-latitude" id="ml-latitude">

            <input type="hidden" name="ml-post-type" id="ml-post-type" value="create">
        </div>

        <div class="ml-form-map">
            <label class="ml-form-map-label">Choisissez un nouvel emplacement sur la carte <span>*</span> : </label>
            <div class="ml-form-map-wrapper">
                <?php
                // Affichage des antennes déjà en place
                foreach ($terms as $k => $v) {
                    $meta = get_term_meta($v->term_id);
                ?>
                    <span class="marker-added dashicons dashicons-location" style="top: <?= $meta["ml-longitude"][0] . "%" ?> ; left: <?= $meta["ml-latitude"][0] . "%" ?>"></span>

                <?php

                }
                ?>


                <img src="<?= plugins_url("interactive-ml-map/assets/ml-map.svg") ?>" alt="Image de la carte" class="ml-form-map-img style-svg">
            </div>
            <?php if (isset($error_mrk_msg)) { ?>
                <span class="ml-form-main-item-error"><?= $error_mrk_msg  ?></span>
            <?php } ?>
        </div>

        <input class="ml-form-main-submit submit-mobile" type="submit" value="Créer mon antenne">
    </form>
<?php
}
