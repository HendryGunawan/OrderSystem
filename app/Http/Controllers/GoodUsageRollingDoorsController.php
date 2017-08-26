<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\Item;
use App\Http\Models\RollingDoorOrder;
use App\Http\Models\RollingDoorOrderDetail;
use App\Http\Models\GoodReceiptRollingDOor;
use App\Http\Models\GoodUsageRollingDoor;
use App\Http\Models\GoodUsageRollingDoorDetail;


use PDF;
use Auth;

class GoodUsageRollingDoorsController extends Controller
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
        return view('good_usage_rolling_doors.index');
    }

    public function getSelectOrderNumber()
    {
        $usage = GoodUsageRollingDoor::getDataUsage();
        $rolling_door_order_id = array();
        $id = array();
        if($usage->count())
        {
            foreach($usage as $value)
            {
                $id[] = $value['rolling_door_order_id'];
            }
        }
        $option = RollingDoorOrder::getOptionUsage($id);
        if($option->count())
        {
            foreach($option as $key => $value1)
            {
                $option[$key]['order_number'] = 'RD-'.$option[$key]['id'];
            }
        }
        $data = [
                'option' => $option,
            ];
        return view('good_usage_rolling_doors.select_order_number', $data);
    }

    public function getAdd(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_rolling_door');
        }

        $check_already_registered = GoodUsageRollingDoor::where('rolling_door_order_id',$response['id'])
                                                        ->where('delete_flag',0)
                                                        ->first();

        if(!empty($check_already_registered))
        {
            flash('Order Already Registered in the list')->error();
            return redirect()->route('good_usage_rolling_door');
        }

        $content = RollingDoorOrderDetail::getData($response['id']);
        $ItemCode = GoodReceiptRollingDoor::where('delete_flag', 0)->select('item_code')->distinct()->get();
        if(empty($content))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_rolling_door');
        }

        $data = [
                'id'=> $response['id'],
                'content' => $content,
                'option' => $ItemCode
            ];
        return view('good_usage_rolling_doors.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $array_check = array();
        foreach($response['detail'] as $val)
        {
            if (in_array($val['item_code'], $array_check)) {
                flash('Duplicate data found. Please try again')->error();
                return redirect()->route('good_usage_rolling_door');
            }
            else
            {
                $array_check[] = $val['item_code'];
            }
        }

        
        $GoodUsageRollingDoor = new GoodUsageRollingDoor();
        $GoodUsageRollingDoor->rolling_door_order_id = $response['rolling_door_order_id'];
        $GoodUsageRollingDoor->delete_flag = 0;
        if($GoodUsageRollingDoor->save())
        {
            $id = $GoodUsageRollingDoor->id;
            foreach($response['detail'] as $value)
            {
                $GoodUsageRollingDoorDetail = new GoodUsageRollingDoorDetail();
                $GoodUsageRollingDoorDetail->good_usage_rolling_door_id = $id;
                $GoodUsageRollingDoorDetail->item_code = $value['item_code'];
                $GoodUsageRollingDoorDetail->length = $value['length'];
                $GoodUsageRollingDoorDetail->save();
            }
            flash('Data succefully saved')->success();
            return redirect()->route('good_usage_rolling_door');
        }
        else {
            flash('Data failed to save')->error();
            return redirect()->route('good_usage_rolling_door');
        }
    }

    public function getView(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_rolling_door');
        }

        $header = GoodUsageRollingDoor::getData($response['id']);
        if(empty($header))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_rolling_door');
        }
        $child = GoodUsageRollingDoorDetail::getData($response['id']);
        $content = RollingDoorOrderDetail::getData($header['rolling_door_order_id']);

        $data = [
            'header' => $header,
            'content' => $content,
            'child' => $child,
                ];

        return view('good_usage_rolling_doors.view', $data);
    }


    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_rolling_door');
        }

        $header = GoodUsageRollingDoor::getData($response['id']);
        $child = GoodUsageRollingDoorDetail::getData($response['id']);
        if(empty($header))
        {
            flash('Data not found')->error();
            return redirect()->route('good_usage_rolling_door');
        }
        $data = [
            'header' => $header,
            'child' => $child
                ];
        return view('good_usage_rolling_doors.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = GoodUsageRollingDoor::where('id', $id)
                                      ->update([
                                          'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data succefully deleted')->success();
            return redirect()->route('good_usage_rolling_door');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('good_usage_rolling_door');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(GoodUsageRollingDoor::getDataTable())->make(true);
    }

    public static function getQuota(Request $request){
        $response = $request->all();
        $item_code = strtoupper($response['id']);
        $value = GoodReceiptRollingDoor::GetQuota($item_code);
        return $value;
    }

    public function getPrint(Request $request)
    {
        $response = $request->all();
        $id = $response['id'];

        $data = GoodUsageRollingDoor::getData($id);
        $rolling_door_order_id = $data['rolling_door_order_id'];

        $header = RollingDoorOrder::getData($rolling_door_order_id);
        $child = RollingDoorOrderDetail::getData($rolling_door_order_id);

        $header['order_number'] = 'RD-'.$header['id'];
        $header['date'] = date('d-m-Y', strtotime($header['date']));
        $header['grand_total'] = number_format($header['grand_total']);

        $usage = GoodUsageRollingDoorDetail::getData($id);

        $data = [
            'header' => $header,
            'child' => $child,
            'usage' => $usage
        ];
        $pdf = PDF::loadView('pdf.usage_report', $data);
        return $pdf->stream('USAGE REPORT.pdf');
    }
}
