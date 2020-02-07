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
class Order_totals_model extends Model
{

    /**
     * @var string The database table name
     */
    protected $table = 'order_totals';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'order_total_id';


   }
