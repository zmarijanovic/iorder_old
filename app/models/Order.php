<?php


class Order extends Eloquent {

    use SoftDeletingTrait;

	public $timestamps = false;
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
	


	public static $rules = [
	    
 	    'order_date' => 'required|date_format:"Y-m-d"',
	    'order_type_fk' => 'required|integer',
	    'order_num' => 'required|alpha_dash',
	    'vehicle_fk' => 'required|integer'
// 	    'email'=>'email',
// 	    'web'=>'url'
	    
	];
	
	public static $messages;
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';
	
	
	public function type(){
	    return $this->hasOne('OrderType','id','order_type_fk');
	}
	
	public function vehicle(){
	    return $this->hasOne('Vehicle','id','vehicle_fk')
 	    ->join('transporters','vehicles.transporter_fk','=','transporters.id')
	    ->select('vehicles.id','licenceplate','transporters.cname','vehicles.transporter_fk');
	}
	
	public function status(){
	    return $this->hasOne('Status','id','status_fk');
	}
	
    public function details(){
     return $this->hasMany('OrderDetail','orders_fk','id')
      ->leftjoin('companies','companies.id','=','orders_details.companies_fk')
      ->leftjoin('orders_actions','orders_actions.id','=','orders_details.orders_actions_fk')
      ->select('orders_details.id', 'o_datetime','load', 'companies_fk', 'companies.cname', 'companies.street', 'companies.zip', 'companies.city', 'companies.country','orders_actions.type','orders_actions.id AS aid');
    }

    public function tripstart($id){

        $query=OrderDetail::select('odate','companies.cname')
        ->where('orders_fk','=',$id)
        ->where('orders_actions_fk','=','1')
        ->leftjoin('companies','companies.id','=','companies_fk')->first();
        return $query;
    }
    
    public function tripend($id){   
        $query=OrderDetail::select('odate','companies.cname')
        ->where('orders_fk','=',$id)
        ->where('orders_actions_fk','=','2')
        ->leftjoin('companies','companies.id','=','companies_fk')->get();
        return $query->last();

        
     }
     
     public function customs(){
         return $this->hasMany('OrderCustoms','orders_fk','id');
     }

     public function invoices(){
         return $this->hasMany('OrderBuyer','orders_fk','id')
         ->leftjoin('buyers','buyers.id','=','orders_buyers.buyers_fk');
     }
     
  
     
	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;	
	
	}
	
	
}
