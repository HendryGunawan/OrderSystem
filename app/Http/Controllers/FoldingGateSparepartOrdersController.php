<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\FoldingGateSparepart;
use App\Http\Models\FoldingGateSparepartOrder;
use App\Http\Models\FoldingGateSparepartOrderDetail;
use App\Http\Models\Unit;

use Auth;
use PDF;

class FoldingGateSparepartOrdersController extends Controller
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

        return view('folding_gate_sparepart_orders.index');
    }

    public function getAdd()
    {
        $option = FoldingGateSparepart::getDataAll();
        $data = [
                'option' => $option,
            ];
        return view('folding_gate_sparepart_orders.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $details = $response['order'];
        $array_check = array();

        if(!is_numeric($response['phone']))
        {
            flash('Nomor telepon harus angka')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        foreach($details as $val)
        {
            if($val['folding_gate_sparepart_id'] == null)
            {
                continue;
            }
            if (in_array($val['folding_gate_sparepart_id'], $array_check)) {
                flash('Data ganda ditemukan. Silahkan coba lagi')->error();
                return redirect()->route('folding_gate_sparepart_order');
            }
            else
            {
                $array_check[] = $val['folding_gate_sparepart_id'];
            }
        }
        
        $FoldingGateSparepartOrder = new FoldingGateSparepartOrder();
        $FoldingGateSparepartOrder->name = $response['name'];
        $FoldingGateSparepartOrder->date = date('Y-m-d', strtotime($response['date']));
        $FoldingGateSparepartOrder->address = $response['address'];
        $FoldingGateSparepartOrder->phone_number = $response['phone'];
        $FoldingGateSparepartOrder->delete_flag = 0;
        $FoldingGateSparepartOrder->created_by = Auth::user()->id;
        
        if($FoldingGateSparepartOrder->save()) 
        {
            $id = $FoldingGateSparepartOrder->id;
            $grand_total=0;
            foreach($details as $detail)
            {
                if($detail['folding_gate_sparepart_id']==null)
                {
                    continue;
                }
                $price = $detail['price'];
                $qty = $detail['qty']==null? 0 : $detail['qty'];
                $size = $detail['size']==null? 0 : $detail['size'];

                $FoldingGateSparepartOrderDetail = new FoldingGateSparepartOrderDetail();
                $FoldingGateSparepartOrderDetail->folding_gate_sparepart_order_id = $id;
                $FoldingGateSparepartOrderDetail->folding_gate_sparepart_id = $detail['folding_gate_sparepart_id'];
                $FoldingGateSparepartOrderDetail->price = $price;
                $FoldingGateSparepartOrderDetail->qty = $qty;
                $FoldingGateSparepartOrderDetail->size = $size;
                $subtotal = $price * $qty * $size;
                $grand_total += $subtotal;
                $FoldingGateSparepartOrderDetail->save();
            }
            $FoldingGateSparepartOrder::where('id', $id)
                                    ->update([
                                        'grand_total' => $grand_total
                                    ]);
            flash('Data berhasil disimpan')->success();
            return redirect()->route('folding_gate_sparepart_order');
        } else {
            flash('Data gagal disimpan')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        $parent = FoldingGateSparepartOrder::getData($response['id']);
        $child = FoldingGateSparepartOrderDetail::getData($response['id']);
        $option = FoldingGateSparepart::getDataAll();
        if(empty($parent))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('folding_gate_sparepart_orders.edit', $data);
    }


    public function postEdit(Request $request) {
        $response = $request->all();
        $id = $response['id'];
        $details = $response['order'];
        $array_check = array();

        if(!is_numeric($response['phone']))
        {
            flash('Nomor telepon harus angka')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        foreach($details as $val)
        {
            if($val['folding_gate_sparepart_id'] == null)
            {
                continue;
            }
            if (in_array($val['folding_gate_sparepart_id'], $array_check)) {
                flash('Data ganda ditemukan. Silahkan coba lagi')->error();
                return redirect()->route('folding_gate_sparepart_order');
            }
            else
            {
                $array_check[] = $val['folding_gate_sparepart_id'];
            }
        }

        $FoldingGateSparepartOrder = new FoldingGateSparepartOrder();
        $save = $FoldingGateSparepartOrder::where('id', $id)
                                    ->update([
                                        'name' => $response['name'],
                                        'date' => date('Y-m-d', strtotime($response['date'])),
                                        'address'  => $response['address'],
                                        'phone_number'  => $response['phone']
                                    ]);
        
        if($save) 
        {
            FoldingGateSparepartOrderDetail::where('folding_gate_sparepart_order_id', $id)->delete();
            $grand_total=0;
            foreach($details as $detail)
            {
                if($detail['folding_gate_sparepart_id']==null)
                {
                    continue;
                }
                $price = $detail['price'];
                $qty = $detail['qty']==null? 0 : $detail['qty'];
                $size = $detail['size']==null? 0 : $detail['size'];

                $FoldingGateSparepartOrderDetail = new FoldingGateSparepartOrderDetail();
                $FoldingGateSparepartOrderDetail->folding_gate_sparepart_order_id = $id;
                $FoldingGateSparepartOrderDetail->folding_gate_sparepart_id = $detail['folding_gate_sparepart_id'];
                $FoldingGateSparepartOrderDetail->price = $price;
                $FoldingGateSparepartOrderDetail->qty = $qty;
                $FoldingGateSparepartOrderDetail->size = $size;
                $subtotal = $price * $qty * $size;
                $grand_total += $subtotal;
                $FoldingGateSparepartOrderDetail->save();
            }
            $FoldingGateSparepartOrder::where('id', $id)
                                    ->update([
                                        'grand_total' => $grand_total
                                    ]);
            flash('Data berhasil diupdate')->success();
            return redirect()->route('folding_gate_sparepart_order');
        } else {
            flash('Data gagal diupdate')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        $parent = FoldingGateSparepartOrder::getData($response['id']);
        $child = FoldingGateSparepartOrderDetail::getData($response['id']);
        $option = FoldingGateSparepart::getDataAll();
        if(empty($parent))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('folding_gate_sparepart_orders.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = FoldingGateSparepartOrder::where('id', $id)
                                    ->update([
                                        'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data berhasil dihapus')->success();
            return redirect()->route('folding_gate_sparepart_order');
        } else {
            flash('Data gagal dihapus')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }
    }

    public function getView(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        $parent = FoldingGateSparepartOrder::getData($response['id']);
        $child = FoldingGateSparepartOrderDetail::getData($response['id']);
        $option = FoldingGateSparepart::getDataAll();
        if(empty($parent))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart_order');
        }

        $data = [
                'parent' => $parent,
                'child' => $child,
                'option' => $option 
            ];

        return view('folding_gate_sparepart_orders.view', $data);
    }


    public function getDatatables()
    {
        return Datatables::of(FoldingGateSparepartOrder::getDataTable())->make(true);
    }

    public function getPrint(Request $request)
    {
        $response = $request->all();
        $id = $response['id'];
        $header = FoldingGateSparepartOrder::getData($id);
        $child = FoldingGateSparepartOrderDetail::getData($id);
        $header['order_number'] = 'PART-FG-'.$header['id'];
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
