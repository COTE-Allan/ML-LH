<?php

// Creation du formulaire d'edition de nos antennes.
function form_edit_antennas($terms)
{
    global $error_name_msg, $error_adress_msg, $error_dsc_msg, $error_img_msg, $error_lnk_msg, $error_mrk_msg, $error_phone_msg;
    antenna_post();
    $antenna = get_term($_GET["term_id"]);
    $meta = get_term_meta($antenna->term_id);
    // En cas d'upload je récupère l'ID de l'image inséré puis je fais un update option qui met à jour une "variable" qui contient l'ID de la photo
    // Sinon je récupère l'ID de l'image déjà incorporé puis je fais [...]
    if (isset($_POST["submit_image_selector"]) && isset($_POST["image_attachment_id"])) :
        update_option("media_selector_attachment_id", absint($_POST["image_attachment_id"]));
    else :
        update_option("media_selector_attachment_id", attachment_url_to_postid($meta["image-attachment-url"][0]));
    endif;

?>
    <h1><span class="dashicons dashicons-edit"></span> Veuillez remplir les champs ci-dessous pour éditer une antenne</h1>
    <form class="ml-form" action="" method="POST">
        <div class="ml-form-main">
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-name">
                    Nom de l'antenne <span>*</span> :
                </label>
                <input type="text" name="ml-name" id="ml-name" value="<?= $antenna->name ?>" class="ml-form-main-item-input" placeholder="Veuillez saisir le nom de votre antenne">
                <?php if (isset($error_name_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_name_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-opening">Horaires <span>*</span> :</label>
                <input type="text" name="ml-opening" id="ml-opening" class="ml-form-main-item-input" value="<?= $meta["ml-opening"][0] ?>">
                <?php if (isset($error_opn_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_opn_msg ?></span>
                <?php } ?>
                <div>
                    <input type="hidden" id="ml-opening-check" name="ml-opening-check" value="off">

                    <?php
                    if ($meta["ml-opening-check"][0] == "on") {
                    ?>
                        <input type="checkbox" id="ml-opening-check" name="ml-opening-check" checked>
                    <?php
                    } else {
                    ?>
                        <input type="checkbox" id="ml-opening-check" name="ml-opening-check">
                    <?php
                    }
                    ?>

                    <label for="ml-opening-check">Ouverture de l'antenne</label>
                </div>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-description">
                    Description <span>*</span> :
                </label>
                <textarea name="ml-description" id="ml-description" class="ml-form-main-item-input" placeholder="Description de votre antenne" cols="30" rows="5"><?= $antenna->description ?></textarea>
                <?php if (isset($error_dsc_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_dsc_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-phone">
                    Telephone <span>*</span> :
                </label>
                <input type="text" name="ml-phone" id="ml-phone" value="<?= $meta["ml-phone"][0] ?>" class="ml-form-main-item-input" placeholder="Numéro de téléphone de l'antenne">
                <?php if (isset($error_phone_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_phone_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-adress">
                    Adresse <span>*</span> :
                </label>
                <input type="text" name="ml-adress" id="ml-adress" value="<?= $meta["ml-adress"][0] ?>" class="ml-form-main-item-input" placeholder="L'adresse de l'antenne">
                <?php if (isset($error_adress_msg)) { ?>
                    <span class="ml-form-main-item-error"><?= $error_adress_msg ?></span>
                <?php } ?>
            </div>
            <div class="ml-form-main-item">
                <label class="ml-form-main-item-label" for="ml-link">
                    Lien google map <span>*</span> :
                </label>
                <input type="text" name="ml-link" id="ml-link" value="<?= $meta["ml-link"][0] ?>" class="ml-form-main-item-input" placeholder="(Exemple: https://)">
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

            <input class="ml-form-main-submit submit-desktop" type="submit" value="Éditer mon antenne">

            <input type="hidden" value="<?= $meta["ml-longitude"][0] ?>" name="ml-longitude" id="ml-longitude">
            <input type="hidden" value="<?= $meta["ml-latitude"][0] ?>" name="ml-latitude" id="ml-latitude">
            <input type="hidden" name="ml-post-type" id="ml-post-type" value="edit">
            <input type="hidden" name="ml-id" id="ml-id" value="<?= $antenna->term_id ?>">
        </div>

        <div class="ml-form-map">
            <label class="ml-form-map-label">Choisissez un nouvel emplacement sur la carte <span>*</span> : </label>
            <div class="ml-form-map-wrapper">
                <?php
                // Affichage des antennes déjà en place sur la carte.
                foreach ($terms as $k => $v) {
                    $meta = get_term_meta($v->term_id);

                    if ($v->term_id != $antenna->term_id) {
                ?>
                        <span class="marker-added dashicons dashicons-location" style="top: <?= $meta["ml-longitude"][0] . "%" ?> ; left: <?= $meta["ml-latitude"][0] . "%" ?>"></span>
                    <?php
                    } else {
                    ?>
                        <span class="ml-form-map-marker dashicons dashicons-location" style="top: <?= $meta["ml-longitude"][0] . "%" ?> ; left: <?= $meta["ml-latitude"][0] . "%" ?>"></span>
                <?php
                    }
                }
                ?>


                <img src="<?= plugins_url("interactive-ml-map/assets/ml-map.svg") ?>" alt="Image de la carte" class="ml-form-map-img style-svg">
            </div>
            <?php if (isset($error_mrk_msg)) { ?>
                <span class="ml-form-main-item-error"><?= $error_mrk_msg  ?></span>
            <?php } ?>
        </div>

        <input class="ml-form-main-submit submit-mobile" type="submit" value="Éditer mon antenne">
    </form>
<?php
}
