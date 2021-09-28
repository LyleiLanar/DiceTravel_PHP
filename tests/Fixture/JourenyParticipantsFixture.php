<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JourenyParticipantsFixture
 */
class JourenyParticipantsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'user_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'User azonosító
', 'autoIncrement' => true, 'precision' => null],
        'journey_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => '-1', 'comment' => 'Journey azonosító
(-1 esetlben nem lett létrehozva neki journey. ez baj)', 'precision' => null, 'autoIncrement' => null],
        'accepted' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => 'Ez mutatja meg, hogy az adott felhasználó elfogadta-e már a journey invitációt. (1:elfogadta; 0: elutasította)
', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'journey_id_connect_idx' => ['type' => 'index', 'columns' => ['journey_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_id'], 'length' => []],
            'journey_id_connect' => ['type' => 'foreign', 'columns' => ['journey_id'], 'references' => ['journeys', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'user_id_connect' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'user_id' => 1,
                'journey_id' => 1,
                'accepted' => 1,
            ],
        ];
        parent::init();
    }
}
