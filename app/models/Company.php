<?php


class Company extends Eloquent {
    
    use SoftDeletingTrait;

	public $timestamps = false;
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
	


	public static $rules = [
	    
	    'companies_type_fk'=>'required|integer',
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
	protected $table = 'companies';
	
	public function companytype(){
	    return $this->hasOne('CompanyType','id','companies_type_fk');
	}
	
	public function scopeSuppliers($query)
	{
	    return $query->where('companies_type_fk','=','2');
	
	}
	
	public function scopeClients($query)
	{
	    return $query->where('companies_type_fk','=','1');
	
	}
	
	public function scopeContacts($query)
	{
	    return $query->where('companies_type_fk','=','3');
	
	}


	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);
	    
	    if($validation->passes()) return true;
	    
	
        static::$messages = $validation->messages();
	    
	    return false;	
	
	}
	
	
}
