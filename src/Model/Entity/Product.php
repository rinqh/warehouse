<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $code
 * @property int $category_id
 * @property string $name
 * @property float $price
 * @property int $unit_id
 * @property float $quantity
 * @property bool $status
 * @property string $note
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Unit $unit
 */
class Product extends Entity
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
        'code' => true,
        'category_id' => true,
        'name' => true,
        'price' => true,
        'unit_id' => true,
        'quantity' => true,
        'status' => true,
        'note' => true,
        'created' => true,
        'modified' => true,
        'category' => true,
        'unit' => true
    ];
}
