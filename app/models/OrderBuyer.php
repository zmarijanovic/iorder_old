<?php


class OrderBuyer extends Eloquent {

	public $timestamps = false;
	protected $guarded = ['id'];
	


	public static $rules = [
	    
	    'orders_fk'=>'required|integer',
	    'buyers_fk'=>'required|integer'
	    
	    
	];
	
	public static $messages;
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders_buyers';
	
// 	public function vehicle(){
// 	    return $this->belongsTo('Vehicle','id','vehicletype_fk');
// 	}

	public function buyer(){
	    return $this->hasOne('Buyer','id','orders_fk');
	}


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;
	
	
	
	
	}
	
	
}
