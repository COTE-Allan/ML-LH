(function ($) {
  $(document).ready(function () {
    // REST API sous forme d'objets JSON
    let link_antenna =
      "https://" +
      window.location.hostname +
      "/wp-json/wp/v2/antenne?per_page=20";
    let antenna_list;
    $.ajax({
      type: "GET",
      url: link_antenna,
      success: function (data) {
        antenna_list = data;
        $(".ml-map-main-details").show();
        $(".ml-map-wrapper").show();
        $(".ml-map-main-loading").hide();
        // Affiche les informations de notre antenne par défaut au chargement de la page.
        editDetails(antenna_list[0]);
        loopingMarkers(antenna_list);
        $(".ml-map-wrapper-marker#" + antenna_list[0].id).addClass("active");
      },
    });
    // Boucler sur les marqueurs pour les afficher sur la carte
    function loopingMarkers(data) {
      data.forEach((antenna) => {
        let marker =
          '<span id="' +
          antenna.id +
          '" class="ml-map-wrapper-marker dashicons dashicons-location"></span>';
        let modal =
          '<span id="modal-' +
          antenna.id +
          '" class="ml-map-wrapper-marker-modal">' +
          antenna.name +
          "</span>";
        let y = antenna["meta"]["ml-longitude"][0];
        let x = antenna["meta"]["ml-latitude"][0];
        $(marker)
          .appendTo(".ml-map-wrapper")
          .css({ top: parseInt(y) + "%", left: parseInt(x) + "%" });
        $(modal).appendTo("#" + antenna.id);
      });
    }
    // Affiche les informations des antennes au clique sur les marqueurs.
    $(document).on("click", ".ml-map-wrapper-marker", function () {
      antenna_list.every((antenna) => {
        if ($(this)[0].id == antenna.id) {
          $(".ml-map-wrapper-marker.active").removeClass("active");
          $(this).addClass("active");
          editDetails(antenna);
          // Uniquement sur la version mobile et tablette:
          // Scroll effectué au clique sur nos marqueurs pour accèder aux informations de l'antenne.
          let screen = $(window).width();
          if (screen < 900) {
            let offsets = $(".ml-map-main").offset();
            console.log(offsets);
            $("html, body").animate({ scrollTop: offsets.top - 100 }, "slow");
          }
          return false;
        }
        return true;
      });
    });
    // Je modifie les informations de l'HTML qui affiche l'antenne ciblée
    // S'utilise uniquement avec la taxonomie antenne.
    function editDetails(array) {
      let phone = array["meta"]["ml-phone"][0].match(/.{1,2}/g).join(" ");
      $(".ml-map-main-details-container-name").html(array.name);
      $(".ml-map-main-details-container-adress").html(
        array["meta"]["ml-adress"]
      );
      $(".ml-map-main-details-container-phone").html(phone);
      $(".ml-map-main-details-container-dsc").html(array.description);
      $(".ml-map-main-details-container-link").attr(
        "href",
        array["meta"]["ml-link"]
      );
      $(".ml-map-main-details-img").attr(
        "src",
        array["meta"]["image-attachment-url"]
      );
      if (array["meta"]["ml-opening-check"] == "on") {
        $(".ml-map-main-hourly").html(array["meta"]["ml-opening"]);
      } else {
        $(".ml-map-main-hourly").html(
          array["meta"]["ml-opening"] +
            "<br/>" +
            "Cette antenne est exceptionnellement fermée aujourd'hui."
        );
      }
    }
  });
})(jQuery);
