<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function create()
    {
        return view('builder');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'definition' => 'required|json'
        ]);

        return view('form')->with([
            'definition' => $data['definition'],
            'data' => '{}'
        ]);
    }
}
