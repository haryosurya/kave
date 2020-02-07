<?php namespace Admin\Models;

use Admin\Traits\Locationable;
use Igniter\Flame\Auth\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Model;

/**
 * Reviews Model Class
 *
 * @package Admin
 */
class Points_model extends Model
{
   

    /**
     * @var string The database table name
     */
    protected $table = 'points';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'point_id';


    public $casts = [
        'point_id' => 'integer',
        'customer_id' => 'integer',
        'order_id' => 'integer',
        'value' => 'integer',
    ];
    public $relation = [
        'belongsTo' => [
            'customer' => 'Admin\Models\Customers_model',
            'order' => 'Admin\Models\Orders_model',
        ],
    ];
    public static $relatedSaleTypes = [
        'orders' => 'Admin\Models\Orders_model',
    ];


    public function scopeListFrontEnd($query, $options = [])
    {
        extract(array_merge([
            'page' => 1,
            'pageLimit' => 20,
            'customer' => null,
            'sort' => 'point_id desc',
        ], $options));

        if ($customer instanceof Customers_model) {
            $query->where('customer_id', $customer->getKey());
        }
        else if (strlen($customer)) {
            $query->where('customer_id', $customer);
        }

        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {
            if (in_array($_sort, self::$allowedSortingColumns)) {
                $parts = explode(' ', $_sort);
                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }
                list($sortField, $sortDirection) = $parts;
                $query->orderBy($sortField, $sortDirection);
            }
        }

        return $query->paginate($pageLimit, $page);
    }


}