<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $login_name
 * @property string $pswd
 * @property string|null $sur_name
 * @property string|null $first_name
 * @property \Cake\I18n\FrozenDate|null $birth_date
 *
 * @property \App\Model\Entity\JourenyParticipant[] $joureny_participants
 * @property \App\Model\Entity\Journey[] $journeys
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'login_name' => true,
        'pswd' => true,
        'sur_name' => true,
        'first_name' => true,
        'birth_date' => true,
        'joureny_participants' => true,
        'journeys' => true,
    ];
}
