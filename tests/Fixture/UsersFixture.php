<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'User azonoító.
', 'autoIncrement' => true, 'precision' => null],
        'login_name' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => 'A  user egyedi neve a rendszerben.', 'precision' => null],
        'pswd' => ['type' => 'string', 'length' => 32, 'null' => false, 'default' => '', 'collate' => 'utf8_hungarian_ci', 'comment' => 'A user jelszavának md5  hash kódja.', 'precision' => null],
        'sur_name' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => 'A user keresztneve.
', 'precision' => null],
        'first_name' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => 'A user vezetékneve.\\n', 'precision' => null],
        'birth_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'A user születési dátuma', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'login_name_UNIQUE' => ['type' => 'unique', 'columns' => ['login_name'], 'length' => []],
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
                'login_name' => 'Lorem ipsum dolor ',
                'pswd' => 'Lorem ipsum dolor sit amet',
                'sur_name' => 'Lorem ipsum dolor ',
                'first_name' => 'Lorem ipsum dolor ',
                'birth_date' => '2021-09-28',
            ],
        ];
        parent::init();
    }
}
