<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * JourenyParticipant Entity
 *
 * @property int $user_id
 * @property int $journey_id
 * @property int $accepted
 *
 * @property \App\Model\Entity\Journey $journey
 */
class JourenyParticipant extends Entity
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
        'accepted' => true,
        'journey' => true,
    ];
}
