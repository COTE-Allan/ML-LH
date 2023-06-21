<?php

// Système d'alerte pour notifier l'utilisateur des actions faites sur les antennes.
function create_banner($value)
{
?>
    <div class="ml-alert">
        <p class="ml-alert-msg">L'antenne a été <?= $value ?> avec succès</p>
        <span class="ml-alert-close dashicons dashicons-no"></span>
    </div>
<?php
}
