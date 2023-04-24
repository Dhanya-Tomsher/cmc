<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VetSchedule;

class VetScheduleController extends Controller
{
public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = VetSchedule::whereDate('available_from', '>=', $request->start)
                       ->whereDate('available_to',   '<=', $request->end)
                       ->get(['id', 'available_from', 'available_to']);
            return response()->json($data);
    	}
    	return view('full-calender');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{dd($request->start);
    			$event = VetSchedule::create([
    				'title'		=>	$request->title,
    				'available_from'		=>	$request->start,
    				'available_to'		    =>	$request->end,
                    'vet_id'                =>'1',
    			]);
                $event->save();
    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = VetSchedule::find($request->id)->update([
    				'title'		=>	$request->title,
    				'available_from'		=>	$request->start,
    				'available_to'		    =>	$request->end,
                    'vet_id'                =>1,
    			]);
                $event->save();
    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = VetSchedule::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}