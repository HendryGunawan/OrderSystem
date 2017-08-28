<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\RollingDoor;
use App\Http\Models\RollingDoorOrder;
use App\Http\Models\RollingDoorOrderDetail;
use App\Http\Models\Unit;

use Auth;
use PDF;

class RollingDoorOrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('rolling_door_orders.index');
    }

    public function getAdd()
    {
        $option = RollingDoor::getDataAll();
        $data = [
                'option' => $option,
            ];
        return view('rolling_door_orders.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $details = $response['order'];
        $array_check = array();

        if(!is_numeric($response['phone']))
        {
            flash('Phone number must be numbers only')->error();
            return redirect()->route('rolling_door_order');
        }

        foreach($details as $val)
        {
            if($val['rolling_door_id'] == null)
            {
                continue;
            }
            if (in_array($val['rolling_door_id'], $array_check)) {
                flash('Duplicate data found. Please try again')->error();
                return redirect()->route('rolling_door_order');
            }
            else
            {
                $array_check[] = $val['rolling_door_id'];
            }
        }

        $RollingDoorOrder = new RollingDoorOrder();
        $RollingDoorOrder->name = $response['name'];
        $RollingDoorOrder->date = date('Y-m-d', strtotime($response['date']));
        $RollingDoorOrder->address = $response['address'];
        $RollingDoorOrder->phone_number = $response['phone'];
        $RollingDoorOrder->delete_flag = 0;
        $RollingDoorOrder->created_by = Auth::user()->id;
        
        if($RollingDoorOrder->save()) 
        {
            $id = $RollingDoorOrder->id;
            $grand_total=0;
            foreach($details as $detail)
            {
                if($detail['rolling_door_id']==null)
                {
                    continue;
                }
                $price = $detail['price'];
                $qty = $detail['qty']==null? 0 : $detail['qty'];
                $size = $detail['size']==null? 0 : $detail['size'];

                $RollingDoorOrderDetail = new RollingDoorOrderDetail();
                $RollingDoorOrderDetail->rolling_door_order_id = $id;
                $RollingDoorOrderDetail->rolling_door_id = $detail['rolling_door_id'];
                $RollingDoorOrderDetail->price = $price;
                $RollingDoorOrderDetail->qty = $qty;
                $RollingDoorOrderDetail->size = $size;
                $subtotal = $price * $qty * $size;
                $grand_total += $subtotal;
                $RollingDoorOrderDetail->save();
            }
            $RollingDoorOrder::where('id', $id)
                                    ->update([
                                        'grand_total' => $grand_total
                                    ]);
            flash('Data succefully saved')->success();
            return redirect()->route('rolling_door_order');
        } else {
            flash('Data failed to save')->error();
            return redirect()->route('rolling_door_order');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_order');
        }

        $parent = RollingDoorOrder::getData($response['id']);
        $child = RollingDoorOrderDetail::getData($response['id']);
        $option = RollingDoor::getDataAll();
        if(empty($parent))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('rolling_door_orders.edit', $data);
    }


    public function postEdit(Request $request) {
        $response = $request->all();
        $details = $response['order'];
        $array_check = array();
        $id = $response['id'];
        
        if(!is_numeric($response['phone']))
        {
            flash('Phone number must be numbers only')->error();
            return redirect()->route('rolling_door_order');
        }

        foreach($details as $val)
        {
            if($val['rolling_door_id'] == null)
            {
                continue;
            }
            if (in_array($val['rolling_door_id'], $array_check)) {
                flash('Duplicate data found. Please try again')->error();
                return redirect()->route('rolling_door_order');
            }
            else
            {
                $array_check[] = $val['rolling_door_id'];
            }
        }

        $RollingDoorOrder = new RollingDoorOrder();
        $save = $RollingDoorOrder::where('id', $id)
                                    ->update([
                                        'name' => $response['name'],
                                        'date' => date('Y-m-d', strtotime($response['date'])),
                                        'address'  => $response['address'],
                                        'phone_number'  => $response['phone']
                                    ]);
        
        if($save) 
        {
            RollingDoorOrderDetail::where('rolling_door_order_id', $id)->delete();
            $grand_total=0;
            foreach($details as $detail)
            {
                if($detail['rolling_door_id']==null)
                {
                    continue;
                }
                $price = $detail['price'];
                $qty = $detail['qty']==null? 0 : $detail['qty'];
                $size = $detail['size']==null? 0 : $detail['size'];

                $RollingDoorOrderDetail = new RollingDoorOrderDetail();
                $RollingDoorOrderDetail->rolling_door_order_id = $id;
                $RollingDoorOrderDetail->rolling_door_id = $detail['rolling_door_id'];
                $RollingDoorOrderDetail->price = $price;
                $RollingDoorOrderDetail->qty = $qty;
                $RollingDoorOrderDetail->size = $size;
                $subtotal = $price * $qty * $size;
                $grand_total += $subtotal;
                $RollingDoorOrderDetail->save();
            }
            $RollingDoorOrder::where('id', $id)
                                    ->update([
                                        'grand_total' => $grand_total
                                    ]);
            flash('Data succefully updated')->success();
            return redirect()->route('rolling_door_order');
        } else {
            flash('Data failed to update')->error();
            return redirect()->route('rolling_door_order');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_order');
        }

        $parent = RollingDoorOrder::getData($response['id']);
        $child = RollingDoorOrderDetail::getData($response['id']);
        $option = RollingDoor::getDataAll();
        if(empty($parent))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('rolling_door_orders.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = RollingDoorOrder::where('id', $id)
                                    ->update([
                                        'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data succefully deleted')->success();
            return redirect()->route('rolling_door_order');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('rolling_door_order');
        }
    }

    public function getView(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_order');
        }

        $parent = RollingDoorOrder::getData($response['id']);
        $child = RollingDoorOrderDetail::getData($response['id']);
        $option = RollingDoor::getDataAll();
        if(empty($parent))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('rolling_door_orders.view', $data);
    }


    public function getDatatables()
    {
        return Datatables::of(RollingDoorOrder::getDataTable())->make(true);
    }

    public function getPrint(Request $request)
    {
        $response = $request->all();
        $id = $response['id'];
        $header = RollingDoorOrder::getData($id);
        $child = RollingDoorOrderDetail::getData($id);
        $header['order_number'] = 'RD-'.$header['id'];
        $header['date'] = date('d-m-Y', strtotime($header['date']));
        $header['grand_total'] = number_format($header['grand_total']);

        $data = [
            'header' => $header,
            'child' => $child
        ];
        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->stream('document.pdf');
    }
}
