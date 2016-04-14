<?php

class TransportersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    return View::make('transporters.index');
	}

	public function indexAll()
	{


	    if(Request::ajax()){
	        $take = (Input::has('rowCount')) ? Input::get('rowCount') : '';
	        $skip = (Input::has('current')) ? ((Input::get('current')*$take)-$take) : '';
	        $searchPhrase = (Input::has('searchPhrase')) ? Input::get('searchPhrase') : '';

	        if((Input::has('sort')) && (!is_null(Input::get('sort')))) {
	            $sortColumn = key(Input::get('sort'));
	            $sortType = Input::get('sort')[$sortColumn];

	        } else {

	            $sortColumn = 'cname';
	            $sortType = 'asc';

	        }


	        $buyers=Transporter::where('cname','like', '%'.$searchPhrase.'%')->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();

	        $rows = [];
	        foreach($buyers as $row) {

	            $rows[] = array(
	                'id' => $row->id,
	                'cname' => $row->cname,
	                'city'  => $row->city,
	                'country' => $row->country,
	            );
	        }

	        $data = array(
	            'current' => (int)Input::get('current'),
	            'rowCount' => (int)$take,
	            'rows' => $rows,
	            'total' => Transporter::where('cname','like', '%'.$searchPhrase.'%')->count(),
	        );

	        return $data;
	    } else return View::make('transporters.index');

	}




	public function listAjax()
	{
	    $transporters=Transporter::orderBy('cname')->get();
	    // array_add($transporters[0], 'selected', 'true');
	    return $transporters;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('transporters.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(! Transporter::isValid(Input::all()))
        {

            return Response::json (array('errorMsg'=>Transporter::$messages));

        }

        $transporter= new Transporter;
        $transporter->cname=Input::get('cname');
        $transporter->pname=Input::get('pname');
        $transporter->email=Input::get('email');
        $transporter->phone=Input::get('phone');
        $transporter->mobile=Input::get('mobile');
        $transporter->fax=Input::get('fax');
        $transporter->street=Input::get('street');
        $transporter->zip=Input::get('zip');
        $transporter->city=Input::get('city');
        $transporter->country=Input::get('country');
        $transporter->web=Input::get('web');
        $transporter->notes=Input::get('notes');
        $transporter->save();

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
// 		$transporter=Transporter::find($id);
//         return View::make('transporters.show')->with('transporter',$transporter);
// 	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$transporter=Transporter::find($id);
        return View::make('transporters.edit')->with('transporter',$transporter);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(! Transporter::isValid(Input::all()))
        {

            return Response::json (array('errorMsg'=>Transporter::$messages));

        }

        $transporter=Transporter::find($id);
        $transporter->cname=Input::get('cname');
        $transporter->pname=Input::get('pname');
        $transporter->email=Input::get('email');
        $transporter->phone=Input::get('phone');
        $transporter->mobile=Input::get('mobile');
        $transporter->fax=Input::get('fax');
        $transporter->street=Input::get('street');
        $transporter->zip=Input::get('zip');
        $transporter->city=Input::get('city');
        $transporter->country=Input::get('country');
        $transporter->web=Input::get('web');
        $transporter->notes=Input::get('notes');
        $transporter->save();

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
		$transporter=Transporter::find($id);
        $transporter->delete();

        $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_dOK')
        );

        return Response::json( $response );
	}


}
