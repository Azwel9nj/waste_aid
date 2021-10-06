<?php

namespace App\Http\Controllers\Council;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FranchiseZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $franchise = Franchise::all();
        
    }

    private function getFranchisesWithOrWithouZone(){

        $franchises = DB::table('franchises')
            ->join('franchise_zones','franchiseId','=','franchises.id')
            ->join('zones','franchise_zones.zoneId','=','zones.id')
            ->select('franchises.name','franchises.active','franchises.phone','franchises.collection', DB::raw('(CASE WHEN COUNT(franchise_zones.zoneId) = 0 THEN NONE ELSE ASSIGNED )'))
            ->paginate(15);

        return $franchises;
    }

    private function getFranchisesWithZone($zone){
        $frans  = DB::table('sellers')
            ->join('franchise_zones','sellers.id','=','franchise_zones.fran_id')
            ->join('zones','franchise_zones.zone_id','=','zones.id')
            ->where('sellers.zone','=', $zone)
            ->select('sellers.*','zones.zone')
            ->paginate(10);            
        return $frans;
    }

    private function getFranchiseWithOutZone($nozone){
        $nofrans = DB::table('sellers')
            ->where('sellers.zone','=', $nozone)
            ->select('sellers.*')
            ->paginate(10);
        return $nofrans;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
