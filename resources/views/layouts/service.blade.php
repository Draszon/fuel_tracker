@extends('welcome')

@section('title', 'Szerviznapló')

@section('content')

<section class="service-form-container">
    <div class="service-list-form-wrapper">
        <h1 class="service-title">Szervizadatok lekérdezése</h1>
        <h2 class="service-category-title">Válaszd ki a szerviztevékenységet:</h2>    
            <form action="{{ route('service.getdata') }}" class="service-list-form">
                <select name="service-type" id="">
                     @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="submit-btn">Lekérdez</button>
            </form>
            @if (isset($serviceTypeRecord))
                @foreach ($serviceTypeName as $item)
                    <p>{{ $item->name }}</p>
                @endforeach
                
                @foreach ($serviceTypeRecord as $service)
                    <p>{{ $service->date }}</p>
                    <p>{{ $service->current_km }}</p>
                    <p>{{ $service->price }}</p>
                @endforeach
            @endif
            
    </div>
</section>

@endsection