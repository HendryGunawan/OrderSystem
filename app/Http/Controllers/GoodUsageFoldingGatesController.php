<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\Item;
use App\Http\Models\FoldingGateOrder;
use App\Http\Models\FoldingGateOrderDetail;
use App\Http\Models\GoodReceiptFoldingGate;
use App\Http\Models\GoodUsageFoldingGate;
use App\Http\Models\GoodUsageFoldingGateDetail;

use PDF;

class GoodUsageFoldingGatesController extends Controller
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
        
        return view('good_usage_folding_gates.index');
    }

    public function getSelectOrderNumber()
    {
        $usage = GoodUsageFoldingGate::getDataUsage();
        $folding_gate_order_id = array();
        $id = array();
        if($usage->count())
        {
            foreach($usage as $value)
            {
                $id[] = $value['folding_gate_order_id'];
            }
        }
        $option = FoldingGateOrder::getOptionUsage($id);
        if($option->count())
        {
            foreach($option as $key => $value1)
            {
                $option[$key]['order_number'] = 'FG-'.$option[$key]['id'];
            }
        }
        $data = [
                'option' => $option,
            ];
        return view('good_usage_folding_gates.select_order_number', $data);
    }

    public function getAdd(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_folding_gate');
        }

        $check_already_registered = GoodUsageFoldingGate::where('folding_gate_order_id',$response['id'])
                                                        ->where('delete_flag',0)
                                                        ->first();

        if(!empty($check_already_registered))
        {
            flash('Order Already Registered in the list')->error();
            return redirect()->route('good_usage_folding_gate');
        }

        $content = FoldingGateOrderDetail::getData($response['id']);
        $ItemCode = GoodReceiptFoldingGate::where('delete_flag', 0)->select('item_code')->distinct()->get();
        if(empty($content))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_folding_gate');
        }

        $data = [
                'id'=> $response['id'],
                'content' => $content,
                'option' => $ItemCode
            ];
        return view('good_usage_folding_gates.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $array_check = array();
        foreach($response['detail'] as $val)
        {
            if (in_array($val['item_code'], $array_check)) {
                flash('Duplicate data found. Please try again')->error();
                return redirect()->route('good_usage_folding_gate');
            }
            else
            {
                $array_check[] = $val['item_code'];
            }
        }

        
        $GoodUsageFoldingGate = new GoodUsageFoldingGate();
        $GoodUsageFoldingGate->folding_gate_order_id = $response['folding_gate_order_id'];
        $GoodUsageFoldingGate->delete_flag = 0;
        if($GoodUsageFoldingGate->save())
        {
            $id = $GoodUsageFoldingGate->id;
            foreach($response['detail'] as $value)
            {
                $GoodUsageFoldingGateDetail = new GoodUsageFoldingGateDetail();
                $GoodUsageFoldingGateDetail->good_usage_folding_gate_id = $id;
                $GoodUsageFoldingGateDetail->item_code = $value['item_code'];
                $GoodUsageFoldingGateDetail->length = $value['length'];
                $GoodUsageFoldingGateDetail->save();
            }
            flash('Data succefully saved')->success();
            return redirect()->route('good_usage_folding_gate');
        }
        else {
            flash('Data failed to save')->error();
            return redirect()->route('good_usage_folding_gate');
        }
    }

    public function getView(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_folding_gate');
        }

        $header = GoodUsageFoldingGate::getData($response['id']);
        if(empty($header))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_folding_gate');
        }
        $child = GoodUsageFoldingGateDetail::getData($response['id']);
        $content = FoldingGateOrderDetail::getData($header['folding_gate_order_id']);

        foreach($child as $key=>$value)
        {
            $child[$key]['quota'] = GoodReceiptFoldingGate::getQuota($value['item_code']) + $value['length'];
        }

        $data = [
            'header' => $header,
            'content' => $content,
            'child' => $child,
                ];

        return view('good_usage_folding_gates.view', $data);
    }


    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_folding_gate');
        }

        $header = GoodUsageFoldingGate::getData($response['id']);
        $child = GoodUsageFoldingGateDetail::getData($response['id']);
        if(empty($header))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_folding_gate');
        }
        $data = [
            'header' => $header,
            'child' => $child
                ];
        return view('good_usage_folding_gates.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = GoodUsageFoldingGate::where('id', $id)
                                      ->update([
                                          'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data succefully deleted')->success();
            return redirect()->route('good_usage_folding_gate');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('good_usage_folding_gate');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(GoodUsageFoldingGate::getDataTable())->make(true);
    }

    public static function getQuota(Request $request){
        $response = $request->all();
        $item_code = strtoupper($response['id']);
        $value = GoodReceiptFoldingGate::GetQuota($item_code);
        return $value;
    }


    public function getPrint(Request $request)
    {
        $response = $request->all();
        $id = $response['id'];

        $data = GoodUsageFoldingGate::getData($id);
        $folding_gate_order_id = $data['folding_gate_order_id'];

        $header = FoldingGateOrder::getData($folding_gate_order_id);
        $child = FoldingGateOrderDetail::getData($folding_gate_order_id);

        $header['order_number'] = 'FG-'.$header['id'];
        $header['date'] = date('d-m-Y', strtotime($header['date']));
        $header['grand_total'] = number_format($header['grand_total']);

        $usage = GoodUsageFoldingGateDetail::getData($id);

        $data = [
            'header' => $header,
            'child' => $child,
            'usage' => $usage
        ];
        $pdf = PDF::loadView('pdf.usage_report', $data);
        return $pdf->stream('USAGE REPORT.pdf');
    }
}
