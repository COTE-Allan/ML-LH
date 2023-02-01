<?php

// -----------------------------------------------------------------------------------------------
// insertion des inputs dans la base de données (name, description, adress etc.)

function update_fields($term_id)
{
    update_term_meta($term_id, "ml-opening", sanitize_text_field($_POST["ml-opening"]));
    update_term_meta($term_id, "ml-opening-check", sanitize_text_field($_POST["ml-opening-check"]));
    update_term_meta($term_id, "ml-adress", sanitize_text_field($_POST["ml-adress"]));
    update_term_meta($term_id, "ml-phone", sanitize_text_field($_POST["ml-phone"]));
    update_term_meta($term_id, "ml-link", sanitize_text_field($_POST["ml-link"]));
    update_term_meta($term_id, "ml-longitude", sanitize_text_field($_POST["ml-longitude"]));
    update_term_meta($term_id, "ml-latitude", sanitize_text_field($_POST["ml-latitude"]));
    update_term_meta($term_id, "image-attachment-url", wp_get_attachment_url(sanitize_text_field($_POST["image_attachment_id"])));
}
add_action("created_antenne", "update_fields");
add_action("edited_antenne", "update_fields");

// -----------------------------------------------------------------------------------------------
// Affiche la media library dans le cadre d'une utilisation en tant qu'input image.

function media_selector_print_script()
{
    $my_saved_attachment_post_id = get_option('media_selector_attachment_id', 0);
?>
    <script type='text/javascript'>
        jQuery(document).ready(function($) {
            // Téléchargement de fichiers
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id; // Conserve l'ancien ID
            var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this 
            jQuery('#upload_image_button').on('click', function(event) {
                event.preventDefault();
                // If the media frame already exists, reopen it.
                if (file_frame) {
                    // Set the post ID to what we want
                    file_frame.uploader.uploader.param('post_id', set_to_post_id);
                    // Open frame
                    file_frame.open();
                    return;
                } else {
                    // Set the wp.media post id so the uploader grabs the ID we want when initialised
                    wp.media.model.settings.post.id = set_to_post_id;
                }
                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Sélectionner une image',
                    button: {
                        text: 'Valider',
                    },
                    multiple: false // Set to true to allow multiple files to be selected
                });
                // When an image is selected, run a callback.
                file_frame.on('select', function() {
                    // We set multiple to false so only get one image from the uploader
                    attachment = file_frame.state().get('selection').first().toJSON();
                    // Do something with attachment.id and/or attachment.url here
                    $('#image-preview').attr('src', attachment.url).css('width', 'auto');
                    $('#image_attachment_id').val(attachment.id);
                    // Restore the main post ID
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
                // Finally, open the modal
                file_frame.open();
            });
            // Restaure l'ID principal lorsqu'on appuie sur le bouton d'ajout de média.
            jQuery('a.add_media').on('click', function() {
                wp.media.model.settings.post.id = wp_media_post_id;
            });
        });
    </script>
<?php
}
