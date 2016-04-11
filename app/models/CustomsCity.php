<?php


class CustomsCity extends Eloquent {
    

	public $timestamps = false;
	protected $guarded = ['id'];
	

	public static $rules = [
	    
	    'city'=>'required'
	    
	];
	
	public static $messages;
	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customs_city';


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;
	
	
	
	
	}
	
	
}
