<?php

class OrdersController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

     public function listAjax()
   	{

        $orders=Order::where('order_date','>','2013-12-31')->orderBy('id')->skip(10000)->take(5000)->get();
    //  $orders=Order::where('order_date','>','2013-12-31')->orderBy('id')->take(10)->get();


       //  $orders=Order::orderBy('id')->take(1000)->get();
   	    // array_add($transporters[0], 'selected', 'true');
   	   //  return json_encode($orders, JSON_PRETTY_PRINT);
        return $orders;
   	}

    public function index()
    {
        $orders=Order::all()->sortByDesc('id')->take(1);
        $rows = [];
        foreach ($orders as $row) {
            // $details = OrderDetail::where('orders_fk','=',$row->id)->get();
            // $rows[] = array(
            //   'id' => $row->id,
            //   'order_date' => date("d/m/Y", strtotime($row->order_date)),
            //   'order_num' => $row->order_num,
            //   'ordertype_id' => $row->order_type_fk,
            //   'vehicle_id' => $row->vehicle_fk,
            //
            //   'details' => $details
            // );

            array_add($row,'details',$row->details);


          }
            return json_encode($orders);
        //return View::make('orders.org.index',$orders);
    }

    public function orderList()
    {
        if (Request::ajax()) {
            $take = (Input::has('rowCount')) ? Input::get('rowCount') : '';
            $skip = (Input::has('current')) ? ((Input::get('current') * $take) - $take) : '';
            $transporterFK = (Input::has('transporterFK')) ? Input::get('transporterFK') : '0';
            $buyerFK = (Input::has('buyerFK')) ? Input::get('buyerFK') : '0';
            $sDate = (Input::has('sDate')) ? Input::get('sDate') : date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
            $eDate = (Input::has('eDate')) ? Input::get('eDate') : date('Y-m-d');

            if ((Input::has('sort')) && (! is_null(Input::get('sort')))) {
                $sortColumn = key(Input::get('sort'));
                $sortType = Input::get('sort')[$sortColumn];
            } else {

                $sortColumn = 'id';
                $sortType = 'desc';
            }

            $whereStatement = '';
            if ($transporterFK != '0') {
                $whereStatement = "transporter_fk = '$transporterFK' AND ";
            }
            if ($buyerFK != '0') {
                $whereStatement .= "buyers_fk = '$buyerFK' AND ";
            }

            $whereStatement .= "(order_date BETWEEN '$sDate' AND '$eDate')";

            $orders = OrderView::whereRaw($whereStatement)->take($take)
                ->skip($skip)
                ->orderBy($sortColumn, $sortType)
                ->get();

            $rows = [];
            foreach ($orders as $row) {

                $rows[] = array(
                    'id' => $row->id,
                    'order_date' => date("d/m/Y", strtotime($row->order_date)),
                    'order_num' => $row->order_num,
                    'order_type' => $row->order_type,
                    'vehicle_type' => $row->vehicle_type,
                    'transporter_cname' => $row->transporter_cname,
                    'buyer_cname' => $row->buyer_cname,
                    'route' => $row->tripstart($row->id)->cname . " - " . $row->tripend($row->id)->cname
//                     'timeframe' => date("d/m/Y", strtotime($row->tripstart($row->id)->odate)) . " - " . date("d/m/Y", strtotime($row->tripend($row->id)->odate))
                );
            }

            $transporter_name = Transporter::find($transporterFK);
            $data = array(
                'transporter_cname' => (isset($transporter_name) ? $transporter_name->cname : ''),
                'current' => (int) Input::get('current'),
                'rowCount' => (int) $take,
                'rows' => $rows,
                'total' => OrderView::whereRaw($whereStatement)->count()
            );

            return $data;
        } else {
            $transporters = Transporter::orderBy('cname')->lists('cname', 'id');
            $transporters = array_add($transporters, '0', 'Odaberi');
            $buyers = Buyer::orderBy('cname')->lists('cname', 'id');
            $buyers = array_add($buyers, '0', 'Odaberi');
            $last_order_date = OrderView::orderBy('order_date', 'desc')->first()->pluck('order_date');
            return View::make('orders.index')->with(array(
                'transporters' => $transporters,
                'buyers' => $buyers,
                'lastdate' => $last_order_date
            ));
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
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return View::make('orders.show')->with('order', $order);
    }

    public function pdf($id)
    {
        $order = Order::find($id);
        $html = View::make('orders.pdf')->with('order', $order)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4')->setOrientation('portrait');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $otypes = OrderType::all()->lists('type', 'id');
        $transporters = Transporter::orderBy('cname')->lists('cname', 'id');
//         $transporters = array_add($transporters, '0', 'Odaberi');
        $buyers = Buyer::orderBy('cname')->lists('cname', 'id');
//         $buyers = array_add($buyers, '0', 'Odaberi');
        $vtypes=VehicleType::all()->lists('type','id');
//         $companies = Company::orderBy('cname')->lists(concat('cname',' ','city'), 'id');
         $companies = DB::table('companies')->select(DB::raw('concat (cname," (",street," ",zip," ",city," ",country,")") as address,id'))->orderBy('address', 'asc')->lists('address', 'id');
        return View::make('orders.edit')->with(array(
            'order' => $order,
            'order_types' => $otypes,
            'buyers' => $buyers,
            'transporters' => $transporters,
            'companies' => $companies,
            'vehicle_types' => $vtypes
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
           if(! Order::isValid(Input::all()))
        {

            //return Redirect::back()->withInput()->withErrors(Company::$messages);
            return Response::json (array('errorMsg'=>Order::$messages));

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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
