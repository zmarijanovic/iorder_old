<?php


class Buyer extends Eloquent {
    
    use SoftDeletingTrait;

	public $timestamps = false;
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
	


	public static $rules = [
	    
	    'cname'=>'required',
	    'email'=>'email',
	    'web'=>'url'
	    
	];
	
	public static $messages;
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'buyers';
	


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;	
	
	}
	
	
}
