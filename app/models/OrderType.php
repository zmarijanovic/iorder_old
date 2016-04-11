<?php


class OrderType extends Eloquent {

	public $timestamps = false;
	protected $guarded = ['id'];
	


	public static $rules = [
	    
	    'type'=>'required'
	    
	];
	
	public static $messages;
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders_type';
	
// 	public function vehicle(){
// 	    return $this->belongsTo('Vehicle','id','vehicletype_fk');
// 	}


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;
	
	
	
	
	}
	
	
}
