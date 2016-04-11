<?php


class AccessLevel extends Eloquent {

	public $timestamps = false;
	protected $guarded = ['id'];
	


	public static $rules = [
	    
	    'type'=>'required|integer'
	    
	];
	
	public static $messages;
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'access_level';
	
	public function user(){
	    return $this->belongsTo('User','access_level_fk','id');
	}


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;
	
	
	
	
	}
	
	
}
