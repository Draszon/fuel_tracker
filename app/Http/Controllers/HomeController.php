<?php

namespace App\Http\Controllers;

use App\Models\Datas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $fuel = Datas::orderBy('date', 'desc')->get();

        return view('welcome', compact('fuel'));
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'date' => 'required|date',
            'quantity' => 'required|numeric',
            'km' => 'required|numeric|min:0',
            'money' => 'required|integer|min:0',
            'location' => 'required|string'
        ]);

        $consumption = ($request->quantity / $request->km) * 100;
        $validate['consumption'] = $consumption;

        $fuel = new Datas();
        $fuel->create($validate);

        return back()->with('success', 'Sikeres feltöltés');
    }

    public function editFuel(Request $request, $id) {
        $validate = $request->validate([
            'date' => 'required|date',
            'quantity' => 'required|numeric',
            'km' => 'required|numeric|min:0',
            'money' => 'required|integer|min:0',
            'location' => 'required|string'
        ]);

        $consumotion = ($request->consumption / $request->km) * 100;
        $validate['consumption'] = $consumotion;

        $fuel = Datas::findOrFail($id);
    }
}