<?php

namespace App\Http\Controllers\Council;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        return Controller::zonesIndexPageLoader();
    }

    public function create()
    {
        return view('council.zones.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'            
        ]);       
        $zone= new Zone();
        $zone->zone = $request->input('name');        
        $zone->save();        
        return redirect('/council/councilDashboard')->with('success', 'Zone Created');        
    }
}
