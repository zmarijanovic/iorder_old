<?php


class CustomsAgent extends Eloquent {
    

	public $timestamps = false;
	protected $guarded = ['id'];
	

	public static $rules = [
	    
	    'cname'=>'required'
	    
	];
	
	public static $messages;
	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customs_agents';


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;
	
	
	
	
	}
	
	
}
