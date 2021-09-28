<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EntriesFixture
 */
class EntriesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Entry azonosítója
', 'autoIncrement' => true, 'precision' => null],
        'trip_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Az entry-hez tartozó trip-id 
', 'precision' => null, 'autoIncrement' => null],
        'entry_date' => ['type' => 'timestampfractional', 'length' => null, 'precision' => 1, 'null' => false, 'default' => null, 'comment' => 'Az entry bejegyzésének az ideje.
'],
        'picture' => ['type' => 'binary', 'length' => 16777215, 'null' => true, 'default' => null, 'comment' => 'Az entry-hez tartozó kép.\\n', 'precision' => null],
        'comment' => ['type' => 'string', 'length' => 1024, 'null' => false, 'default' => 'Üres comment!', 'collate' => 'utf8_hungarian_ci', 'comment' => 'Az entry-hez tartozó szöveg.\\n', 'precision' => null],
        'visibility' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => 'A trip lĂˇthatĂłsĂˇga. (2: public, 1: friendOnly, 0: private)
', 'precision' => null, 'autoIncrement' => null],
        'title' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'trip_id_idx' => ['type' => 'index', 'columns' => ['trip_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'trip_id' => ['type' => 'foreign', 'columns' => ['trip_id'], 'references' => ['trips', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'trip_id' => 1,
                'entry_date' => 1632838220,
                'picture' => 'Lorem ipsum dolor sit amet',
                'comment' => 'Lorem ipsum dolor sit amet',
                'visibility' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
