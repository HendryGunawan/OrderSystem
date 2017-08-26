<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\Item;
use App\Http\Models\GoodReceiptRollingDoor;

class GoodReceiptRollingDoorsController extends Controller
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
        
        return view('good_receipt_rolling_doors.index');
    }

    public function getAdd()
    {
        $option = Item::getData();
        $data = [
                'option' => $option,
            ];
        return view('good_receipt_rolling_doors.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $Item = Item::getDataById($response['item_id']);
        $GoodReceiptRollingDoor = new GoodReceiptRollingDoor();
        $GoodReceiptRollingDoor->item_id = $response['item_id'];
        $GoodReceiptRollingDoor->thick = rtrim(rtrim(number_format($response['thick'], 10, ".", ""), '0'), '.');
        $GoodReceiptRollingDoor->width = rtrim(rtrim(number_format($response['width'], 10, ".", ""), '0'), '.');
        $GoodReceiptRollingDoor->weight = rtrim(rtrim(number_format($response['weight'], 10, ".", ""), '0'), '.');
        $GoodReceiptRollingDoor->length = $response['thick'] * $response['width'] * $response['weight'] * 7.85 / 1000000;
        $GoodReceiptRollingDoor->item_code = strtoupper($Item['name']).'-'.rtrim(rtrim(number_format($response['thick'], 10, "", ""), '0'), '.').'-'.rtrim(rtrim(number_format($response['width'], 10, "", ""), '0'), '.');
        $GoodReceiptRollingDoor->delete_flag = 0;
        
        if($GoodReceiptRollingDoor->save()) {
            flash('Data succefully saved')->success();
            return redirect()->route('good_receipt_rolling_door');
        } else {
            flash('Data failed to save')->error();
            return redirect()->route('good_receipt_rolling_door');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_receipt_rolling_door');
        }

        $content = GoodReceiptRollingDoor::getData($response['id']);
        if(empty($content))
        {
            flash('Data not found')->error();
            return redirect()->route('good_receipt_rolling_door');
        }

        $option = Item::getData();
        $data = [
                'option' => $option,
                'content' => $content
            ];
        return view('good_receipt_rolling_doors.edit', $data);
    }


    public function postEdit(Request $request) {
        $respons = $request->all();
        $id = $respons['id'];
        $item_id = $respons['item_id'];
        $thick = $respons['thick'];
        $width = $respons['width'];
        $weight = $respons['weight'];

        $Item = Item::getDataById($item_id);

        $GoodReceiptRollingDoor = new GoodReceiptRollingDoor();
        $save = $GoodReceiptRollingDoor::where('id', $id)
                                       ->update([
                                            'item_id' => $item_id,
                                            'thick' => rtrim(rtrim(number_format($thick, 10, ".", ""), '0'), '.'),
                                            'width' => rtrim(rtrim(number_format($width, 10, ".", ""), '0'), '.'),
                                            'weight' => rtrim(rtrim(number_format($weight, 10, ".", ""), '0'), '.'),
                                            'length' => $thick * $width * $weight * 7.85 /1000000,
                                            'item_code' => strtoupper($Item['name']).'-'.rtrim(rtrim(number_format($thick, 10, "", ""), '0'), '.').'-'.rtrim(rtrim(number_format($width, 10, "", ""), '0'), '.')
                                        ]);

        if($save) {
            flash('Data succefully updated')->success();
            return redirect()->route('good_receipt_rolling_door');
        } else {
            flash('Data failed to updated')->error();
            return redirect()->route('good_receipt_rolling_door');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('good_receipt_rolling_door');
        }

        $data = GoodReceiptRollingDoor::getData($response['id']);
        if(empty($data))
        {
            flash('Data not found')->error();
            return redirect()->route('good_receipt_rolling_door');
        }

        return view('good_receipt_rolling_doors.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = GoodReceiptRollingDoor::where('id', $id)
                                      ->update([
                                          'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data succefully deleted')->success();
            return redirect()->route('good_receipt_rolling_door');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('good_receipt_rolling_door');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(GoodReceiptRollingDoor::getDataTable())->make(true);
    }
}
