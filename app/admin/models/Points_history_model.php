<?php namespace Admin\Models;

use Admin\Traits\Locationable;
use Main\Classes\MainController;

use Model;

/**
 * Reviews Model Class
 *
 * @package Admin
 */
class Points_history_model extends Model
{
    /**
     * @var string The database table name
     */
    protected $table = 'points';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'point_id';

    /**
     * @var array The model table column to convert to dates on insert/update
     */
    public $timestamps = TRUE;

    protected $guarded = [];

    public $relation = [
        'belongsTo' => [
            'customer' => 'Admin\Models\Customers_model',
            'orders' => 'Admin\Models\Orders_model',
        ],

    ];

    public $casts = [
        'customer_id' => 'integer',
        'order_id' => 'integer',
        'point_values' => 'integer',
        'date_added' => 'integer',
    ];

}