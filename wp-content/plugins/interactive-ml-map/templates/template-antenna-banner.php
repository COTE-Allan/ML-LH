<?php

// Cette fonction avertit l'administrateur lorsqu'une antenne a été créée, éditée, supprimée.
function create_banner($value)
{
?>
    <div class="ml-alert">
        <p class="ml-alert-msg">L'antenne a été <?= $value ?> avec succès</p>
        <span class="ml-alert-close dashicons dashicons-no"></span>
    </div>
<?php
}
