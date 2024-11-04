<?php

namespace App\Http\Controllers;

use App\Jobs\MoneySentJob;
use Illuminate\Http\Request;

class MoneySentController extends Controller
{
    public function create(){
        return view('money.create');
    }

    public function store(Request $request){
        dispatch(new MoneySentJob($request->money));
        return redirect()->back();
    }
}
