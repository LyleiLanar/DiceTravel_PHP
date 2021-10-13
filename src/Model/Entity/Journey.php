<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Journey Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $start_location
 * @property \Cake\I18n\FrozenTime $start_date
 * @property int $closed
 * @property int $visibility
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\JourenyParticipant[] $joureny_participants
 * @property \App\Model\Entity\Trip[] $trips
 */
class Journey extends Entity
{
    const VISIBILITY_PRIVATE = 0;
    const VISIBILITY_FRIENDS = 1;
    const VISIBILITY_PUBLIC = 2;

    const VISIBILITIES = [self::VISIBILITY_PRIVATE, self::VISIBILITY_FRIENDS, self::VISIBILITY_PUBLIC];

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
        'user_id' => true,
        'title' => true,
        'start_location' => true,
        'start_date' => true,
        'closed' => true,
        'visibility' => true,
        'user' => true,
        'joureny_participants' => true,
        'trips' => true,
    ];
}
