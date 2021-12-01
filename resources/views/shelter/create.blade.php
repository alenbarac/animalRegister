@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-line-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
        Oporavilište
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-line-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
        Jedinke
        </a>
    </li>
</ul>
<div class="tab-content" id="lineTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-line-tab">

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Oporavilište - osnovne informacije</h6>
        
                        @if($msg = Session::get('msg'))
                            <div id="successMessage" class="alert alert-success">
                                {{ $msg }}
                                <strong>{{ Session::get('active') }}</strong>
                            </div>
                        @endif
        
                        <form action="{{ route("shelter.store") }}" method="POST" multiple>
                            @csrf
                        
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Naziv pravne osobe</label>
                                        <input type="text" name="name" class="form-control"  placeholder="Naziv pravne osobe">
                                        @error('name')
                                            <div class="text-danger">{{$errors->first('name') }} </div>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">OIB</label>              
                                        <input class="form-control oib-field" maxlength="11" name="oib" id="oib" type="text" placeholder="Unsite OIB">
                                        @error('oib')
                                            <div class="text-danger">{{$errors->first('oib') }} </div>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-5">
                                    <div class="form-group">
                                    <label class="control-label">Adresa Sjedišta</label>
                                    <input type="text" name="address" class="form-control" placeholder="Adresa Sjedišta">
                                        @error('address')
                                        <div class="text-danger">{{$errors->first('address') }} </div>
                                        @enderror
                                    </div>
                                </div><!-- Col -->                 
                            </div><!-- Row -->
        
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label class="control-label">Mjesto i poštanski broj</label>
                                    <input type="text" class="form-control" name="place_zip" placeholder="Mjesto i poštanski broj">
                                        @error('place_zip')
                                            <div class="text-danger">{{$errors->first('place_zip') }} </div>
                                        @enderror
                                    </div>
                                </div><!-- Col -->       
                                <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Adresa lokacije oporavilišta</label>
                                    <input type="text" class="form-control" name="address_place" placeholder="Adresa lokacije oporavilišta">
                                    @error('address_place')
                                        <div class="text-danger">{{$errors->first('address_place') }} </div>
                                    @enderror
                                </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Telefon</label>
                                    <input type="text" name="telephone" class="form-control" placeholder="Telefon">
                                    @error('telephone')
                                        <div class="text-danger">{{$errors->first('telephone') }} </div>
                                    @enderror
                                </div>
                                </div><!-- Col --> 
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label class="control-label">Fax</label>
                                    <input type="text" name="fax" class="form-control" placeholder="Fax">
                                        @error('fax')
                                            <div class="text-danger">{{$errors->first('fax') }} </div>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            
                            <div class="row">           
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label class="control-label">Mobitel</label>
                                    <input type="text" name="mobile" class="form-control" placeholder="Mobitel">
                                        @error('mobile')
                                            <div class="text-danger">{{$errors->first('mobile') }} </div>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Email adresa</label>
                                    <input class="form-control mb-4 mb-md-0" name="email" data-inputmask="'alias': 'email'"/>
                                    @error('email')
                                        <div class="text-danger">{{$errors->first('email') }} </div>
                                    @enderror
                                </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label class="control-label">Web adresa</label>
                                    <input type="text" name="web_address" class="form-control" placeholder="Web adresa">
                                    @error('web_address')
                                        <div class="text-danger">{{$errors->first('web_address') }} </div>
                                    @enderror
                                    </div>
                                </div><!-- Col -->
        
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">Datum ovlaštenja oporavilišta</label>
                                        <div class="input-group date datepicker" id="datePickerExample">
                                            <input type="text" class="form-control" name="register_date"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                                            @error('register_date')
                                            <div class="text-danger">{{$errors->first('register_date') }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div><!-- Col -->
                        
                            </div><!-- Row -->
                        
                            <div class="row">
                                <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Račun pravne osobe - Naziv banke</label>
                                    <input type="text" name="bank_name" class="form-control" placeholder="Naziv Banke">
                                    @error('bank_name')
                                        <div class="text-danger">{{$errors->first('bank_name') }} </div>
                                    @enderror
                                </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">IBAN Računa</label>
                                    <input class="form-control iban-field" maxlength="21" name="iban" id="iban" type="text" placeholder="HRcc AAAA AAAB BBBB BBBB B">
                                    @error('iban')
                                        <div class="text-danger">{{$errors->first('iban') }} </div>
                                    @enderror
                                </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">             
                                    <div class="form-group">
                                        <label class="control-label">Predmet obavljanje poslova</label>
                                        <select class="js-example-basic-multiple w-100" name="shelter_type_id[]" multiple="multiple">
                                            @foreach ($shelterType as $code)
                                                <option value="{{ $code->id }}">{{ $code->name }}</option>
                                            @endforeach
                                        </select>   
                                        @error('shelter_type_id')
                                            <div class="text-danger">{{$errors->first('shelter_type_id') }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">            
                                    <div class="form-group">
                                        <label class="control-label">Šifra oporavilišta</label>
                                        <input class="form-control shelter_code_field" maxlength="5" name="shelter_code" id="shelter_code" type="text" placeholder="Šifra oporavilišta">
                                        @error('shelter_code')
                                            <div class="text-danger">{{$errors->first('shelter_code') }} </div>
                                        @enderror
                                    </div>         
                                </div>             
                            </div><!-- Row -->
                            
        
                            <button type="submit" class="btn btn-primary submit">Spremi Osnovne informacije</button>
                        </form>         
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-line-tab">

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if($msg = Session::get('active'))
                            <h6 class="card-title">Kategorije razreda za oporavilište</h6>
            
                            <form action="{{ route("createAnimalSystemCat") }}" method="POST">
                                @csrf
                            
                                <div class="row">
                                    <div class="col-md-4">
                                        <div>
                                            {{-- @foreach ($type['shelterType'] as $res)
                                                <p>- {{ $res->name }}</p>
                                            @endforeach --}}
                                        </div>

                                        <input type="hidden" name="shelter_id" value="{{Session::get('shelter_id')}}">
    
                                        <div class="form-group">
                                            @foreach ($type['type'] as $res)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="animal_system_category_id[]" class="form-check-input" value="{{ $res->id }}">
                                                        {{ $res->name }}
                                                        <i class="input-frame"></i>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><!-- Col -->               
                                </div><!-- Row -->
            
                                <button type="submit" class="btn btn-primary submit mt-3">Spremi Osnovne informacije</button>
                            </form>
                        @else
                            <p>Potrebno je prvo ispuniti oporavilište!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('plugin-scripts')
  
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>

@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script> 

  <script>
      // Setup maxlength
    $('.oib-field').maxlength({
        alwaysShow: true,
        validate: false,
        allowOverMax: true,
        customMaxAttribute: "90"
    });
    $('.iban-field').maxlength({
        alwaysShow: true,
        validate: false,
        allowOverMax: true,
        customMaxAttribute: "90"
    });
    $('.shelter_code_field').maxlength({
        alwaysShow: true,
        validate: false,
        allowOverMax: true,
        customMaxAttribute: "90"
    });

    $("input#optionsRadios").each(function(){
        $(this).on('click', function(){
            $('input[type=checkbox]').each(function () {
                $(this).prop('checked', false);
            });
        });
    });
  </script>
@endpush