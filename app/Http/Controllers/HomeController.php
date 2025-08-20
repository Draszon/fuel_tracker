<?php

namespace App\Http\Controllers;

use App\Models\Datas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $fuel = Datas::orderBy('date', 'desc')->get();
        foreach ($fuel as $item) {
            $item->consumption = round($item->consumption, 1);
        }

        return view('layouts.fuel', compact('fuel'));
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
        foreach ($fuel as $item) {
            $item->consumption = round($item->consumption, 1);
        }

        return view('layouts.fuel', compact('edit', 'fuel'));
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

    public function statistics(Request $request) {
        $fuel = Datas::orderBy('date', 'desc')->get();
        foreach ($fuel as $item) {
            $item->consumption = round($item->consumption, 1);
        }
        $date = $request->query('month');

        $avgFuelM = null;
        $avgKmM = null;
        $avgConsumptionM = null;

        $avgFuelY = null;
        $avgKmY = null;
        $avgConsumptionY = null;

        if ($date) {
            //havi adatok 
            $startMonth = \Carbon\Carbon::parse($date)->startOfMonth();
            $endMonth = \Carbon\Carbon::parse($date)->endOfMonth();

            $fuels = Datas::whereBetween('date', [$startMonth, $endMonth])->get();
            $kms = Datas::whereBetween('date', [$startMonth, $endMonth])->get();
            $consumption = Datas::whereBetween('date', [$startMonth, $endMonth])->get();

            $avgFuelM = round($fuels->avg('quantity'), 1);
            $avgKmM = round($kms->avg('km'), 1);
            $avgConsumptionM = round($consumption->avg('consumption'), 1);

            //éves adatok
            $startYear = \Carbon\Carbon::parse($date)->startOfYear();
            $endYear = \Carbon\Carbon::parse($date)->endOfYear();

            $fuelsY = Datas::whereBetween('date', [$startYear, $endYear])->get();
            $kmsY = Datas::whereBetween('date', [$startYear, $endYear])->get();
            $consumptionY = Datas::whereBetween('date', [$startYear, $endYear])->get();

            $avgFuelY = round($fuelsY->avg('quantity'), 1);
            $avgKmY = round($kmsY->avg('km'), 1);
            $avgConsumptionY = round($consumptionY->avg('consumption'), 1);

            //összes adat
            $fullFuel = Datas::whereBetween('date', [$startYear, $endYear])->get();
            $fullKm = Datas::whereBetween('date', [$startYear, $endYear])->get();
            $fullConsumption = Datas::whereBetween('date', [$startYear, $endYear])->get();

            $fullFuelRound = round($fullFuel->sum('quantity'), 1);
            $fullKmRound = round($fullKm->sum('km'), 1);
            $fullConsumptionRound = round($fullConsumption->sum('consumption'), 1);
        }

        return view('layouts.fuel', compact(
            'fuel',
            'avgFuelM',
            'avgKmM',
            'avgConsumptionM',
            'avgFuelY',
            'avgKmY',
            'avgConsumptionY',
            'fullFuelRound',
            'fullKmRound',
            'fullConsumptionRound'
        ));
    }
}