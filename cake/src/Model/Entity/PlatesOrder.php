<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlatesOrder Entity
 *
 * @property int $id
 * @property string $title
 * @property string $photo
 * @property string $description
 * @property float $price
 * @property int $qtd
 * @property int $order_id
 * @property int $restaurant_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Restaurant $restaurant
 */
class PlatesOrder extends Entity
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
        'title' => true,
        'photo' => true,
        'description' => true,
        'price' => true,
        'qtd' => true,
        'order_id' => true,
        'restaurant_id' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'restaurant' => true,
    ];
}
