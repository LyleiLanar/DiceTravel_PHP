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
        <!-- USER DATA -->
        <div id="my-data" class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <span class="boxname border border-dark rounded-3"><h3>My Data</h3></span>
            <div class="row">
                <span class="user-name"></span>
            </div>
            <div class="row">
                <span class="real-name"></span>
            </div>
            <div class="d-flex justify-content-end">
                <span class="btn-modify"><i class="fas fa-cog"></i></span>
            </div>
        </div>
        <!-- JOURNEY DATA -->
        <div id="active-journey" class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <input type="hidden" value="<?= $activeJourney?->id ? $activeJourney?->id : -1 ?>" class="aj-id">
            <span class="boxname border border-dark rounded-3"><h3>Active Journey</h3></span>
            <div class="visibilities d-flex justify-content-start">
                <span class="public pe-1" data-visibility="2"
                      style="">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="friends-only pe-1" data-visibility="1"
                      style="">
                    <i class="fas fa-beer"></i>
                </span>
                <span class="private pe-1" data-visibility="0"
                      style="">
                    <i class="fas fa-eye-slash"></i>
                </span>
                <span class="title"></span>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <span class="start-location"></span>
                    </div>
                    <div class="row">
                        <span class="start-date"></span>
                    </div>
                </div>
                <div class="col d-flex justify-content-end">
                    <span class="btn-save"><i class="far fa-play-circle"></i></span>
                    <span class="btn-delete"><i class="fas fa-trash-alt"></i></span>
                    <span class="btn-modify"><i class="fas fa-cog"></i></span>
                </div>
            </div>
        </div>
        <!-- TRIP DATA -->
        <div id="active-trip" class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <input type="hidden" value="" class="aj-id">
            <span class="boxname border border-dark rounded-3"><h3>Active Trip</h3></span>
            <div class="visibilities d-flex justify-content-start">
                 <span class="public pe-1" data-visibility="2"
                       style="">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="friends-only pe-1" data-visibility="1"
                      style="">
                    <i class="fas fa-beer"></i>
                </span>
                <span class="private pe-1" data-visibility="0"
                      style="">
                    <i class="fas fa-eye-slash"></i>
                </span>
                <span class="destination"></span>
            </div>
            <div class="row">
                <div class="col">
                    <span class="entrycount"></span>
                </div>
                <div class="col d-flex justify-content-end">
                    <span class="btn-finish"><i class="fas fa-flag"></i></span>
                    <span class="btn-add-entry"><i class="fas fa-feather-alt"></i></span>
                    <span class="btn-modify"><i class="fas fa-cog"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div id="flow-frame" class="row">
        <div class="col-11 border border-dark rounded-3">
            <span class="boxname border border-dark rounded-3"><h3>Flow</h3></span>
            <div class="row d-flex justify-content-end">
                <div class="col-4">
                    <div class="search-input-group input-group input-group-lg">
                        <input class="form-control" name="search_field" class="search-field" type="text"
                               placeholder="Keresés...">
                        <span class="input-group-btn" class="btn-flow-frame-search">
                            <button class="btn btn-info"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-1 d-flex align-items-center flex-column">
            <span class="refresh pe-1"><i class="fas fa-sync-alt"></i></span>
            <span class="myflow pe-1"><i class="fas fa-home"></i></span>
            <span class="storyflow pe-1"><i class="fas fa-road"></i></span>
        </div>
    </div>
</div>

<!--Ez lesz a Start Journey modal ablak-->
<div class="modal fade" id="start-journey-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start Journey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post"
                      action="<?= \Cake\Routing\Router::url(["controller" => "Journeys", "action" => "add", "_ext" => "json"]) ?>">
                    <h3>Journey data:</h3>
                    <label for="title">Title</label>
                    <input type="text" name="title" class="title">

                    <label for="startlocation">Start location</label>
                    <input type="text" name="start_location" class="startlocation">

                    <label for="visibility">Visibility</label>
                    <select name="visibility" class="visibility">
                        <option value="2">Public</option>
                        <option value="1">Only friends</option>
                        <option value="0">Private</option>
                    </select>
                    <hr class="mt-4 pt-1"/>
                    <h3>First trip data:</h3>
                    <label for="trip-end-location">Destination</label>
                    <input type="text" name="trips[0][end_location]" class="trip-end-location">

                    <label for="first-trip-visibility">Visibility</label>
                    <select name="trips[0][visibility]" class="first-trip-visibility">
                        <option value="2">Public</option>
                        <option value="1">Only friends</option>
                        <option value="0">Private</option>
                    </select>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-save btn btn-primary">Start</button>
            </div>
        </div>
    </div>
</div>

<!--Ez lesz az Modify Journey modal ablak-->
<div class="modal fade" id="edit-journey-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modify Journey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post"
                      action="<?= \Cake\Routing\Router::url(["controller" => "Journeys", "action" => "add", "_ext" => "json"]) ?>">
                    <h3>Journey data:</h3>

                    <label for="title">Title</label>
                    <input type="text" name="title" class="title">

                    <label for="startlocation">Start location</label>
                    <input type="text" name="start_location" class="startlocation">

                    <label for="visibility">Visibility</label>
                    <select name="visibility" class="visibility">
                        <option value="2">Public</option>
                        <option value="1">Only friends</option>
                        <option value="0">Private</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-save btn btn-primary">Start</button>
            </div>
        </div>
    </div>
</div>

<!--Ez lesz az Add/Edit Trip modal ablak-->
<div class="modal fade" id="trip-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Active Trip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post"
                      action="<?= \Cake\Routing\Router::url(["controller" => "Trips", "action" => "add", "_ext" => "json"]) ?>">
                    <h3>Trip data:</h3>

                    <input type="hidden" name="journey_id" class="journey-id">

                    <label for="end-location">Destination</label>
                    <input type="text" name="end_location" class="end-location">

                    <label for="visibility">Visibility</label>
                    <select name="visibility" class="visibility">
                        <option value="2">Public</option>
                        <option value="1">Only friends</option>
                        <option value="0">Private</option>
                    </select>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-fin-journey btn btn-danger">Finish Journey</button>
                <button type="button" class="btn-ok btn btn-primary">Next Trip</button>
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
                <p class="txt-confirmation text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abort</button>
                <button type="button" class="btn-confirmation-ok btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->script(['constants', 'journey-index']) ?>


