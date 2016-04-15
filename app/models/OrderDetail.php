<?php


class OrderDetail extends Eloquent {

    use SoftDeletingTrait;

	public $timestamps = false;
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
    protected $hidden = array('deleted_at','orders_fk','odate','otime');



	public static $rules = [

	    'orders_fk'=>'required|integer',
// 	    'odate'=>'required',
// 	    'otime'=>'required',
        'o_datetime' => 'required|date_format:"Y-m-d H:i:s"',
	    'companies_fk'=>'required|integer',
	    'load'=>'required',
	    'orders_actions_fk'=>'required|integer'

	];

	public static $messages;


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders_details';

 	public function order(){
 	    return $this->belongsTo('Order','id','orders_fk');
 	}

 	public function standard_report(){
 	    return $this->belongsTo('StandardReport','id','orders_fk');
 	}



 	public function companies(){
 	    return $this->hasMany('Company','companies_fk','id');
 	}

 	public function action(){
 	    return $this->hasOne('OrderAction','orders_actions_fk','id');
 	}

	public static function isValid($data)
	{
	    $validation = Validator::make($data,static::$rules);

	    if($validation->passes()) return true;


        static::$messages = $validation->messages();

	    return false;




	}


}
