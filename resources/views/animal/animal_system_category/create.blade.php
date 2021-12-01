@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('animal_system_category.store') }}" method="POST">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label>Naziv</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Oporavilište kojem pripada</label>
                    <select name="shelter_unit_id" required>
                        <option value="">Odaberi</option>
                        @foreach ($shelterUnit as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Dodaj</button>
            </form>
        </div>
    </div>

@endsection