(function ($) {
    $(document).ready(function () {
        // Création d'une modale pour le bouton suppression de nos antennes 
        let modal = $(".ml-form-modal");
        let blackBG = $(".ml-form-modal-blackBG");
        let ms = 200;
        // Cible le bouton de suppression.
        $(".ml-antennas-list-item-controller-button.remove").click(function() {
            let name = $(this).data("name");
            let id = $(this).data("id");
            modal.css("display", "flex").fadeIn(ms);
            blackBG.fadeIn(ms);
            // Récupère le nom de l'antenne qu'on désire supprimer.
            $(".ml-form-modal-msg-antenna").html('"' + name + '" ');
            $("input#ml-id").attr("value", id);
        });
        // Fermeture de la modal et du background au clique sur l'icon.
        $(".ml-form-modal-button.close-modal").click(function(){
            modal.fadeOut(ms);
            blackBG.fadeOut(ms);
        })
        // Fermeture de la modal et du background au clique sur le background.
        blackBG.click(function(){
            modal.fadeOut(ms);
            blackBG.fadeOut(ms);
        })
        // Fermeture au clique sur l'icon, du bandeau de notification
        $(".ml-alert-close").click(function(){
        $(".ml-alert").fadeOut(ms);
        })
    });
})(jQuery);