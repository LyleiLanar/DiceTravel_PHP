<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TripsFixture
 */
class TripsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Trip adatai
', 'autoIncrement' => true, 'precision' => null],
        'journey_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'A triphez tartozó journey_id
', 'precision' => null, 'autoIncrement' => null],
        'serial_number' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Ez határozza meg az egy journeybe tartozó tripek sorrendjét.
', 'precision' => null, 'autoIncrement' => null],
        'end_location' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => 'Itt van eltárolva a trip célállomása.
', 'precision' => null],
        'end_date' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => 'Ez mutatja meg, hogy vége van-e a tripnek. Ha a Journeynek van olyan tripje, ami null, akkor az az aktív.\\n'],
        'visibility' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => 'A trip láthatósága. (2: public, 1: friendOnly, 0: private)
', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'journey_id_idx' => ['type' => 'index', 'columns' => ['journey_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'journey_id' => ['type' => 'foreign', 'columns' => ['journey_id'], 'references' => ['journeys', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_hungarian_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'journey_id' => 1,
                'serial_number' => 1,
                'end_location' => 'Lorem ipsum dolor ',
                'end_date' => '2021-09-28 16:10:20',
                'visibility' => 1,
            ],
        ];
        parent::init();
    }
}
