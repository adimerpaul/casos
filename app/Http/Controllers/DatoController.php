<?php

namespace App\Http\Controllers;

use App\Dato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $dato=new Dato();

        $dato->nombre=strtoupper($request->nombre);
        $dato->parentesco=$request->parentesco;
        $dato->celular=$request->celular;
        $dato->fecha=$request->fecha;
        $dato->fiebre=isset( $request->fiebre)?$request->fiebre:'';
        $dato->tos=isset( $request->tos)?$request->tos:'';
        $dato->fatiga=isset( $request->fatiga)?$request->fatiga:'';
        $dato->congestion=isset( $request->congestion)?$request->congestion:'';
        $dato->muscular=isset( $request->muscular)?$request->muscular:'';
        $dato->garganta=isset( $request->garganta)?$request->garganta:'';
        $dato->cafe=isset( $request->cafe)?$request->cafe:'';
        $dato->nauseas=isset( $request->nauseas)?$request->nauseas:'';
        $dato->diarrea=isset( $request->diarrea)?$request->diarrea:'';
        $dato->escalofrios=isset( $request->escalofrios)?$request->escalofrios:'';
        $dato->respiratoria=isset( $request->respiratoria)?$request->respiratoria:'';
        $dato->otros=isset( $request->otros)?$request->otros:'';

        $dato->a=isset( $request->a)?$request->a:'';
        $dato->b=isset( $request->b)?$request->b:'';
        $dato->c=isset( $request->c)?$request->c:'';
        $dato->enfermedad=isset( $request->enfermedad)?$request->enfermedad:'';
        $dato->embarazo=isset( $request->embarazo)?$request->embarazo:'';
        $dato->inmunodepresion=isset( $request->inmunodepresion)?$request->inmunodepresion:'';
        $dato->dano=isset( $request->dano)?$request->dano:'';

        $dato->insuficiencia=isset( $request->insuficiencia)?$request->insuficiencia:'';
        $dato->otros2=isset( $request->otros2)?$request->otros2:'';
        $dato->caso=isset( $request->caso)?$request->caso:'';
        $dato->casono=isset( $request->casono)?$request->casono:'';
        $dato->observaciones=isset( $request->observaciones)?$request->observaciones:'';
        $dato->caso_id=isset( $request->caso_id)?$request->caso_id:'';
        $dato->save();
        return $dato;
        exit;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('datos')->where('caso_id',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function edit(Dato $dato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dato $dato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato=Dato::find($id);
        $dato->delete();
        echo 1;
    }
}
