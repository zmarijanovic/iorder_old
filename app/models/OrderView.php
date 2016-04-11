<?php


class OrderView extends Eloquent {

	public $timestamps = false;
	protected $guarded = ['id'];
	
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'view-order-trans-buyer';
	
	
	
    public function details(){
     return $this->hasMany('OrderDetail','orders_fk','id')
      ->leftjoin('companies','companies.id','=','orders_details.companies_fk')
      ->leftjoin('orders_actions','orders_actions.id','=','orders_details.orders_actions_fk')
      ->select('orders_details.id', 'odate', 'otime','load', 'companies.cname','orders_actions.type');
    }

    public function tripstart($id){

        $query=OrderDetail::select('odate','companies.cname')
        ->where('orders_fk','=',$id)
        ->where('orders_actions_fk','=','1')
        ->leftjoin('companies','companies.id','=','companies_fk')->first();
        return $query;
    }
    
    public function tripend($id){   
        $query=OrderDetail::select('odate','companies.cname')
        ->where('orders_fk','=',$id)
        ->where('orders_actions_fk','=','2')
        ->leftjoin('companies','companies.id','=','companies_fk')->get();
        return $query->last();

        
     }
	
}
