<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\Activite;
use App\Models\Etat;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('q')){
            if (request('q') !== '') {
                $activites = Activite::where('name', 'like', '%'.request('q').'%')->orderBy('created_at', 'desc')->get();
                return response()->json($activites);
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
        /*
            $etats = Etat::all();
            $activite = new Activite;
            dd($etats);
            foreach ($etats as $etat) {
                if ($etat == 'Ouvert') {
                    $activite->name = $request->name;
                    $activite->description = $request->description;
                    $activite->etat_id = $etat->id;
                    $activite->save();
                }
            }
        */

        $activite = Activite::create($request->all());
        if ($activite) {
            return $this->refresh();
        }
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
        $activite = Activite::find($id);
        $activite->name = request('name');
        $activite->description = request('description');
        $activite->save();

        if($activite){
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
        $activite = Activite::find($id);
        if ($activite->delete()) {
            return $this->refresh();
        } else {
            return response()->json(['error' => 'Erreur lors de la suppression!'], 425);
        }
        
    }

    protected function refresh()
    {
        $activites = Activite::orderBy('created_at', 'desc')->get();
        return response()->json($activites);
    }
}
