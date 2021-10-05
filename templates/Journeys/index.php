<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journey[]|\Cake\Collection\CollectionInterface $journeys
 */
?>
<div class="index content">
    <div>
        <h3>My Data</h3>
        <span>user_name</span>
        <button>user_settings</button>
    </div>
    <div>
        <h3>Active Journey</h3>
        <span>j_name</span>
        <span>start_loc</span>
        <button>new_jou</button>
        <button>del_jou</button>
        <button>mod_jou</button>
    </div>
    <div>
        <h3>Next Destination</h3>
        <span>trip_name</span>
        <button>new_trip</button>
        <button>new_entry</button>
        <button>mod_trip</button>
    </div>
    <div>
        <h3>Flow</h3>
        <label for="search-field"></label>
        <input name="search_field" id="search-field" type="text">
        <button>Search!</button>
    </div>
    <div>
        <button>refresh</button>
    </div>

</div>
