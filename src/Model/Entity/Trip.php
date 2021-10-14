<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Trip Entity
 *
 * @property int $id
 * @property int $journey_id
 * @property string $end_location
 * @property \Cake\I18n\FrozenTime|null $end_date
 * @property int $visibility
 *
 * @property \App\Model\Entity\Journey $journey
 * @property \App\Model\Entity\Entry[] $entries
 */
class Trip extends Entity
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
        'journey_id' => true,
        'end_location' => true,
        'end_date' => true,
        'visibility' => true,
        'journey' => true,
        'entries' => true,
    ];
}
