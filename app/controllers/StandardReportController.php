<?php

class StandardReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	    return View::make('reports.standard');
	}

	public function indexTransporter()
	{
	    if(Request::ajax()){
	        $take = (Input::has('rowCount')) ? Input::get('rowCount') : '';
	        $skip = (Input::has('current')) ? ((Input::get('current')*$take)-$take) : '';
// 	        $searchPhrase = (Input::has('searchPhrase')) ? Input::get('searchPhrase') : '';
	        $transporterFK= (Input::has('transporterFK')) ? Input::get('transporterFK') : '0';
	        $buyerFK= (Input::has('buyerFK')) ? Input::get('buyerFK') : '0';
	        $sDate= (Input::has('sDate')) ? Input::get('sDate') : date('Y-m-d', mktime(0,0,0,date('m'),1,date('Y')));
	        $eDate= (Input::has('eDate')) ? Input::get('eDate') : date('Y-m-d');
	
	        if((Input::has('sort')) && (!is_null(Input::get('sort')))) {
	            $sortColumn = key(Input::get('sort'));
	            $sortType = Input::get('sort')[$sortColumn];
	             
	        } else {
	
	            $sortColumn = 'id';
	            $sortType = 'desc';
	
	        }
	

	        $whereStatement = '';
	        if($transporterFK <> '0') {
	            $whereStatement = "transporter_fk = '$transporterFK' AND ";
	        }
	        if($buyerFK <> '0'){
// 	            if($transporterFK <> '0') $whereStatement .= " AND ";
	            $whereStatement .= "buyers_fk = '$buyerFK' AND "; 
	        }
	        
	        $whereStatement .= "(order_date BETWEEN '$sDate' AND '$eDate')";
	            
	            
	            
	            
	        $orders=StandardReport::whereRaw($whereStatement)->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
	        
// 	        $orders=Order::where('order_num','like', '%'.$searchPhrase.'%')->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
	
	        $rows = [];
	        foreach($orders as $row) {
	
	            $rows[] = array(
	                'id' => $row->id,
	                'order_date'  => date("d/m/Y", strtotime($row->order_date)),
	                'order_num' => $row->order_num,
	                'order_type' => $row->order_type,
	                'vehicle_type' => $row->vehicle_type,
	                'transporter' => $row->transporter_cname,
	                'buyer' => $row->buyer_cname,
// 	                'pinvoice_amount' => $row->pinvoice_amount,
// 	                'sinvoice_amount' => $row->sinvoice_amount,
	                'route' => $row->tripstart($row->id)->cname." - ".$row->tripend($row->id)->cname,
	                'timeframe' => date("d/m/Y", strtotime($row->tripstart($row->id)->odate))." - ".date("d/m/Y", strtotime($row->tripend($row->id)->odate)),
	                
	            );
	        }
	         
	        $transporter_name = Transporter::find($transporterFK);
	        $data = array(
	            'transporter' => ( isset($transporter_name) ? $transporter_name->cname : ''),
	            'current' => (int)Input::get('current'),
	            'rowCount' => (int)$take,
	            'rows' => $rows,
	            'total' => StandardReport::whereRaw($whereStatement)->count(),
	        );
	         
	        return $data;
	    } else { 
	        $transporters=Transporter::orderBy('cname')->lists('cname','id');
	        $transporters=array_add($transporters,'0','Odaberi');
	        $buyers=Buyer::orderBy('cname')->lists('cname','id');
	        $buyers=array_add($buyers,'0','Odaberi');
	        $last_order_date=StandardReport::orderBy('order_date','desc')->first()->pluck('order_date');
	        return View::make('reports.standard')->with(array('transporters'=>$transporters,'buyers'=>$buyers,'lastdate'=>$last_order_date));
	    }
	
	    }
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
