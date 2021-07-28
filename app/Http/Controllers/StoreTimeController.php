<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Vendedor.Tienda.Horario.index');
    }

    public function showIndex()
    {
        $store=Store::where('user_id',Auth::user()->id)->first();
        $storeTime=StoreTime::where('store_id',$store->id)->get();

        $storeT=StoreTime::where('store_id',$store->id)->first();

        $fechai=Carbon::parse($storeT->time_start);

        $fechat=Carbon::parse($storeT->time_end);

        $ini=$fechai->toTimeString();

        $term=$fechat->toTimeString();

        return view('Vendedor.Tienda.Horario.index',compact("storeTime",'ini','term','storeT'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Vendedor.Tienda.Horario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//['time_start','time_end','status','day','store_id','id'];
        $store=Store::where('user_id',Auth::user()->id)->first();
        $di=$request->fechaInicio;
        $dt=$request->fechaTermino;
        $dayi=Carbon::createFromFormat('Y-m-d', $di)->format('j');
        $dayt=Carbon::createFromFormat('Y-m-d', $dt)->format('j');
        
        if($dayt>$dayi){
            for ($i=$dayi; $i <= $dayt; $i++) { 
                $datetime=new StoreTime();
                $dia=Carbon::createFromFormat('Y-m-d', $request->fechaInicio)->day($i)->format('l');
                switch ($dia) {
                    case "Monday":
                        $datetime->day="Lu";
                        break;
                    case "Tuesday":
                        $datetime->day="Ma";
                        break;
                    case "Wednesday":
                        $datetime->day="Mi";
                        break;
                    case "Thursday":
                        $datetime->day="Ju";
                        break;
                    case "Friday":
                        $datetime->day="Vi";
                        break;
                    case "Saturday":
                        $datetime->day="Sa";
                        break;
                    case "Sunday":
                        $datetime->day="Do";
                        break;
                }
                $timei=Carbon::createFromFormat('Y-m-d', $request->fechaInicio);
                $timet=Carbon::createFromFormat('Y-m-d', $request->fechaTermino);

                $horai=Carbon::createFromTimeString($request->horarioInicio);
                $horat=Carbon::createFromTimeString($request->horariotermino); 
                
                $datetime->time_start=Carbon::create($timei->year, $timei->month, $timei->day, $horai->hour, $horai->minute, $horai->second);
                $datetime->time_end=Carbon::create($timet->year, $timet->month, $timet->day, $horat->hour, $horat->minute, $horat->second);
                $datetime->name=$request->name;
                $datetime->status=1;
                $datetime->store_id=$store->id;
                $datetime->save();
            }
        }
        $storeTime=StoreTime::where('store_id',$store->id)->get();
        return redirect()->route('tienda.horario.show');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario=StoreTime::find($id);

        $fechai=Carbon::parse($horario->time_start);

        $fechat=Carbon::parse($horario->time_end);

        $ini=$fechai->toTimeString();

        $term=$fechat->toTimeString();
        return view('Vendedor.Tienda.Horario.update',compact('horario','ini','term'));
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
        $store=Store::where('user_id',Auth::user()->id)->first();
        $storeT=StoreTime::where('store_id',$store->id)->get();

        foreach($storeT as $storeTime){
            StoreTime::destroy($storeTime->id);
        }
        $di=$request->fechaInicio;
        $dt=$request->fechaTermino;
        $dayi=Carbon::createFromFormat('Y-m-d', $di)->format('j');
        $dayt=Carbon::createFromFormat('Y-m-d', $dt)->format('j');
        
        if($dayt>$dayi){
            for ($i=$dayi; $i <= $dayt; $i++) { 
                $datetime=new StoreTime();
                $dia=Carbon::createFromFormat('Y-m-d', $request->fechaInicio)->day($i)->format('l');
                switch ($dia) {
                    case "Monday":
                        $datetime->day="Lu";
                        break;
                    case "Tuesday":
                        $datetime->day="Ma";
                        break;
                    case "Wednesday":
                        $datetime->day="Mi";
                        break;
                    case "Thursday":
                        $datetime->day="Ju";
                        break;
                    case "Friday":
                        $datetime->day="Vi";
                        break;
                    case "Saturday":
                        $datetime->day="Sa";
                        break;
                    case "Sunday":
                        $datetime->day="Do";
                        break;
                }
                $timei=Carbon::createFromFormat('Y-m-d', $request->fechaInicio);
                $timet=Carbon::createFromFormat('Y-m-d', $request->fechaTermino);

                $horai=Carbon::createFromTimeString($request->horarioInicio);
                $horat=Carbon::createFromTimeString($request->horariotermino); 
                
                $datetime->time_start=Carbon::create($timei->year, $timei->month, $timei->day, $horai->hour, $horai->minute, $horai->second);
                $datetime->time_end=Carbon::create($timet->year, $timet->month, $timet->day, $horat->hour, $horat->minute, $horat->second);
                $datetime->name=$request->name;
                $datetime->status=1;
                $datetime->store_id=$store->id;
                $datetime->save();
            }
        }
        return redirect()->route('tienda.horario.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store=Store::where('user_id',Auth::user()->id)->first();
        $storeT=StoreTime::where('store_id',$store->id)->get();

        foreach($storeT as $storeTime){
            StoreTime::destroy($storeTime->id);
        }

        return redirect()->route('tienda.horario.index');
    }
}
