<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plate Entity
 *
 * @property int $id
 * @property string $title
 * @property string $photo
 * @property string $description
 * @property float $price
 * @property int $restaurant_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Restaurant $restaurant
 * @property \App\Model\Entity\PlateOption[] $plate_options
 */
class Plate extends Entity
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
        'restaurant_id' => true,
        'created' => true,
        'modified' => true,
        'restaurant' => true,
        'plate_options' => true,
    ];
}
