/**
 * Module de gestion des adhérents
 * @returns {undefined}
 */
var module_adherents = function () {

    var self = {};

    /**
     * Fonction init du module
     * Au chargement de la page
     * @returns {undefined}
     */
    self.init = function () {
            $(".template").hide();
    };

    /**
     * Fonction de récupération des adhérents
     * @returns {undefined}
     */
    self.getAdherents = function () {
        console.log("Récupération des adhérents");
        var adh = {};
        $.ajax({
            url: "../api.php",
            method: "GET",
            data: {
                ressource: "adherents"
            },
            success: function (response) {
                adh = response.DATA;
                self.updateAdherents_HTMLOutput(adh);
            }
        });
    };

    /**
     * Fonction qui réaffiche la liste HTML des adhérents
     * @param {type} adherents
     * @returns {undefined}
     */
    self.updateAdherents_HTMLOutput = function (adherents) {
        var $template = $('.template');
        $.each(adherents, function (k, adherent) {
            var clone = $($template).clone();
            clone.removeClass("template");
            clone.children(".title").html(adherent.prenom + " " + adherent.nom);
            clone.children("img").attr("src", adherent.img);
            $(clone.children("p")).children(".mail").html(adherent.mail);
            clone.show();
            $(".adherents").append(clone);
            $('.tooltipped').tooltip({delay: 50});
        });
    };

    return {
        init: {
            init: self.init(),
            getAdherents: self.getAdherents
        }
    };
};
$(document).ready(function () {
    module_adherents().init.getAdherents();
});
    