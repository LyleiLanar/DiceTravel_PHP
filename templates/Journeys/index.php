<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journey[]|\Cake\Collection\CollectionInterface $journeys
 * @var string $loginName
 * @var \App\Model\Entity\Journey $activeJourney
 */
?>
<div class="index content">
    <div id="dataview-row" class="row fs-5">
        <div id="my-data" class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <span class="boxname border border-dark rounded-3"><h3>My Data</h3></span>
            <div class="row">
                <span id="txt-user-name"></span>
            </div>
            <div class="row">
                <span id="txt-user-real-name"></span>
            </div>
            <div class="d-flex justify-content-end">
                <span id="btn-md-modify"><i class="fas fa-cog"></i></span>
            </div>
        </div>
        <div id = "active-journey" class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <input type="hidden" value="<?= $activeJourney?->id ? $activeJourney?->id : -1  ?>" id="aj-id">
            <span class="boxname border border-dark rounded-3"><h3>Active Journey</h3></span>
            <div class="visibilities d-flex justify-content-start">

                <span id="active-journey-public" class="pe-1" data-visibility="2"
                      style="">
                    <i class="fas fa-eye"></i>
                </span>

                <span id="active-journey-friends" class="pe-1" data-visibility="1"
                      style="">
                    <i class="fas fa-beer"></i>
                </span>

                <span id="active-journey-private" class="pe-1" data-visibility="0"
                      style="">
                    <i class="fas fa-eye-slash"></i>
                </span>

                <span id="txt-active-journey"></span>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <span id="txt-active-journey-start-location"></span>
                    </div>
                    <div class="row">
                        <span id="txt-active-journey-start-date"></span>
                    </div>
                </div>
                <div class="col d-flex justify-content-end">
                    <span id="btn-aj-start"><i class="far fa-play-circle"></i></span>
                    <span id="btn-aj-delete"><i class="fas fa-trash-alt"></i></span>
                    <span id="btn-aj-modify"><i class="fas fa-cog"></i></span>
                </div>
            </div>
        </div>
        <div id = "active-trip" class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <input type="hidden" value="" id="aj-id">
            <span class="boxname border border-dark rounded-3"><h3>Active Trip</h3></span>
            <div class="visibilities d-flex justify-content-start">

                <span id="active-trip-public" class="pe-1" data-visibility="2"
                      style="">
                    <i class="fas fa-eye"></i>
                </span>

                <span id="active-trip-friends" class="pe-1" data-visibility="1"
                      style="">
                    <i class="fas fa-beer"></i>
                </span>

                <span id="active-trip-private" class="pe-1" data-visibility="0"
                      style="">
                    <i class="fas fa-eye-slash"></i>
                </span>

                <span id="txt-active-trip-destination"></span>
            </div>
            <div class="row">
                <div class="col">
                    <span class="" id="txt-active-trip-entrycount"></span>
                </div>
                <div class="col d-flex justify-content-end">
                    <span id="btn-at-finish"><i class="fas fa-flag"></i></span>
                    <span id="btn-at-add-entry"><i class="fas fa-feather-alt"></i></span>
                    <span id="btn-at-modify"><i class="fas fa-cog"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div id="flow-frame" class="row">
        <div class="col-11 border border-dark rounded-3">
            <span class="boxname border border-dark rounded-3"><h3>Flow</h3></span>
            <div class="row d-flex justify-content-end">
                <div class="col-4">
                    <div id="flow-frame-search-input-group" class="input-group input-group-lg">
                        <input class="form-control" name="search_field" id="search-field" type="text"
                               placeholder="Keresés...">
                        <span class="input-group-btn" id="btn-flow-frame-search">
                            <button class="btn btn-info"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-1 d-flex align-items-center flex-column">
            <span id="btn-flow-frame-refresh" class="pe-1"><i class="fas fa-sync-alt"></i></span>
            <span id="btn-flow-frame-myflow" class="pe-1"><i class="fas fa-home"></i></span>
            <span id="btn-flow-frame-storyflow" class="pe-1"><i class="fas fa-road"></i></span>
        </div>
    </div>
</div>

<!--Ez lesz a Journey modal ablak-->
<div class="modal fade" id="journey-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start Journey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-new-journey"
                      action="<?= \Cake\Routing\Router::url(["controller" => "Journeys", "action" => "add", "_ext" => "json"]) ?>">
                    <h3>Journey data:</h3>
                    <label for="new-journey-modal-title">Title</label>
                    <input type="text" name="title" id="new-journey-modal-title">

                    <label for="new-journey-modal-startlocation">Start location</label>
                    <input type="text" name="start_location" id="new-journey-modal-startlocation">

                    <label for="new-journey-modal-visibility">Visibility</label>
                    <select name="visibility" id="new-journey-modal-visibility">
                        <option value="2">Public</option>
                        <option value="1">Only friends</option>
                        <option value="0">Private</option>
                    </select>
                    <hr class="mt-4 pt-1"/>
                    <h3>First trip data:</h3>
                    <label for="new-journey-modal-first-trip-end-location">Destination</label>
                    <input type="text" name="trips[0][end_location]" id="new-journey-modal-first-trip-end-location">

                    <label for="new-journey-modal-first-trip-visibility">Visibility</label>
                    <select name="trips[0][visibility]" id="new-journey-modal-first-trip-visibility">
                        <option value="2">Public</option>
                        <option value="1">Only friends</option>
                        <option value="0">Private</option>
                    </select>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btn-start-journey">Start</button>
            </div>
        </div>
    </div>
</div>

<!--Ez lesz a comfirmation modal ablak-->
<div class="modal fade" id="confirmation-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text" id="txt-confirmation"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abort</button>
                <button type="button" class="btn btn-primary" id="btn-confirmation-ok">OK</button>
            </div>
        </div>
    </div>
</div>


<?= $this->Html->script(['constants', 'journey-index']) ?>

<!--IDE MEGPRÓBÁLTAM BERÁNGATNI AZ ÚJ FÁJLT-->

