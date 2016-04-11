<?php

class CompaniesController extends \BaseController {
    
    
    public function index()
    {
        return View::make('companies.index');
    
    }

    public function indexAll()
    {
//         return View::make('companies.index');
//     }

    
//     public function indexAjax()
//     {
//             $companies=Company::orderBy('cname')->get();
//             $companies->each(function ($item){
//                $item->companytype->type;
//             });
//             return $companies;
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
        
        
            $companies=Company::where('cname','like', '%'.$searchPhrase.'%')->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
        
            $rows = [];
            foreach($companies as $row) {
        
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
                'total' => Company::where('cname','like', '%'.$searchPhrase.'%')->count(),
            );
             
            return $data;
        } else return View::make('companies.index');
        
    }
    
    public function indexSuppliers()
    {
//         $companies=Company::suppliers()->orderBy('cname')->paginate(15);
//         return View::make('companies.index')->with('companies', $companies);

// jeasyUI varijanta        
//         $companies=Company::suppliers()->orderBy('cname')->get();
//         if(Request::ajax()){
//             return $companies;
//         } else return View::make('companies.index');

// jquery Bootgrid        

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
          
            
            $companies=Company::suppliers()->where('cname','like', '%'.$searchPhrase.'%')->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
            
            $rows = [];
            foreach($companies as $row) {
                
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
               'total' => Company::suppliers()->where('cname','like', '%'.$searchPhrase.'%')->count(),
           );
           
           return $data;
           
        } else return View::make('companies.index');
        
        
    }
    
    public function indexClients()
    {
//         $companies=Company::clients()->orderBy('cname')->paginate(15);
//         return View::make('companies.index')->with('companies', $companies);

//jqueryUI
//         $companies=Company::clients()->orderBy('cname')->get();
//         if(Request::ajax()){
//             return $companies;
//         } else return View::make('companies.index');

// jqueryBootgrid
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
        
        
            $companies=Company::clients()->where('cname','like', '%'.$searchPhrase.'%')->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
        
            $rows = [];
            foreach($companies as $row) {
        
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
                'total' => Company::clients()->where('cname','like', '%'.$searchPhrase.'%')->count(),
            );
             
            return $data;
            } else return View::make('companies.index');
        
    }
    
    public function indexContacts()
    {
//         $companies=Company::contacts()->orderBy('cname')->paginate(15);
//         return View::make('companies.index')->with('companies', $companies);

//jesyUI
//         $companies=Company::contacts()->orderBy('cname')->get();
//         if(Request::ajax()){
//             return $companies;
//         } else return View::make('companies.index'); 

// jqueryBootgrid
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
        
        
            $companies=Company::contacts()->where('cname','like', '%'.$searchPhrase.'%')->take($take)->skip($skip)->orderBy($sortColumn, $sortType)->get();
        
            $rows = [];
            foreach($companies as $row) {
        
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
                'total' => (int)Company::contacts()->where('cname','like', '%'.$searchPhrase.'%')->count(),
            );
             
            return $data;
        } else return View::make('companies.index');
        
        
        
        
    }
    
    public function create()
    {
        
        $types=CompanyType::all()->lists('type','id');
        return View::make('companies.create')->with('types',$types);
        
    }
    
//     public function show($id)
//     {
        
//         $company=Company::find($id);
//         $types=CompanyType::all()->lists('type','id');
//         return View::make('companies.show')->with(array('company'=>$company,'types'=>$types));
    
//     }
    
    public function edit($id)
    {
        $company=Company::find($id);
        $types=CompanyType::all()->lists('type','id');
        return View::make('companies.edit')->with(array('company'=>$company,'types'=>$types));
    
    }
    
    public function update($id)
    {
        if(! Company::isValid(Input::all()))
        {
            
            //return Redirect::back()->withInput()->withErrors(Company::$messages);
            return Response::json (array('errorMsg'=>Company::$messages));
            
        }
        
        
        $company=Company::find($id);
        $company->companies_type_fk=Input::get('companies_type_fk');
        $company->cname=Input::get('cname');
        $company->pname=Input::get('pname');
        $company->email=Input::get('email');
        $company->phone=Input::get('phone');
        $company->mobile=Input::get('mobile');
        $company->fax=Input::get('fax');
        $company->street=Input::get('street');
        $company->zip=Input::get('zip');
        $company->city=Input::get('city');
        $company->country=Input::get('country');
        $company->web=Input::get('web');
        $company->notes=Input::get('notes');
        $company->save();
        
        // redirect
//         Session::flash('message', 'Successfully updated company!');    

        //if (Request::ajax()) {
             
            $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_uOK')
        );
 
        return Response::json( $response );
//         } else {   
//         return Redirect::to('companies');
//         }

    }
    
    
    public function store()
    {
        if(! Company::isValid(Input::all()))
        {
    
            return Response::json (array('errorMsg'=>Company::$messages));
    
        }
    
    
        $company= new Company;
        $company->companies_type_fk=Input::get('companies_type_fk');
        $company->cname=Input::get('cname');
        $company->pname=Input::get('pname');
        $company->email=Input::get('email');
        $company->phone=Input::get('phone');
        $company->mobile=Input::get('mobile');
        $company->fax=Input::get('fax');
        $company->street=Input::get('street');
        $company->zip=Input::get('zip');
        $company->city=Input::get('city');
        $company->country=Input::get('country');
        $company->web=Input::get('web');
        $company->notes=Input::get('notes');
        $company->save();
    
        if (Request::ajax()) {
        
        $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_cOK')
        );
 
        return Response::json( $response );
                } else {
                return Redirect::to('companies');
                }
    
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $company=Company::find($id);
        $company->delete();
        
        $response = array(
            'success' => 'success',
            'status' => Lang::get('gui.crud_success'),
            'msg' => Lang::get('gui.crud_dOK')
        );
        
        return Response::json( $response );
    }
}
