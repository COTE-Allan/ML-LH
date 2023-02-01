// Fonction qui récupère la position de la souris sur notre carte ; afin d'y placer notre marqueur au clique.

(function ($) {
    $(document).ready(function () {
        let marker = '<span class="ml-form-map-marker dashicons dashicons-location"></span>';
        function getCursorPosition(canvas, event, marker) {
            const rect = canvas.getBoundingClientRect()
            const x = (((event.clientX - rect.left) - 20) / rect.width) * 100;
            const y = (((event.clientY - rect.top) - 35) / rect.height) * 100;
            console.log("x: " + x + " y: " + y);
            $("#ml-latitude").attr("value", x);
            $("#ml-longitude").attr("value", y);
            $(marker).appendTo(".ml-form-map-wrapper").css("top", y + "%").css("left", x + "%");
        }
        // Permet de ne placer qu'un seul marqueur à la fois.
        const map = document.querySelector('.ml-form-map-wrapper')
        map.addEventListener('mousedown', function (e) {
            $(".ml-form-map-marker").remove();
            getCursorPosition(map, e, marker)
        })
    });
})(jQuery);
