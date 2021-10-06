<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journey[]|\Cake\Collection\CollectionInterface $journeys
 */
?>
<div class="index content">
    <div id="dataview-row" class="row fs-5">
        <div class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <span class="boxname border border-dark rounded-3"><h3>My Data</h3></span>
            <div class="row">
                <span id="txt-user-name">user_name</span>
            </div>
            <div class="d-flex justify-content-end">
                <span id="btn-md-modify"><i class="fas fa-cog"></i></span>
            </div>
        </div>
        <div class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <span class="boxname border border-dark rounded-3"><h3>Active Journey</h3></span>
            <div class="d-flex justify-content-start">
                <span id="active-journey-public" class="pe-1"><i class="fas fa-eye"></i></span>
                <span id="active-journey-friends" class="pe-1"><i class="fas fa-beer"></i></i></span>
                <span id="active-journey-private" class="pe-1"><i class="fas fa-eye-slash"></i></i></span>
                <span id="txt-active-journey">j_name</span>
            </div>
            <div class="row">
                <div class="col">
                    <span class="" id="txt-active-journey-start">start_loc</span>
                </div>
                <div class="col d-flex justify-content-end">
                    <span id="btn-aj-start"><i class="far fa-play-circle"></i></span>
                    <span id="btn-aj-delete"><i class="fas fa-trash-alt"></i></span>
                    <span id="btn-aj-modify"><i class="fas fa-cog"></i></span>
                </div>
            </div>
        </div>
        <div class="col border border-dark rounded-3 me-3 mb-5 bg-warning">
            <span class="boxname border border-dark rounded-3"><h3>Active Trip</h3></span>
            <div class="d-flex justify-content-start">
                <span id="active-trip-public" class="pe-1"><i class="fas fa-eye"></i></span>
                <span id="active-trip-friends" class="pe-1"><i class="fas fa-beer"></i></i></span>
                <span id="active-trip-private" class="pe-1"><i class="fas fa-eye-slash"></i></i></span>
                <span id="txt-active-trip-name">trip_name</span>
            </div>
            <div class="row">
                <div class="col">
                    <span class="" id="txt-active-trip-entrycount">sum_entries</span>
                </div>
                <div class="col d-flex justify-content-end">
                    <span id="btn-at-finish"><i class="fas fa-flag"></i></span>
                    <span id="btn-aj-add-entry"><i class="fas fa-feather-alt"></i></span>
                    <span id="btn-aj-modify"><i class="fas fa-cog"></i></span>
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
            <span id="btn-flow-frame-refresh" class="pe-1"><i class="fas fa-eye"></i></span>
            <span id="btn-flow-frame-myflow" class="pe-1"><i class="fas fa-beer"></i></i></span>
            <span id="btn-flow-frame-storyflow" class="pe-1"><i class="fas fa-eye-slash"></i></i></span>
        </div>
    </div>
</div>

<?= $this->Html->script('journey-index') ?>
