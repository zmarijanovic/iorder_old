<?php


class OrderCustoms extends Eloquent {
    

	public $timestamps = false;
	protected $guarded = ['id'];
	

	public static $rules = [
	    
	    'customs_type_fk'=>'required|integer',
	    'customs_city_fk'=>'required|integer',
	    'customs_agents_fk'=>'required|integer'
	    
	];
	
	public static $messages;
	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders_customs';
	
	public function agent(){
	    return $this->hasOne('CustomsAgent','id','customs_agents_fk');
	}
	public function city(){
	    return $this->hasOne('CustomsCity','id','customs_city_fk');
	}
	public function type(){
	    return $this->hasOne('CustomsType','id','customs_type_fk');
	}


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;
	
	
	
	
	}
	
	
}
