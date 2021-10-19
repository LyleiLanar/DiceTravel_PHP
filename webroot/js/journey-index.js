'use strict';

/**
 * @var clientData - it comes from the backend with essential information.
 */

let journeyModal, confirmationModal = null;

const showModal = function (modal) {
    modal.show();
}
const hideModal = function (modal) {
    modal.hide();
}

const showConfirmationModal = function (verify, text) {
    $('#txt-confirmation').text(text);
    $('#btn-confirmation-ok').on('click', verify);
    confirmationModal.show();
}

const hideConfirmationModal = function () {
    $('#btn-confirmation-ok').off();
    confirmationModal.hide();
}

const setVisibility = function (what, visibility) {
    $('#active-' + what + ' div.visibilities span[data-visibility]').hide();
    $('#active-' + what + ' div.visibilities span[data-visibility=' + visibility + ']').show();
}

const startJourney = function () {
    const journeyForm = $("#form-new-journey");

    $.ajax(
        {
            url: journeyForm.attr("action"),
            method: "POST",
            data: journeyForm.serializeArray(),
            dataType: "json",
        })
        .done(function (data) {
            if (data === null) {
                alert('Backend function error! Error in save process...');
                return;
            }
            if (data.success === true) {
                console.log(data);
                clientData.activeJourney = data.entity;
                $('#txt-active-journey').text(data.entity.title);
                $('#txt-active-journey-start-location').text(data.entity.start_location);
                $('#txt-active-journey-start-date').text(moment(data.entity.start_date).locale('hu').format('L LT'));
                $('#txt-active-trip-destination').text(data.entity.trips[0].end_location);

                setVisibility('journey', data.entity.visibility);
                setVisibility('trip', data.entity.trips[0].visibility);

                $('#btn-aj-delete').removeClass("dt_disable");
                $('#btn-aj-modify').removeClass("dt_disable");

                $('#btn-at-finish').removeClass("dt_disable");
                $('#btn-at-add-entry').removeClass("dt_disable");
                $('#btn-at-modify').removeClass("dt_disable");



            } else {
                alert(data.message);
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {

            alert('Fail! ' + jqXHR?.responseJSON?.message || jqXHR?.statusText || "FATAL error");

            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    journeyModal.hide();
}

const deleteJourney = function () {
    hideConfirmationModal();

    $.ajax(
        {
            url: clientData.links.journeyDelete + "/" + clientData.activeJourney.id,
            method: "DELETE",
            data: {},
            dataType: "json",
        })
        .done(function (data) {
            $('#active-journey div.visibilities span[data-visibility]').hide();
            $('#active-trip div.visibilities span[data-visibility]').hide();
            clientData.activeJourney = null;
            $('#btn-aj-delete').addClass("dt_disable");
            $('#btn-aj-modify').addClass("dt_disable");

            $('#btn-at-finish').addClass("dt_disable");
            $('#btn-at-add-entry').addClass("dt_disable");
            $('#btn-at-modify').addClass("dt_disable");

            $('#txt-active-journey').text('No Active Journey');
            $('#txt-active-trip-destination').text('No Active Journey');

            $('#txt-active-journey-start-location').text('');
            $('#txt-active-journey-start-date').text('');

            console.log(data);
        });
    // console.log('delete is complete!');
}

const initialize = function () {
    $('#active-journey div.visibilities span[data-visibility]').hide();
    $('#active-trip div.visibilities span[data-visibility]').hide();
    //csinálni kell ide egy cliendData ellenőrzést, hogy null-e
    $('#txt-user-name').text(clientData.loggedUser.login_name);
    $('#txt-user-real-name').text((clientData.loggedUser.sur_name || '') + ' ' + (clientData.loggedUser.first_name || ''));
    if (clientData.activeJourney) {
        $('#txt-active-journey').text(clientData.activeJourney.title);
        $('#txt-active-journey-start-location').text(clientData.activeJourney.start_location);
        $('#txt-active-journey-start-date').text(moment(clientData.activeJourney.start_date).locale('hu').format('L LT'));
        $('#txt-active-trip-destination').text(clientData.activeJourney.trips[0].end_location);

        setVisibility('journey', clientData.activeJourney.visibility);
        setVisibility('trip', clientData.activeJourney.trips[0].visibility);
    } else {
        clientData.activeJourney = null;
        $('#btn-aj-delete').addClass("dt_disable");
        $('#btn-aj-modify').addClass("dt_disable");

        $('#btn-at-finish').addClass("dt_disable");
        $('#btn-at-add-entry').addClass("dt_disable");
        $('#btn-at-modify').addClass("dt_disable");

        $('#txt-active-journey').text('No Active Journey');
        $('#txt-active-trip-destination').text('No Active Journey');
    }
}

//onload
$(function () {
    initialize();
    journeyModal = new bootstrap.Modal($("#journey-modal"));
    confirmationModal = new bootstrap.Modal($("#confirmation-modal"));
    $("#btn-aj-start").on('click', showModal.bind(null, journeyModal));
    $("#btn-aj-modify").on('click', showModal.bind(null, journeyModal));
    $("#btn-start-journey").on('click', startJourney);
    $("#btn-aj-delete").on('click', showConfirmationModal.bind(null, deleteJourney, constants.journey.DELETE_JOURNEY_CONFRIM));
    //itt is meg kellene oldani, hogy a megfelelő metódust bindoljuk rá az ok gombra, attól függően, hogy update vagy start történik
});
