<?php

// Création du header dans le back
function antenna_header()
{
?>
<div class="ml-header">
    <nav class="ml-header-nav">
        <a class="ml-header-nav-item" href="?page=antennas">
            <span class="dashicons dashicons-location"></span> Antennes
        </a>
        <a class="ml-header-nav-item" href="?page=antennas&action=create">
            <span class="dashicons dashicons-plus-alt"></span> Créer
        </a>
    </nav>
    <span class="ml-header-credits">
        ml-map 1.01 par Allan COTE et Julien RICHARD.
    </span>
</div>
<?php
}