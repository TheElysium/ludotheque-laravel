<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
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
        $user = User::find($id);
        return view('user.show',['user' => $user]);
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

    public function current()
    {
        if (Auth::check()) {
            return view('user.show', ["user" => Auth::user()]);
        }
        else
        {
            return redirect()->route('auth.login');
        }
    }


    public function jeux(){ // retourne la liste des jeux de l'utilisateur courant
        if (Auth::check()) {
            $jeux = Jeu::all()->pluck('user_id')->where('user_id','=',Auth::id());
            return view('user.jeux', ["user" => Auth::user(),'jeux'=> $jeux,'sort'=>null,'filter'=>null,'route'=>'user.jeux']);
        }
        else
        {
            return redirect()->route('auth.login');
        }
    }
}
