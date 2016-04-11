<?php


class Transporter extends Eloquent {
    
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
    
    public function vehicles(){
     return $this->hasMany('Vehicle','transporter_fk','id')
     ->join('vehicles_type','vehicles_type.id','=','vehicletype_fk')
     ->select('vehicles.id', 'licenceplate', 'transporter_fk', 'vehicletype_fk', 'active', 'vehicles_type.type');
    }
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transporters';
	
	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	     
	    if($validation->passes()) return true;
	     
	
	    static::$messages = $validation->messages();
	     
	    return false;	
	
	}


}
