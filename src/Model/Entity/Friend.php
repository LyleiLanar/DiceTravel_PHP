<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Friend Entity
 *
 * @property int $sender_id
 * @property int $getter_id
 * @property int|null $accepted
 *
 * @property \App\Model\Entity\User $user
 */
class Friend extends Entity
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
        'accepted' => true,
        'user' => true,
    ];
}
