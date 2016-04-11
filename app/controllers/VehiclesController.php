<?php

class VehiclesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($transporter_fk)
	{
	    return View::make('vehicles.index')->with('transporter',$transporter_fk);
	}
	
	public function indexAll($transporter_fk)
	{
	
	   
	    if(Request::ajax()){
	        $take = (Input::has('rowCount')) ? Input::get('rowCount') : '';
	        $skip = (Input::has('current')) ? ((Input::get('current')*$take)-$take) : '';
	        //$searchPhrase = (Input::has('transporter_fk')) ? Input::get('transporter_fk') : '';
	
	        if((Input::has('sort')) && (!is_null(Input::get('sort')))) {
	            $sortColumn = key(Input::get('sort'));
	            $sortType = Input::get('sort')[$sortColumn];
	
	        } else {
	
	            $sortColumn = 'licenceplate';
	            $sortType = 'asc';
	
	        }
	
	
	        $buyers=Vehicle::where('transporter_fk','=', $transporter_fk)->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
	
	        $rows = [];
	        foreach($buyers as $row) {
	            
	
	            $rows[] = array(
	                'id' => $row->id,
	                'licenceplate' => $row->licenceplate,
	                'vehicletype'  => $row->type->type,
	                'active' => $row->active,
	            );
	        }
	
	        $data = array(
	            'current' => (int)Input::get('current'),
	            'rowCount' => (int)$take,
	            'rows' => $rows,
	            'total' => Vehicle::where('transporter_fk','=', $transporter_fk)->count(),
	        );
	
	        return $data;
	    } else return View::make('vehicles.index');
	
	}
	
	
	
	
	public function listAjax($transporter_fk,$type_fk)
	{
	    $vehicles=Vehicle::where('transporter_fk','=',$transporter_fk)
	    ->where('vehicletype_fk','=',$type_fk)
	    ->where('active','=','1')
	    ->get();
	    if(count($vehicles)<=0) $vehicles=array(array('id'=>0,'licenceplate'=>'Nema Rezultata'));
	    array_add($vehicles[0], 'selected', 'true');
	    return $vehicles;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
        $types=VehicleType::all()->lists('type','id');
        $resources=array(
            'types'=>$types,
            'transporter'=>$id
        );
        return View::make('vehicles.create',$resources);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(! Vehicle::isValid(Input::all()))
        {
    
            return Response::json (array('errorMsg'=>Vehicle::$messages));
    
        }
        
        $vehicle= new Vehicle;
        $vehicle->licenceplate=Input::get('licenceplate');
        $vehicle->transporter_fk=Input::get('transporter_fk');
        $vehicle->vehicletype_fk=Input::get('vehicletype_fk');
        $vehicle->active=(Input::has('active')) ? 1 : 0;
        $vehicle->save();
        
        
	    $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_cOK')
        );
 
        return Response::json( $response );
             
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
// 	public function show($id)
// 	{
// 		//
// 	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vehicle=Vehicle::find($id);
		$types=VehicleType::all()->lists('type','id');
        return View::make('vehicles.edit')->with(array('vehicle'=>$vehicle,'types'=>$types));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
if(! Vehicle::isValid(Input::all()))
        {
    
            return Response::json (array('errorMsg'=>Vehicle::$messages));
    
        }
        
        $vehicle=Vehicle::find($id);
        $vehicle->licenceplate=Input::get('licenceplate');
        $vehicle->transporter_fk=Input::get('transporter_fk');
        $vehicle->vehicletype_fk=Input::get('vehicletype_fk');
        $vehicle->active=(Input::has('active')) ? 1 : 0;
        $vehicle->save();
        
        
        $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_uOK')
        );
        
        return Response::json( $response );
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$vehicle=Vehicle::find($id);
        $vehicle->delete();
        
        $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_dOK')
        );
        
        return Response::json( $response );
	}


}
