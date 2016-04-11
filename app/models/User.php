<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public $timestamps = false;
	protected $guarded = ['id'];

    
    use UserTrait, RemindableTrait;

    
    public static $rules = [
         
        'access_level_fk'=>'required|integer',
        'username'=>'required',
        'password'=>'required',
        'email'=>'email',
        'fname'=>'required',
        'lname'=>'required'
	  
    ];
    
    public static $messages;
    
    
    
    
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


	public function accesslevel(){
	    return $this->hasOne('AccessLevel','id','access_level_fk');
	}
	
	
    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	
	
	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	     
	    if($validation->passes()) return true;
	     
	
	    static::$messages = $validation->messages();
	     
	    return false;
	
	
	
	
	}
	
	
	
}
