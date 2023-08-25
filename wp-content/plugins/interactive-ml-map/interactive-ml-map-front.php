<?php

// Carte affiché en front
function create_ml_map()
{
    // Charge les scripts et les feuilles de style 
    wp_enqueue_style("ml-stylesheet");
    wp_enqueue_script("jquery");
    wp_enqueue_script("script-ml-map", plugins_url("/js/script-ml-map.js", __FILE__),);

?>
<div class="ml-map">
    <!-- <div class="ml-map-ttl">
            <span class="ml-map-ttl-icon dashicons dashicons-location"></span>
            <h2 class="ml-map-ttl-txt" id="mlmap">
                trouve la mission locale la plus proche de chez toi
            </h2>
        </div> -->
    <div class="ml-map-flex">
        <div class="ml-map-main">

            <div class="ml-map-main-loading lds-dual-ring main-antenna-loading"></div>
            <div class="ml-map-main-details" style="display:none">
                <div class="ml-map-main-details-container">
                    <h3 class="ml-map-main-details-container-name"></h3>
                    <span class="ml-map-main-details-container-adress"></span>
                    <span class="ml-map-main-details-container-phone"></span>
                    <p class="ml-map-main-details-container-dsc"></p>
                    <a class="ml-map-main-details-container-link" href="" target="_blank"><span
                            class="ml-map-main-details-container-link-icon dashicons dashicons-admin-links"></span>voir
                        sur google maps</a>
                </div>
                <img class="ml-map-main-details-img" alt="Photo de l'antenne" src="">
            </div>
            <span class="ml-map-main-hourly">
            </span>
        </div>
        <div class="ml-map-wrapper" style="display:none">
            <img src="<?= plugins_url("interactive-ml-map/assets/ml-map.svg") ?>" alt="Image de la carte"
                class="ml-map-wrapper-img style-svg">
        </div>
    </div>
</div>

<?php
    function media_selector_settings_page_callback()
    {
    ?>
<div class='image-preview-wrapper'>
    <img id='image-preview' src='' width='100' height='100' style='max-height: 100px; width: 100px;'>
</div>
<input id="upload_image_button" type="button" class="button" value="<?php _e('Upload image'); ?>" />
<input type='hidden' name='image_attachment_id' id='image_attachment_id' value=''>
<?php
    }
    ?>
<?php
}

add_shortcode("sc-ml-map", "create_ml_map");