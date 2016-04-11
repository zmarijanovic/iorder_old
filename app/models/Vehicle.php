<?php


class Vehicle extends Eloquent {
    
    use SoftDeletingTrait;

	public $timestamps = false;
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
	


	public static $rules = [
	    
	    'licenceplate'=>'required',
	    'transporter_fk'=>'required|integer',
	    'vehicletype_fk'=>'required|integer'
	    
	    
	];
	
	public static $messages;
	
	public function transporter(){
	    return $this->belongsTo('Transporter','transporter_fk','id');
	}
	public function type(){
	    return $this->hasOne('VehicleType','id','vehicletype_fk');
	}
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vehicles';


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;
	
	
	
	
	}
	
	
}
