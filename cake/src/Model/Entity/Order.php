<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string|null $payment_method
 * @property float|null $payment_price
 * @property float $total
 * @property string $status
 * @property int $restaurant_id
 * @property int $address_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Restaurant $restaurant
 * @property \App\Model\Entity\Address $address
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Plate[] $plates
 */
class Order extends Entity
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
        'payment_method' => true,
        'payment_price' => true,
        'total' => true,
        'status' => true,
        'restaurant_id' => true,
        'address_id' => true,
        'user_id' => true,
        'restaurant' => true,
        'address' => true,
        'user' => true,
        'plates' => true,
    ];
}
