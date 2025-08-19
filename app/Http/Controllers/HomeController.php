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

    public function editLoad($id) {
        $edit = Datas::findOrFail($id);
        $fuel = Datas::orderBy('date', 'desc')->get();

        return view('welcome', compact('edit', 'fuel'));
    }

    public function editFuel(Request $request, $id) {
        $validate = $request->validate([
            'date' => 'required|date',
            'quantity' => 'required|numeric',
            'km' => 'required|numeric|min:0',
            'money' => 'required|integer|min:0',
            'location' => 'required|string'
        ]);

        $consumption = ($request->quantity / $request->km) * 100;
        $validate['consumption'] = $consumption;

        $fuel = Datas::findOrFail($id);
        $fuel->fill($validate);
        $fuel->save();

        return redirect()->route('home.data')->with('success', 'Sikeres adatmódosítás!');
    }

    public function deleteFuel($id) {
        $fuel = Datas::findOrFail($id);
        $fuel->delete();

        return back()->with('success', 'Sikeres törlés!');
    }
}