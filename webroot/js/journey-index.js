'use strict';

let myModal = null;

const openJourneyModal = function () {
    myModal.show();
}

const startJourney = function () {
    $.ajax(
        {
            url: $("#form-new-journey").attr("action"),
            method: "POST",
            data: $("#form-new-journey").serializeArray(),
            dataType: "json",
        })
        .done(function (data) {
            if (data === null) {
                alert('Backend function error! Error in save process...');

                return;
            }
            console.log(data);
            alert(data.message);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {

            alert('Fail! ' + jqXHR?.responseJSON?.message || jqXHR?.statusText || "FATAL error");

            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    myModal.hide();
}

//onload
$(function () {
    myModal = new bootstrap.Modal($("#journey-modal"));
    $("#active-journey-public,#active-journey-private,#active-journey-friends").hide();
    $("#active-trip-public,#active-trip-private,#active-trip-friends").hide()
    $("#btn-aj-start").on('click', openJourneyModal);
    $("#btn-start-journey").on('click', startJourney);

});


