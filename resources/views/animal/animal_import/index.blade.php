@extends('layout.master')


@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />  
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
      <h4 class="mb-3 mb-md-0">Strogo Zaštićene Jedinke</h4>
  </div>
</div>
   
    <div class="row">
      <div class="col-md-12">@if($msg = Session::get('msg'))
        <div class="alert alert-info"> {{ $msg }}</div>
        @endif</div>
      <div class="col-md-4">
        

        <div class="card">
          <div class="card-body">
            <p class="card-description">Dodaj popis redova preko dokumenta (.xls, .csv)</p>
            <form action="{{ route('animal_order_import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Import Redova</label>
                <input type="file" name="animal_order_import" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled="" placeholder="Import dokumenta">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Odabir</button>
                  </span>
                </div>
                @error('animal_order_import')
                <p class="text-danger mt-3">{{ $message }}</p>
                @enderror
              </div>
     
              <button type="submit" class="btn btn-warning mr-2 mt-2">Spremite Rezultate</button>
            </form>
          </div>
        </div>

      </div>
        
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <p class="card-description">Dodaj popis porodica preko dokumenta (.xls, .csv)</p>
              <form action="{{ route('animal_category_import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Import Porodica</label>
                  <input type="file" name="animal_category_import" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Import dokumenta">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Odabir</button>
                    </span>
                  </div>
                  @error('animal_category_import')
                  <p class="text-danger mt-3">{{ $message }}</p>
                  @enderror
                </div>
       
                <button type="submit" class="btn btn-warning mr-2 mt-2">Spremite Rezultate</button>
              </form>
            </div>
          </div>
 
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <p class="card-description">Dodaj popis strogo zaštićenih vrsta preko dokumenta (.xls, .csv)</p>
              <form action="{{ route('animal_sz_import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Import Strogo Zaštićenih Vrsta</label>
                  <input type="file" name="animal_sz_import" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Import dokumenta">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Odabir</button>
                    </span>
                  </div>
                  @error('animal_sz_import')
                  <p class="text-danger mt-3">{{ $message }}</p>
                  @enderror
                </div>
       
                <button type="submit" class="btn btn-warning mr-2 mt-2">Spremite Rezultate</button>
              </form>
            </div>
          </div>
 
        </div>
         
    </div><!-- end Row -->

    <div class="row mt-4">

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <p class="card-description">Dodaj popis invazivnih vrsta preko dokumenta (.xls, .csv)</p>
            <form action="{{ route('animal_invazive_import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Import Vrsta - Invazivne</label>
                <input type="file" name="animal_invazive_import" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled="" placeholder="Import dokumenta">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Odabir</button>
                  </span>
                </div>
                @error('animal_invazive_import')
                <p class="text-danger mt-3">{{ $message }}</p>
                @enderror
              </div>
     
              <button type="submit" class="btn btn-warning mr-2 mt-2">Spremite Rezultate</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <p class="card-description">Dodaj zapljenjenih vrsta preko dokumenta (.xls, .csv)</p>
            <form action="{{ route('animal_seized_import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Import Vrsta - Zaplijene</label>
                <input type="file" name="animal_seized_import" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled="" placeholder="Import dokumenta">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Odabir</button>
                  </span>
                </div>
                @error('animal_seized_import')
                <p class="text-danger mt-3">{{ $message }}</p>
                @enderror
              </div>
     
              <button type="submit" class="btn btn-warning mr-2 mt-2">Spremite Rezultate</button>
            </form>
          </div>
        </div>

      </div>
       
  </div><!-- end Row -->
        

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>

@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>

@endpush

@endsection