'use strict';

let editJourneyModal, startJourneyModal, tripModal, confirmationModal = null;

/**
 * @var clientData - It comes from the backend with essential information.
 *
 // */

/**
 * This is the onload method.
 */
$(function () {
    initialize();
    startJourneyModal = new bootstrap.Modal($("#start-journey-modal"));
    confirmationModal = new bootstrap.Modal($("#confirmation-modal"));
    editJourneyModal = new bootstrap.Modal($("#edit-journey-modal"))

    tripModal = new bootstrap.Modal($("#trip-modal"));

    $("#active-journey .btn-save").on('click', showStartJourneyModal);
    $("#active-journey .btn-delete").on('click', deleteJourneyModal);
    $("#active-journey .btn-modify").on('click', showEditJourneyModal);

    $("#active-trip .btn-finish").on('click', showEndTripModal);
    $("#active-trip .btn-modify").on('click', showEditTripModal);

});

/**
 * This method initialize the index page.
 */
const initialize = function () {
    $('#active-journey div.visibilities span[data-visibility]').hide();
    $('#active-trip div.visibilities span[data-visibility]').hide();
    $('#my-data .user-name').text(clientData.loggedUser.login_name);
    $('#my-data .real-name').text((clientData.loggedUser.sur_name || '') + ' ' + (clientData.loggedUser.first_name || ''));
    if (clientData.activeJourney) {
        $('#active-journey .btn-save').addClass("dt_disable");
        $('#active-journey .title').text(clientData.activeJourney.title);
        $('#active-journey .start-location').text(clientData.activeJourney.start_location);
        $('#active-journey .start-date').text(moment(clientData.activeJourney.start_date).locale('hu').format('L LT'));
        $('#active-trip .destination').text(clientData.activeJourney.trips[0].end_location);

        setVisibility('journey', clientData.activeJourney.visibility);
        setVisibility('trip', clientData.activeJourney.trips[0].visibility);
    } else {
        clientData.activeJourney = null;
        $('#active-journey .btn-save').removeClass("dt_disable");
        $('#active-journey .btn-delete').addClass("dt_disable");
        $('#active-journey .btn-modify').addClass("dt_disable");

        $('#active-trip .btn-finish').addClass("dt_disable");
        $('#active-trip .btn-add-entry').addClass("dt_disable");
        $('#active-trip .btn-modify').addClass("dt_disable");

        $('#active-journey .title').text('No Active Journey');
        $('#active-trip .destination').text('No Active Journey');
    }
}

const showStartJourneyModal = function () {
    $("#start-journey-modal form")[0].reset();
    $("#start-journey-modal .btn-save").off('click').on('click', startJourneyProcess);
    startJourneyModal.show();
}

const startJourneyProcess = function () {
    const journeyForm = $("#start-journey-modal form");

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
                clientData.activeJourney = data.entity;
                $('#active-journey .title').text(data.entity.title);
                $('#active-journey .start-location').text(data.entity.start_location);
                $('#active-journey .start-date').text(moment(data.entity.start_date).locale('hu').format('L LT'));
                $('#active-trip .destination').text(data.entity.trips[0].end_location);

                setVisibility('journey', data.entity.visibility);
                setVisibility('trip', data.entity.trips[0].visibility);

                $('#active-journey .btn-save').addClass("dt_disable");
                $('#active-journey .btn-delete').removeClass("dt_disable");
                $('#active-journey .btn-modify').removeClass("dt_disable");

                $('#active-trip .btn-finish').removeClass("dt_disable");
                $('#active-trip .btn-add-entry').removeClass("dt_disable");
                $('#active-trip .btn-modify').removeClass("dt_disable");


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
    startJourneyModal.hide();
    $("#start-journey-modal .btn-save").off('click', startJourneyProcess);
}

const showEditJourneyModal = function () {
    $("#edit-journey-modal form")[0].reset();
    $("#edit-journey-modal .title").val(clientData.activeJourney.title);
    $("#edit-journey-modal .startlocation").val(clientData.activeJourney.start_location);
    $("#edit-journey-modal .visibility").val(clientData.activeJourney.visibility);
    $("#edit-journey-modal .btn-save").off('click').on('click', editJourneyProcess);
    editJourneyModal.show();
}

const editJourneyProcess = function () {

    const journeyForm = $("#edit-journey-modal form");

    $.ajax(
        {
            url: clientData.links.journeyEdit + "/" + clientData.activeJourney.id,
            method: "PATCH",
            data: journeyForm.serializeArray(),
            dataType: "json",
        }
    )
        .done(function (data) {
            if (data === null) {
                alert('Backend function error! Error in save process...');
                return;
            }
            if (data.success === true) {

                clientData.activeJourney = data.entity;
                $('#active-journey .title').text(data.entity.title);
                $('#active-journey .start-location').text(data.entity.start_location);

                setVisibility('journey', data.entity.visibility);


            } else {
                alert(data.message);
            }
        });
    editJourneyModal.hide();
}

