<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Etat;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if(request('crit')){
            if (request('crit') !== '') {
                $activite = Activite::find(request('q'));
                $taches = Tache::where('name', 'like', '%'.request('crit').'%')->orderBy('created_at', 'desc')->get();
                return response()->json(['taches'=>$taches, 'activite'=>$activite]);
            } else {
                return $this->refresh();
            }
        }else{
            return $this->refresh();
    }
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
        $tache = new Tache;
        $tache->name = request('name');
        $tache->description = request('description');
        $tache->activite_id = request('q');
        $tache->etat_id = 1;
        $tache->save();
        
        $activ_id = (int)request('activite_id');
        $this->etatArrangement($activ_id);
        return $this->refresh();
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
    public function update($id)
    {
        $tache = Tache::find($id);
        $tache->name = request('name');
        $tache->description = request('description');
        $tache->etat_id = request('etat_id');
        $tache->save();

        $activ_id = (int)request('activite_id');
        $this->etatArrangement($activ_id);
        if($tache){
            return $this->refresh();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tache = Tache::find($id);
        $activ_id = $tache->activite_id;
        if ($tache->delete()) {
            $this->etatArrangement($activ_id);
            return $this->refresh();
        } else {
            return response()->json(['error' => 'Erreur lors de la suppression!'], 425);
        }
    }

    protected function refresh(){
        $activite = Activite::find(request('q'));
        $taches = Tache::orderBy('created_at', 'DESC')->where('activite_id', request('q'))->get();
        return response()->json(['taches'=>$taches, 'activite'=>$activite]);
    }

    protected function etatArrangement($activ_id){
        $etat = 1;
        $terminer = true;
        $activite = Activite::with('taches')->find($activ_id);
        foreach ($activite->taches as $task) {
            $etat *= $task->etat_id;
            if ($task->etat_id == 1) {
                $terminer = false;
            }
        }
        if ($etat == 1) {
            $activite->etat_id = 1;
        } else {
            if ($etat%2 == 0) {
                $activite->etat_id = 2;
            } else {
                if (!$terminer) {
                    $activite->etat_id = 2;
                } else {
                    $activite->etat_id = 3;
                }  
            }
        } 
        $activite->save();
    }

    public function dashRecupere(){
      //mbola tsis  
    }
}
