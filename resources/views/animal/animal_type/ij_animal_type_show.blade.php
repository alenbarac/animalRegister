@extends('layout.master')


@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />  
@endpush

@section('content')
<form action="{{ route('update_ij_animal_type', $animal) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Naziv Jedinke</label>
                <input type="text" class="form-control" name="name" value="{{ $animal->name }}" required>
            </div>
            <div class="form-group">
                <label>Latinski Naziv</label>
                <input type="text" class="form-control" name="latin_name" value="{{ $animal->latin_name }}" required>
            </div>  
                <div class="form-group">
                    <label>Oznaka Jedinke</label>
                    <select class="js-example-basic-multiple w-100" multiple="multiple" name="animal_code[]">
                        <option>Izbornik</option>     
                        @foreach ($animalCodes as $itemCode)
                          <option value="{{ $itemCode->id }}"
                            @foreach ($selectedCodes as $selectedCode)
                            @if ($itemCode->id == $selectedCode->id)
                                {{ 'selected' }}
                                @else
                                {{ '' }}
                            @endif
                        @endforeach
                            > 
                        {{ $itemCode->name }} - {{ $itemCode->desc }}
                        </option>
                         
                        @endforeach  
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kategorija</label>
                    <select class="form-control" name="animal_category" id="">   
                        <option>Izbornik</option>     
                        @foreach ($animalCategory as $animalCat)
                          <option value="{{ $animalCat->id }}" {{ ( $animalCat->id == $selectedCat) ? 'selected' : '' }}> {{ $animalCat->latin_name }} </option>
                        @endforeach    
                    </select>             
                  </div>
        
                <div class="form-group">
                    <label>Sistemska kategorija</label>
                    <select class="form-control" name="animal_system_category" id="">   
                        <option>Izbornik</option>     
                        @foreach ($animalSystemCategory as $animalSystemCat)
                          <option value="{{ $animalSystemCat->id }}" {{ ( $animalSystemCat->id == $selectedSystemCat) ? 'selected' : '' }}> {{ $animalSystemCat->name }} </option>
                        @endforeach
                    </select>
                  </div>
        
            </div> 
        </div>
        <button type="submit" class="btn btn-primary mr-2">Ažuriraj</button>
    </div>
    
</form>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>

@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>

@endpush

@endsection