<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\FoldingGate;
use App\Http\Models\FoldingGateOrder;
use App\Http\Models\FoldingGateOrderDetail;
use App\Http\Models\Unit;

use Auth;
use PDF;

class FoldingGateOrdersController extends Controller
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

        return view('folding_gate_orders.index');
    }

    public function getAdd()
    {
        $option = FoldingGate::getDataAll();
        $data = [
                'option' => $option,
            ];
        return view('folding_gate_orders.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $details = $response['order'];
        $array_check = array();

        if(!is_numeric($response['phone']))
        {
            flash('Phone number must be numbers only')->error();
            return redirect()->route('folding_gate_order');
        }

        foreach($details as $val)
        {
            if($val['folding_gate_id'] == null)
            {
                continue;
            }
            if (in_array($val['folding_gate_id'], $array_check)) {
                flash('Duplicate data found. Please try again')->error();
                return redirect()->route('folding_gate_order');
            }
            else
            {
                $array_check[] = $val['folding_gate_id'];
            }
        }

        $FoldingGateOrder = new FoldingGateOrder();
        $FoldingGateOrder->name = $response['name'];
        $FoldingGateOrder->date = date('Y-m-d', strtotime($response['date']));
        $FoldingGateOrder->address = $response['address'];
        $FoldingGateOrder->phone_number = $response['phone'];
        $FoldingGateOrder->delete_flag = 0;
        $FoldingGateOrder->created_by = Auth::user()->id;
        
        if($FoldingGateOrder->save()) 
        {
            $id = $FoldingGateOrder->id;
            $grand_total=0;
            foreach($details as $detail)
            {
                if($detail['folding_gate_id']==null)
                {
                    continue;
                }
                $price = $detail['price'];
                $qty = $detail['qty']==null? 0 : $detail['qty'];
                $size = $detail['size']==null? 0 : $detail['size'];

                $FoldingGateOrderDetail = new FoldingGateOrderDetail();
                $FoldingGateOrderDetail->folding_gate_order_id = $id;
                $FoldingGateOrderDetail->folding_gate_id = $detail['folding_gate_id'];
                $FoldingGateOrderDetail->price = $price;
                $FoldingGateOrderDetail->qty = $qty;
                $FoldingGateOrderDetail->size = $size;
                $subtotal = $price * $qty * $size;
                $grand_total += $subtotal;
                $FoldingGateOrderDetail->save();
            }
            $FoldingGateOrder::where('id', $id)
                                    ->update([
                                        'grand_total' => $grand_total
                                    ]);
            flash('Data succefully saved')->success();
            return redirect()->route('folding_gate_order');
        } else {
            flash('Data failed to save')->error();
            return redirect()->route('folding_gate_order');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('folding_gate_order');
        }

        $parent = FoldingGateOrder::getData($response['id']);
        $child = FoldingGateOrderDetail::getData($response['id']);
        $option = FoldingGate::getDataAll();
        if(empty($parent))
        {
            flash('Data not found')->error();
            return redirect()->route('folding_gate_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('folding_gate_orders.edit', $data);
    }


    public function postEdit(Request $request) {
        $response = $request->all();
        $details = $response['order'];
        $id = $response['id'];
        $array_check = array();

        if(!is_numeric($response['phone']))
        {
            flash('Phone number must be numbers only')->error();
            return redirect()->route('folding_gate_order');
        }
        foreach($details as $val)
        {
            if($val['folding_gate_id'] == null)
            {
                continue;
            }
            if (in_array($val['folding_gate_id'], $array_check)) {
                flash('Duplicate data found. Please try again')->error();
                return redirect()->route('folding_gate_order');
            }
            else
            {
                $array_check[] = $val['folding_gate_id'];
            }
        }

        $FoldingGateOrder = new FoldingGateOrder();
        $save = $FoldingGateOrder::where('id', $id)
                                    ->update([
                                        'name' => $response['name'],
                                        'date' => date('Y-m-d', strtotime($response['date'])),
                                        'address'  => $response['address'],
                                        'phone_number'  => $response['phone']
                                    ]);
        
        if($save) 
        {
            FoldingGateOrderDetail::where('folding_gate_order_id', $id)->delete();
            $grand_total=0;
            foreach($details as $detail)
            {
                if($detail['folding_gate_id']==null)
                {
                    continue;
                }
                $price = $detail['price'];
                $qty = $detail['qty']==null? 0 : $detail['qty'];
                $size = $detail['size']==null? 0 : $detail['size'];

                $FoldingGateOrderDetail = new FoldingGateOrderDetail();
                $FoldingGateOrderDetail->folding_gate_order_id = $id;
                $FoldingGateOrderDetail->folding_gate_id = $detail['folding_gate_id'];
                $FoldingGateOrderDetail->price = $price;
                $FoldingGateOrderDetail->qty = $qty;
                $FoldingGateOrderDetail->size = $size;
                $subtotal = $price * $qty * $size;
                $grand_total += $subtotal;
                $FoldingGateOrderDetail->save();
            }
            $FoldingGateOrder::where('id', $id)
                                    ->update([
                                        'grand_total' => $grand_total
                                    ]);
            flash('Data succefully updated')->success();
            return redirect()->route('folding_gate_order');
        } else {
            flash('Data failed to update')->error();
            return redirect()->route('folding_gate_order');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('folding_gate_order');
        }

        $parent = FoldingGateOrder::getData($response['id']);
        $child = FoldingGateOrderDetail::getData($response['id']);
        $option = FoldingGate::getDataAll();
        if(empty($parent))
        {
            flash('Data not found')->error();
            return redirect()->route('folding_gate_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('folding_gate_orders.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = FoldingGateOrder::where('id', $id)
                                    ->update([
                                        'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data succefully deleted')->success();
            return redirect()->route('folding_gate_order');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('folding_gate_order');
        }
    }

    public function getView(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('folding_gate_order');
        }

        $parent = FoldingGateOrder::getData($response['id']);
        $child = FoldingGateOrderDetail::getData($response['id']);
        $option = FoldingGate::getDataAll();
        if(empty($parent))
        {
            flash('Data not found')->error();
            return redirect()->route('folding_gate_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('folding_gate_orders.view', $data);
    }


    public function getDatatables()
    {
        return Datatables::of(FoldingGateOrder::getDataTable())->make(true);
    }

    public function getPrint(Request $request)
    {
        $response = $request->all();
        $id = $response['id'];
        $header = FoldingGateOrder::getData($id);
        $child = FoldingGateOrderDetail::getData($id);
        $header['order_number'] = 'FG-'.$header['id'];
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
