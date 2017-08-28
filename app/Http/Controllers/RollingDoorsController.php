<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use App\Http\Models\RollingDoor;
use App\Http\Models\Unit;

class RollingDoorsController extends Controller
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
        
        return view('rolling_doors.index');
    }

    public function getAdd()
    {
        $option = Unit::getData();
        $data = [
                'option' => $option,
            ];
        return view('rolling_doors.add', $data);
    }

    public function postAdd(Request $request)
    {
        $response = $request->all();

        if(!is_numeric($response['price']))
        {
            flash('Price must be numbers only')->error();
            return redirect()->route('rolling_door');
        }

        $check_data = RollingDoor::where('name', trim($response['name']))->first();

        if($check_data) {
            flash('Data already in the list. Please insert another item')->error();
            return redirect()->route('rolling_door');
        }

        $RollingDoor = new RollingDoor();
        $RollingDoor->name = $response['name'];
        $RollingDoor->unit_id = $response['unit_id'];
        $RollingDoor->price = $response['price'];
        $RollingDoor->delete_flag = 0;
        
        if($RollingDoor->save()) {
            flash('Data succefully saved')->success();
            return redirect()->route('rolling_door');
        } else {
            flash('Data failed to save')->error();
            return redirect()->route('rolling_door');
        }
    }

    public function getEdit(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door');
        }

        $content = RollingDoor::getData($response['id']);
        if(empty($content))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door');
        }

        $option = Unit::getData();
        $data = [
                'option' => $option,
                'content' => $content
            ];
        return view('rolling_doors.edit', $data);
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
            return redirect()->route('rolling_door');
        }

        $check_data = RollingDoor::where('name', $name)->where('id', '!=', $id)->first();

        if($check_data) {
            flash('Data already in the list. Please insert another item')->error();
            return redirect()->route('rolling_door');
        }

        $RollingDoor = new RollingDoor();
        $save = $RollingDoor::where('id', $id)
                                    ->update([
                                        'name' => $name,
                                        'unit_id' => $unit_id,
                                        'price'  => $price,
                                    ]);

        if($save) {
            flash('Data succefully updated')->success();
            return redirect()->route('rolling_door');
        } else {
            flash('Data failed to updated')->error();
            return redirect()->route('rolling_door');
        }
    }

    public function getDelete(Request $request)
    {
        $response = $request->all();
        if(!isset($response['id']))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door');
        }

        $data = RollingDoor::getData($response['id']);
        if(empty($data))
        {
            flash('Data not found')->error();
            return redirect()->route('rolling_door');
        }

        return view('rolling_doors.delete', $data);
    }

    public function postDelete(Request $request)
    {
        $respons = $request->all();
        $id = $respons['id'];

        $save = RollingDoor::where('id', $id)
                                    ->update([
                                        'delete_flag' => 1
                                    ]);

        if($save) {
            flash('Data succefully deleted')->success();
            return redirect()->route('rolling_door');
        } else {
            flash('Data failed to deleted')->error();
            return redirect()->route('rolling_door');
        }
    }


    public function getDatatables()
    {
        return Datatables::of(RollingDoor::getDataTable())->make(true);
    }

    public function getPrices(Request $request)
    {
        $respons = $request->all();
        $query =  RollingDoor::where('rolling_doors.id', $respons['id'])
                             ->join('units', 'rolling_doors.unit_id', '=', 'units.id')
                             ->select('rolling_doors.price', 'units.name')
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
