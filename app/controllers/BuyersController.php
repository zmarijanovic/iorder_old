<?php

class BuyersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {
        return View::make('buyers.index');
        
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
        
        
            $buyers=Buyer::where('cname','like', '%'.$searchPhrase.'%')->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
        
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
                'total' => Buyer::where('cname','like', '%'.$searchPhrase.'%')->count(),
            );
             
            return $data;
        } else return View::make('buyers.index');
    
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
public function create()
    {
        
        return View::make('buyers.create');
        
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(! Buyer::isValid(Input::all()))
        {
    
//             return Redirect::back()->withInput()->withErrors(Buyer::$messages);
            return Response::json (array('errorMsg'=>Buyer::$messages));
    
        }
    
    
        $buyer= new Buyer;
        $buyer->cname=Input::get('cname');
        $buyer->pname=Input::get('pname');
        $buyer->email=Input::get('email');
        $buyer->phone=Input::get('phone');
        $buyer->mobile=Input::get('mobile');
        $buyer->fax=Input::get('fax');
        $buyer->street=Input::get('street');
        $buyer->zip=Input::get('zip');
        $buyer->city=Input::get('city');
        $buyer->country=Input::get('country');
        $buyer->web=Input::get('web');
        $buyer->notes=Input::get('notes');
        $buyer->save();
    
        // redirect
//         return Redirect::to('buyers');
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
//     {
        
//         $buyer=Buyer::find($id);
//         return View::make('buyers.show')->with('buyer',$buyer);
    
//     }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
    {
        $buyer=Buyer::find($id);
        return View::make('buyers.edit')->with('buyer',$buyer);
    
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        if(! Buyer::isValid(Input::all()))
        {
            
//             return Redirect::back()->withInput()->withErrors(Buyer::$messages);
            return Response::json (array('errorMsg'=>Buyer::$messages));
            
        }
        
        
        $buyer=Buyer::find($id);
        $buyer->cname=Input::get('cname');
        $buyer->pname=Input::get('pname');
        $buyer->email=Input::get('email');
        $buyer->phone=Input::get('phone');
        $buyer->mobile=Input::get('mobile');
        $buyer->fax=Input::get('fax');
        $buyer->street=Input::get('street');
        $buyer->zip=Input::get('zip');
        $buyer->city=Input::get('city');
        $buyer->country=Input::get('country');
        $buyer->web=Input::get('web');
        $buyer->notes=Input::get('notes');
        $buyer->save();
        
        // redirect       
//         return Redirect::action('BuyersController@show',array($id));
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
		$buyer=Buyer::find($id);
        $buyer->delete();
        
        $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_dOK')
        );
        
        return Response::json( $response );
	}


}
