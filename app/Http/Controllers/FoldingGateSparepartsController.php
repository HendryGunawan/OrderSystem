<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\FoldingGateSparepart;
use App\Http\Models\Unit;

class FoldingGateSparepartsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('folding_gate_spareparts.index');
    }

    public function getAdd()
    {
        $option = Unit::getData();
        $data = [
                'option' => $option,
            ];
        return view('folding_gate_spareparts.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();
        if(!is_numeric($response['price']))
        {
            flash('Harga harus angka')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        $check_data = FoldingGateSparepart::where('name', trim($response['name']))->first();

        if($check_data) {
            flash('Data sudah ada dalam daftar. Silahkan coba lagi dengan data lainnya')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        $FoldingGateSparepart = new FoldingGateSparepart();
        $FoldingGateSparepart->name = trim($response['name']);
        $FoldingGateSparepart->unit_id = $response['unit_id'];
        $FoldingGateSparepart->price = $response['price'];
        $FoldingGateSparepart->delete_flag = 0;
        
        if($FoldingGateSparepart->save()) {
            flash('Data berhasil disimpan')->success();
            return redirect()->route('folding_gate_sparepart');
        } else {
            flash('Data gagal disimpan')->error();
            return redirect()->route('folding_gate_sparepart');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        $content = FoldingGateSparepart::getData($response['id']);
        if(empty($content))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        $option = Unit::getData();
        $data = [
                'option' => $option,
                'content' => $content
            ];
        return view('folding_gate_spareparts.edit', $data);
    }


    public function postEdit(Request $request) {
        $respons = $request->all();
        $id = $respons['id'];
        $name = trim($respons['name']);
        $unit_id = $respons['unit_id'];
        $price = $respons['price'];

        if(!is_numeric($price))
        {
            flash('Harga harus angka')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        $check_data = FoldingGateSparepart::where('name', $name)->where('id', '!=', $id)->first();

        if($check_data) {
            flash('Data sudah ada dalam daftar. Silahkan coba lagi dengan data lainnya')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        $FoldingGateSparepart = new FoldingGateSparepart();
        $save = $FoldingGateSparepart::where('id', $id)
                                    ->update([
                                        'name' => $name,
                                        'unit_id' => $unit_id,
                                        'price'  => $price,
                                    ]);

        if($save) {
            flash('Data berhasil diupdate')->success();
            return redirect()->route('folding_gate_sparepart');
        } else {
            flash('Data gagal diupdate')->error();
            return redirect()->route('folding_gate_sparepart');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        $data = FoldingGateSparepart::getData($response['id']);
        if(empty($data))
        {
            flash('Data tidak ditemukan')->error();
            return redirect()->route('folding_gate_sparepart');
        }

        return view('folding_gate_spareparts.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = FoldingGateSparepart::where('id', $id)
                                    ->update([
                                        'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data berhasil dihapus')->success();
            return redirect()->route('folding_gate_sparepart');
        } else {
            flash('Data gagal dihapus')->error();
            return redirect()->route('folding_gate_sparepart');
        }
    }

    public function getDatatables()
    {
        return Datatables::of(FoldingGateSparepart::getDataTable())->make(true);
    }

    public function getPrices(Request $request)
    {
        $respons = $request->all();
        $query = FoldingGateSparepart::where('folding_gate_spareparts.id', $respons['id'])
                                     ->join('units', 'folding_gate_spareparts.unit_id', '=', 'units.id')
                                     ->select('folding_gate_spareparts.price', 'units.name')
                                     ->first();
        if($query)
        {
            echo json_encode(array('value' => $query['price'], 'units'=>$query['name']));
            exit();
        }
        else
        {
            echo json_encode(array('value' => 0, 'units'=>'-'));
            exit();
        }
    }
}
