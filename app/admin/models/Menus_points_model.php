<?php namespace Admin\Models;

// use Carbon\Carbon;
use Model;

/**
 * Menu Specials Model Class
 * @package Admin
 */
class Menus_points_model extends Model
{
    /**
     * @var string The database table name
     */
    protected $table = 'menu_points';

    protected $primaryKey = 'menu_point_id';

    protected $fillable = ['menu_id', 'point_price', 'point_status'];


    public $casts = [
        'menu_id' => 'integer',
        'point_price' => 'interger',
        'point_status' => 'boolean',
    ];

    public $relation = [
        'belongsTo' => [
            'menu' => ['Admin\Models\Menus_model'],
        ]
    ];

    public function active()
    {
        if (!$this->point_status)
            return FALSE;

        return !($this->isExpired() === TRUE);
    }

    public function getMenuPrice($price)
    {
        if ($this->isFixed())
            return $this->point_price;

        return $price - (($price / 100) * round($this->point_price));
    }
}