<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\RollingDoorSparepart;
use App\Http\Models\Unit;

class RollingDoorSparepartsController extends Controller
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
        
        return view('rolling_door_spareparts.index');
    }

    public function getAdd()
    {
        $option = Unit::getData();
        $data = [
                'option' => $option,
            ];
        return view('rolling_door_spareparts.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();

        if(!is_numeric($response['price']))
        {
            flash('Price must be numbers only')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        $check_data = RollingDoorSparepart::where('name', trim($response['name']))->first();

        if($check_data) {
            flash('Data already in the list. Please insert another item')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        $RollingDoorSparepart = new RollingDoorSparepart();
        $RollingDoorSparepart->name = trim($response['name']);
        $RollingDoorSparepart->unit_id = $response['unit_id'];
        $RollingDoorSparepart->price = $response['price'];
        $RollingDoorSparepart->delete_flag = 0;
        
        if($RollingDoorSparepart->save()) {
            flash('Data succefully saved')->success();
            return redirect()->route('rolling_door_sparepart');
        } else {
            flash('Data failed to save')->error();
            return redirect()->route('rolling_door_sparepart');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        $content = RollingDoorSparepart::getData($response['id']);
        if(empty($content))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        $option = Unit::getData();
        $data = [
                'option' => $option,
                'content' => $content
            ];
        return view('rolling_door_spareparts.edit', $data);
    }


    public function postEdit(Request $request) {
        $respons = $request->all();
        $id = $respons['id'];
        $name = trim($respons['name']);
        $unit_id = $respons['unit_id'];
        $price = $respons['price'];

        if(!is_numeric($price))
        {
            flash('Price must be numbers only')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        $check_data = RollingDoorSparepart::where('name', $name)->where('id', '!=', $id)->first();

        if($check_data) {
            flash('Data already in the list. Please insert another item')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        $RollingDoorSparepart = new RollingDoorSparepart();
        $save = $RollingDoorSparepart::where('id', $id)
                                    ->update([
                                        'name' => $name,
                                        'unit_id' => $unit_id,
                                        'price'  => $price,
                                    ]);

        if($save) {
            flash('Data succefully updated')->success();
            return redirect()->route('rolling_door_sparepart');
        } else {
            flash('Data failed to updated')->error();
            return redirect()->route('rolling_door_sparepart');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        $data = RollingDoorSparepart::getData($response['id']);
        if(empty($data))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door_sparepart');
        }

        return view('rolling_door_spareparts.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = RollingDoorSparepart::where('id', $id)
                                    ->update([
                                        'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data succefully deleted')->success();
            return redirect()->route('rolling_door_sparepart');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('rolling_door_sparepart');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(RollingDoorSparepart::getDataTable())->make(true);
    }

    public function getPrices(Request $request)
    {
        $respons = $request->all();
        $query = RollingDoorSparepart::where('rolling_door_spareparts.id', $respons['id'])
                                     ->join('units', 'rolling_door_spareparts.unit_id', '=', 'units.id')
                                     ->select('rolling_door_spareparts.price', 'units.name')
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
