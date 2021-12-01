@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Izmjenite podatke oporavilišta - {{  $shelter->name }}</h6>
                <form action="{{ route("shelter.update", $shelter->id) }}" method="POST" multiple>
                    @csrf
                    @method('PATCH')
                    <div class="row">      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Naziv</label>
                                <input type="text" class="form-control" name="name" value="{{ $shelter->name }}" required>
                                @error('name')
                                <div class="text-danger">{{$errors->first('name') }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mjesto i poštanski broj</label>
                                <input type="text" class="form-control" name="place_zip" value="{{ $shelter->place_zip }}" required>
                                @error('place_zip')
                                <div class="text-danger">{{$errors->first('place_zip') }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Fax</label>
                                <input type="number" class="form-control" name="fax" value="{{ $shelter->fax }}" required>
                                @error('fax')
                                <div class="text-danger">{{$errors->first('fax') }} </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Web adresa</label>
                                <input type="text" class="form-control" name="web_address" value="{{ $shelter->web_address }}" required>
                                @error('web_address')
                                <div class="text-danger">{{$errors->first('web_address') }} </div>
                                @enderror
                            </div>
                                 
                            <div class="form-group">
                                <label>Predmet obavljanja poslova</label>
                                <select class="js-example-basic-multiple w-100" name="shelter_type_id[]" multiple="multiple">
                                   {{--  @foreach ($shelterType as $code)
                                        @if ($shelter->shelterTypes->isEmpty())
                                            <option value="{{ $code->id }}">{{ $code->name }}</option>
                                        @endif
                
                                        @foreach ($shelter->shelterTypes as $co)
                                            @if ($co->id == $code->id)
                                                <option selected value="{{ $code->id }}">{{ $code->name }}</option>
                                            @else
                                                <option value="{{ $code->id }}">{{ $code->name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach --}}

                                    @foreach ($shelterTypes as $shelterType)
                                    <option value="{{ $shelterType->id }}"
                                      @foreach ($selectedShelterTypes as $selectedType)
                                             @if ($shelterType->id == $selectedType->id)
                                                {{ 'selected' }}
                                                @else
                                                {{ '' }}
                                            @endif
                                        @endforeach
                                      > 
                                    {{ $shelterType->code }} - {{ $shelterType->name }}
                                    </option>
                                    @endforeach
                                    
                                </select>
                                @error('shelter_type_id')
                                <div class="text-danger">{{$errors->first('shelter_type_id') }} </div>
                                @enderror
                            </div>                          
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>OIB</label>
                                <input type="number" class="form-control oib-field" name="oib" value="{{ $shelter->oib }}" required>
                                @error('oib')
                                <div class="text-danger">{{$errors->first('oib') }} </div>
                                @enderror
                            </div>
                            <div class="form-group">                       
                                <label>Adresa lokacije</label>
                                <input type="text" class="form-control " name="address_place" value="{{ $shelter->address_place }}" required>
                                @error('address_place')
                                <div class="text-danger">{{$errors->first('address_place') }} </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mobitel</label>
                                <input type="number" class="form-control" name="mobile" value="{{ $shelter->mobile }}" required>
                                @error('mobile')
                                <div class="text-danger">{{$errors->first('mobile') }} </div>
                                @enderror
                            </div>
                                                          
                            <div class="form-group">
                                <label class="control-label">Račun pravne osobe - Naziv banke</label>
                                <input type="text" name="bank_name" class="form-control" placeholder="Naziv Banke" value="{{ $shelter->bank_name }}">
                                @error('bank_name')
                                    <div class="text-danger">{{$errors->first('bank_name') }} </div>
                                @enderror
                            </div>   
                            
                            <div class="form-group">
                                <label>Šifra oporavilišta</label>
                                <input type="text" class="form-control shelter_code_field" name="shelter_code" value="{{ $shelter->shelter_code }}" required>
                                @error('bank_name')
                                <div class="text-danger">{{$errors->first('shelter_code') }} </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Adresa sjedišta</label>
                                <input type="text" class="form-control" name="address" value="{{ $shelter->address }}" required>
                                @error('address')
                                <div class="text-danger">{{$errors->first('address') }} </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Telefon</label>
                                <input type="number" class="form-control" name="telephone" value="{{ $shelter->telephone }}" required>
                                @error('telephone')
                                <div class="text-danger">{{$errors->first('telephone') }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email adresa</label>
                                <input type="email" class="form-control" name="email" value="{{ $shelter->email }}" required>
                                @error('email')
                                <div class="text-danger">{{$errors->first('email') }} </div>
                                @enderror
                            </div>

                            <div class="form-group">              
                                <label>IBAN računa</label>
                                <input type="number" class="form-control iban-field" name="iban" value="{{ $shelter->iban }}" required>
                                @error('iban')
                                <div class="text-danger">{{$errors->first('iban') }} </div>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label class="control-label">Datum ovlaštenja oporavilišta</label>
                                <div class="input-group date datepicker" id="dateRegister">
                                    <input type="text" class="form-control register_date" name="register_date" value="{{ $shelter->register_date }}"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                                    @error('register_date')
                                    <div class="text-danger">{{$errors->first('register_date') }} </div>
                                    @enderror
                                </div>
                            </div> 
                        
                       
                        </div>    
                
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Ažuriraj</button>
                </form>
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

  //edit registered date
  var dateValue = $("div#dateRegister").find(".register_date").val();
  console.log(dateValue);
  $("#dateRegister").datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true
    }).datepicker("update", dateValue);

</script>
@endpush