<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Entry Entity
 *
 * @property int $id
 * @property int $trip_id
 * @property \Cake\I18n\FrozenTime $entry_date
 * @property string|resource|null $picture
 * @property string $comment
 * @property int $visibility
 * @property string $title
 *
 * @property \App\Model\Entity\Trip $trip
 */
class Entry extends Entity
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
        'trip_id' => true,
        'entry_date' => true,
        'picture' => true,
        'comment' => true,
        'visibility' => true,
        'title' => true,
        'trip' => true,
    ];
}