/**
 * Ez ellen??rzi, hogy van-e egy??ltal??n mit t??r??lni.
 * Ha igen, akkor megnyitja a modalt, ahol OK-ra elind??tja a t??rl??si folyamatot a deleteJourneyProcess seg??ts??g??vel
 * Ha nem, akkor alertet dob.
 */
const deleteJourneyModal = function () {
    if (clientData?.activeJourney?.id) {
        showConfirmationModal(deleteJourneyProcess, constants.journey.DELETE_JOURNEY_CONFRIM)
    } else {
        alert('No Journey selected!');
    }
}

/**
 * Ez v??gzi a t??nyleges t??rl??s??t a Journeynek. Ajax-szal.
 */
const deleteJourneyProcess = function () {

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

            $('#active-journey .btn-save').removeClass("dt_disable");
            $('#active-journey .btn-delete').addClass("dt_disable");
            $('#active-journey .btn-modify').addClass("dt_disable");

            $('#active-trip .btn-finish').addClass("dt_disable");
            $('#active-trip .btn-add-entry').addClass("dt_disable");
            $('#active-trip .btn-modify').addClass("dt_disable");

            $('#active-journey .title').text('No Active Journey');
            $('#active-trip .destination').text('No Active Journey');

            $('#active-journey .start-location').text('');
            $('#active-journey .start-date').text('');

            console.log(data);


        });
    // console.log('delete is complete!');
}

const showEndTripModal = function () {
    $("#trip-modal form")[0].reset();
    $("#trip-modal .modal-title").text("End Trip or Journey");
    $("#trip-modal .journey-id").val(clientData.activeJourney.id);
    $("#trip-modal .btn-ok").text("Go!").off('click').on('click', nextTripProcess);
    $("#trip-modal .btn-fin-journey").off('click').on('click', endJounreyProcess).show();
    tripModal.show();
}

const nextTripProcess = function () {

    const tripForm = $("#trip-modal form");

    $.ajax(
        {
            url: tripForm.attr('action'),
            method: "POST",
            data: tripForm.serializeArray(),
            dataType: "json",
        })
        .done(function (data) {
            if (data === null) {
                alert('Backend function error! Error in save process...');
                return;
            }
            if (data.success === true) {

                console.log(data);

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


    $("#trip-modal .btn-ok").off('click', nextTripProcess);
    $("#trip-modal .btn-fin-journey").off('click', endJounreyProcess).show();
    tripModal.hide();
}

const endJounreyProcess = function () {
    $("#trip-modal .btn-ok").off('click', nextTripProcess);
    $("#trip-modal .btn-fin-journey").off('click', endJounreyProcess).show();
    tripModal.hide();
    alert('End Journey!');
}

function showEditTripModal() {
    $("#trip-modal form")[0].reset();
    $("#trip-modal .modal-title").text("Edit Active Trip");
    $("#trip-modal .end-location").val(clientData.activeJourney.trips[0].end_location);
    $("#trip-modal .visibility").val(clientData.activeJourney.trips[0].visibility);
    $("#trip-modal .btn-ok").text("Save").off('click').on('click', editTripProcess);
    $("#trip-modal .btn-fin-journey").hide();
    tripModal.show();
}

const editTripProcess = function () {
    let data = $("#trip-modal form").serializeArray();
    data.push({name: "journey_id", value: clientData.activeJourney.id});

    $.ajax({
        url: clientData.links.tripEdit + "/" + clientData.activeJourney.trips[0].id,
        method: "PATCH",
        data: data,
        dataType: "json",
    })
        .done(function (data) {
            if (data === null) {
                alert('Backend function error! Error in save process...');
                return;
            }
            if (data.success === true) {
                clientData.activeJourney.trips[0] = data.entity;

                $('#active-trip .destination').text(clientData.activeJourney.trips[0].end_location);
                setVisibility('trip', data.entity.visibility);
            } else {
                alert(data.message);
            }
        });
    tripModal.hide();
}

const showConfirmationModal = function (verify, text) {
    $('.txt-confirmation').text(text);
    $('.btn-confirmation-ok').off('click').on('click', verify);
    confirmationModal.show();
}

const setVisibility = function (what, visibility) {
    $('#active-' + what + ' div.visibilities span[data-visibility]').hide();
    $('#active-' + what + ' div.visibilities span[data-visibility=' + visibility + ']').show();
}

const hideConfirmationModal = function () {
    $('.btn-confirmation-ok').off();
    confirmationModal.hide();
}

