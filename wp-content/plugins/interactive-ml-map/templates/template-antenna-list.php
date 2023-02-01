<?php


// Cette fonction créée la liste de nos antennes.
function list_manage_antennas($terms)
{
?>
    <!-- on boucle pour afficher nos antennes à la suite -->
    <h2 id="ml-antennas" class="ml-antennas"> Liste de nos antennes : </h2>
    <ul class="ml-antennas-list">
        <?php
        foreach ($terms as $k => $v) {
            $meta = get_term_meta($v->term_id);
        ?>
            <li class="ml-antennas-list-item" id="<?= $v->term_id ?>">
                <h3 class="ml-antennas-list-item-ttl">
                    <?= $v->name ?>
                </h3>
                <div id="ml-antennas-list-item-controller" class="ml-antennas-list-item-controller">
                    <form action="" method="POST">
                        <input type="hidden" id="ml-id" name="ml-id" value="<?= $v->term_id ?>">
                        <?php
                        if ($meta["ml-opening-check"][0] == "on") {
                        ?>
                            <button type="submit" name="ml-lock" value="off" class="ml-antennas-list-item-controller-button"><span class="dashicons dashicons-unlock locker"></span> </button>
                        <?php
                        } else {
                        ?>
                            <button type="submit" name="ml-lock" value="on" class="ml-antennas-list-item-controller-button"><span class="dashicons dashicons-lock locker"></span> </button>
                        <?php
                        }
                        ?>
                    </form>
                    <a class="ml-antennas-list-item-controller-button" href="?page=antennas&action=edit&term_id=<?= $v->term_id ?>"><span class="dashicons dashicons-edit"></span></a>
                    <a class="ml-antennas-list-item-controller-button remove" data-id="<?= $v->term_id ?>" data-name="<?= $v->name ?>"><span class="dashicons dashicons-trash"></span></a>
                </div>
                <img class="ml-antennas-list-item-img" src="<?= $meta["image-attachment-url"][0] ?>">
                <div class="black-bg"></div>
            </li>
        <?php
        }
        ?>
    </ul>
    <!-- Modal de suppression d'une antenne, ci-dessous -->
    <div class="ml-form-modal">
        <p class="ml-form-modal-msg">Êtes vous-sûr(e) de vouloir supprimer <span class="ml-form-modal-msg-antenna">placeholder</span>?</p>

        <div class="ml-form-modal-controller">
            <span class="ml-form-modal-button close-modal dashicons dashicons-no"></span>
            <form action="" method="POST">
                <button type="submit" id="ml-remove" name="ml-remove" class="ml-form-modal-button validate-modal dashicons dashicons-saved" value="remove"></button>
                <input type="hidden" name="ml-id" id="ml-id" value="">
            </form>
        </div>
    </div>
    <div class="ml-form-modal-blackBG"></div>
<?php
}
