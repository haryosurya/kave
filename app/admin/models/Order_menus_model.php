<?php namespace Admin\Models;

use Admin\Traits\HasInvoice;
use Admin\Traits\Locationable;
use Admin\Traits\LogsStatusHistory;
use Admin\Traits\ManagesOrderItems;
use Event;
use Igniter\Flame\Auth\Models\User;
use Main\Classes\MainController;
use Model;
use Request;
use System\Traits\SendsMailTemplate;

/**
 * Orders Model Class
 *
 * @package Admin
 */
class Order_menus_model extends Model
{

    /**
     * @var string The database table name
     */
    protected $table = 'order_menus';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'order_menu_id';

    public $casts = [
        'order_id' => 'integer',
        'menu_id' => 'integer',
        'name' => 'integer',
        'quantity' => 'integer',
        'price' => 'integer',
        'subtotal' => 'integer',
        'option_values' => 'integer',
        'comment' => 'text',
    ];


   }
