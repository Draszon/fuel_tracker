@extends('welcome')

@section('title', 'Fuel Tracker')

@section('content')
            <section class="fuel-form-container input-form">
                <div class="data-upload-form-container">
                    <form action="{{ isset($edit) ? route('fuel.edit', $edit->id) : route('fuel.store') }}" method="POST">
                        @csrf
                        @if (isset($edit))
                            @method('PUT')
                        @endif

                        <h1 class="title">Adatok rögzítése</h1>

                        <label for="date" class="field-title">Dátum:</label>
                        <input type="date" name="date" id="date" required value="{{ isset($edit) ? $edit->date : '' }}">

                        <label for="quantity" class="field-title">Mennyiség (L):</label>
                        <input type="number" name="quantity" id="quantity" step="0.01" required value="{{ isset($edit) ? $edit->quantity : '' }}">
                        
                        <label for="km" class="field-title">Megtett KM:</label>
                        <input type="number" name="km" id="km" required value="{{ isset($edit) ? $edit->km : '' }}">
                
                        <label for="money" class="field-title">Összeg:</label>
                        <input type="number" name="money" id="money" required value="{{ isset($edit) ? $edit->money : '' }}">

                        <label for="location" class="field-title">Benzinkút neve:</label>
                        <input type="text" name="location" id="location" required value="{{ isset($edit) ? $edit->location : '' }}">

                        <button type="submit" class="submit-btn">Feltölt</button>
                    </form>
                </div>

                <div class="statistics-container">
                    <h2 class="statistics-title title">Statisztikák</h2>

                    <form action="{{ route('statistics') }}" method="get">
                        <label for="month">Év/Hónap kiválasztása:</label>
                        <input type="month" name="month" id="month" required>
                        <button type="submit" class="submit-btn">Lekérdez</button>
                    </form>

                    <div class="statistics-table-header">
                        <h2 class="statistics-column-title"></h2>
                        <h2 class="statistics-column-title">Üzemanyag</h2>
                        <h2 class="statistics-column-title">Megtett táv</h2>
                        <h2 class="statistics-column-title">Fogyasztás</h2>
                    </div>
                    <div class="statistics-data-wrapper">
                        <div class="table-column">
                            <h2 class="statistics-column-title">Havi átlag:</h2>
                            <h2 class="statistics-column-title">Éves átlag:</h2>
                            <h2 class="statistics-column-title">Évi összes:</h2>
                        </div>
                        <div class="statistic-datas-wrapper">
                            <div class="statistics-data">{{ isset($avgFuelM) ? $avgFuelM : '' }} l</div>
                            <div class="statistics-data">{{ isset($avgFuelY) ? $avgFuelY : '' }} l</div>
                            <div class="statistics-data">{{ isset($fullFuelRound) ? $fullFuelRound : '' }} l</div>
                        </div>
                        <div class="statistic-datas-wrapper">
                            <div class="statistics-data">{{ isset($avgKmM) ? $avgKmM : '' }} km</div>
                            <div class="statistics-data">{{ isset($avgKmY) ? $avgKmY : '' }} km</div>
                            <div class="statistics-data">{{ isset($fullKmRound) ? $fullKmRound : '' }} km</div>
                        </div>
                        <div class="statistic-datas-wrapper">
                            <div class="statistics-data">{{ isset($avgConsumptionM) ? $avgConsumptionM : '' }} l</div>
                            <div class="statistics-data">{{ isset($avgConsumptionY) ? $avgConsumptionY : '' }} l</div>
                            <div class="statistics-data">{{ isset($fullConsumptionRound) ? $fullConsumptionRound : '' }} l</div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="fuel-form-container fuel-list">

                @if (session('success'))
                    <h1 class="success">{{ session('success') }}</h1>
                @endif

                <div class="fuel-list-scroll">
                    <h1 class="title">Korábbi tankolások</h1>

                    <div class="fuel-list-item-header">
                        <h2 class="fuel-data-title">Dátum</h2>
                        <h2 class="fuel-data-title">Mennyiség (L)</h2>
                        <h2 class="fuel-data-title">Megtett táv</h2>
                        <h2 class="fuel-data-title">Fogyasztás</h2>
                        <h2 class="fuel-data-title">Összeg</h2>
                        <h2 class="fuel-data-title">Benzinkút neve</h2>
                        <h2 class="fuel-data-title">Műveletek</h2>
                    </div>
                    @foreach ($fuel as $item)
                        <div class="fuel-list-item">
                            <p class="fuel-data">{{ $item->date }}</p>
                            <p class="fuel-data">{{ $item->quantity }} l</p>
                            <p class="fuel-data">{{ $item->km }} km</p>
                            <p class="fuel-data">{{ $item->consumption }} l/100km</p>
                            <p class="fuel-data">{{ $item->money }} Ft</p>
                            <p class="fuel-data">{{ $item->location }}</p>

                            <div class="action-btns">
                                <form action="{{ route('fuel.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <img src="{{ asset('images/cross.png') }}" class="form-icon" alt="törlés">
                                    </button>
                                </form>
                                <form action="{{ route('fuel.editload', $item->id) }}" method="GET">
                                    <button type="submit">
                                        <img src="{{ asset('images/edit.png') }}" class="form-icon" alt="szerkesztés">
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4">{{ $fuel->links() }}</div>
                </div>
            </section>
@endsection