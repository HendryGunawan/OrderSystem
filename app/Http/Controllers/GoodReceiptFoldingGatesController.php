<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\Item;
use App\Http\Models\GoodReceiptFoldingGate;

class GoodReceiptFoldingGatesController extends Controller
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
        
        return view('good_receipt_folding_gates.index');
    }

    public function getAdd()
    {
        $option = Item::getData();
        $data = [
                'option' => $option,
            ];
        return view('good_receipt_folding_gates.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        $Item = Item::getDataById($response['item_id']);
        $GoodReceiptFoldingGate = new GoodReceiptFoldingGate();
        $GoodReceiptFoldingGate->item_id = $response['item_id'];
        $GoodReceiptFoldingGate->thick = rtrim(rtrim(number_format($response['thick'], 10, ".", ""), '0'), '.');
        $GoodReceiptFoldingGate->width = rtrim(rtrim(number_format($response['width'], 10, ".", ""), '0'), '.');
        $GoodReceiptFoldingGate->weight = rtrim(rtrim(number_format($response['weight'], 10, ".", ""), '0'), '.');
        $GoodReceiptFoldingGate->length = $response['thick'] * $response['width'] * $response['weight'] * 7.85 / 1000000;
        $GoodReceiptFoldingGate->item_code = strtoupper($Item['name']).'-'.rtrim(rtrim(number_format($response['thick'], 10, "", ""), '0'), '.').'-'.rtrim(rtrim(number_format($response['width'], 10, "", ""), '0'), '.');
        $GoodReceiptFoldingGate->delete_flag = 0;
        
        if($GoodReceiptFoldingGate->save()) {
            flash('Data berhasil disimpan')->success();
            return redirect()->route('good_receipt_folding_gate');
        } else {
            flash('Data gagal disimpan')->error();
            return redirect()->route('good_receipt_folding_gate');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('good_receipt_folding_gate');
        }

        $content = GoodReceiptFoldingGate::getData($response['id']);
        if(empty($content))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('good_receipt_folding_gate');
        }

        $option = Item::getData();
        $data = [
                'option' => $option,
                'content' => $content
            ];
        return view('good_receipt_folding_gates.edit', $data);
    }


    public function postEdit(Request $request) {
        $respons = $request->all();
        $id = $respons['id'];
        $item_id = $respons['item_id'];
        $thick = $respons['thick'];
        $width = $respons['width'];
        $weight = $respons['weight'];

        $Item = Item::getDataById($item_id);

        $GoodReceiptFoldingGate = new GoodReceiptFoldingGate();
        $save = $GoodReceiptFoldingGate::where('id', $id)
                                       ->update([
                                            'item_id' => $item_id,
                                            'thick' => rtrim(rtrim(number_format($thick, 10, ".", ""), '0'), '.'),
                                            'width' => rtrim(rtrim(number_format($width, 10, ".", ""), '0'), '.'),
                                            'weight' => rtrim(rtrim(number_format($weight, 10, ".", ""), '0'), '.'),
                                            'length' => $thick * $width * $weight * 7.85 /1000000,
                                            'item_code' => strtoupper($Item['name']).'-'.rtrim(rtrim(number_format($thick, 10, "", ""), '0'), '.').'-'.rtrim(rtrim(number_format($width, 10, "", ""), '0'), '.')
                                        ]);

        if($save) {
            flash('Data berhasil diupdate')->success();
            return redirect()->route('good_receipt_folding_gate');
        } else {
            flash('Data gagal diupdate')->error();
            return redirect()->route('good_receipt_folding_gate');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('good_receipt_folding_gate');
        }

        $data = GoodReceiptFoldingGate::getData($response['id']);
        if(empty($data))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('good_receipt_folding_gate');
        }

        return view('good_receipt_folding_gates.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = GoodReceiptFoldingGate::where('id', $id)
                                      ->update([
                                          'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data berhasil dihapus')->success();
            return redirect()->route('good_receipt_folding_gate');
        } else {
            flash('Data gagal dihapus')->error();
            return redirect()->route('good_receipt_folding_gate');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(GoodReceiptFoldingGate::getDataTable())->make(true);
    }

}
