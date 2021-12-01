<div class="card">
    <div class="card-body">  
        <form action="{{ route('shelterAnimal.invasiveStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="shelter_id" value="{{ auth()->user()->shelter->id }}">
            <input type="hidden" name="shelter_code" value="{{ auth()->user()->shelter->shelter_code }}">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Odabir životinjske vrste</label>
                        <select name="animal_id" class="form-control" id="animalSelect">
                            <option value="">------</option>
                            @foreach ($animal as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Količina (broj jedinki)</label>
                        <input type="number" class="form-control" name="quantity">
                        @error('quantity')
                            <div class="text-danger">{{$errors->first('quantity') }} </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Spol</label>
                        <select class="form-control" name="animal_gender" id="">
                            {{-- @if ($animalItem->animal_dob)
                                <option selected value="{{$animalItem->animal_gender}}">{{$animalItem->animal_gender}}</option>
                            @endif --}}
                            <option value="">Odaberi</option>
                            <option value="muzjak">M (mužjak)</option>
                            <option value="zenka">Ž/F (ženka)</option>
                            <option value="nije moguce odrediti">N (nije moguće odrediti)</option>
                        </select>
                        @error('animal_gender')
                            <div class="text-danger">{{$errors->first('animal_gender') }} </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Dob jedinke</label>
                        <select class="form-control" name="animal_age" id="">
                        {{--  @if ($animalItem->animal_dob)
                                <option selected value="{{$animalItem->animal_dob}}">{{$animalItem->animal_dob}}</option>
                            @endif --}}
                            <option value="">Odaberi</option>
                            <option value="ADL">ADL (adultna)</option>
                            <option value="JUV">JUV (juvenilna)</option>
                            <option value="SA">SA (subadultna)</option>
                            <option value="N">N (neodređeno)</option>
                        </select>
                        @error('animal_age')
                            <div class="text-danger">{{$errors->first('animal_age') }} </div>
                        @enderror
                    </div>  
                </div>
            </div>

            <div class="row">
                <div class="separator"></div>
            </div> 

            <div class="row">
                <div class="col-md-4">
                    <div class="bordered-group">
                        <div class="form-group">
                            <label>Lokacija pronalaska</label>
                            <input type="text" class="form-control" name="location">
                            @error('location')
                                <div class="text-danger">{{$errors->first('location') }} </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Lokacija preuzimanja životinje</label>
                            <select class="form-control" name="location_retrieval_animal" id="">
                                <option value="">Odaberi</option>
                                <option value="u_oporavilistu">U oporavilištu</option>
                                <option value="izvan_oporavilista">Izvan oporavilišta</option>
                                <option value="preuzeli_djelatnici_oporavilista">Preuzeli djelatnici oporavilišta</option>
                                <option value="preuzela_druga_sluzba">Preuzela druga služba</option>
                            </select>
                        </div> 

                        <div class="form-group">
                            <label>Datum zaprimanja u oporavilište</label>
                            <div class="input-group date datepicker" id="datePickerExample">
                                <input type="text" name="start_date" class="form-control">
                                <span class="input-group-addon">
                                <i data-feather="calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>     
                <div class="col-md-4">
                    <div class="bordered-group">
                        <div class="form-group">
                            <label>Nalaznik</label>
                            <select name="founder_id" class="form-control">
                                <option selected value="{{$founder->id}}">
                                    {{$founder->name}} {{$founder->lastname}} 
                                    @if($founder->service != 'ostalo-navesti:')
                                        ({{$founder->service}})
                                    @else
                                        ({{$founder->others}})
                                    @endif
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dodatna napomena</label>
                            <input type="text" name="founder_note" class="form-control">
                        </div>
                    </div>
                </div>  

                <div class="col-md-4">
                    <div class="bordered-group">
                        <div class="form-group">
                            <label>Eutanazija</label>
                            <select class="form-control euthanasia_select" name="euthanasia_select">
                                <option value="">------</option>
                                <option value="da">Da</option>
                                <option value="ne">Ne</option>
                            </select>
                        </div>
                        <div class="form-group" id="euthanasia">
                            <label>Učitaj račun</label>
                            <input type="file" id="euthanasia_invoice" name="euthanasia_invoice[]" multiple />
                            <div class="mb-2" id="error_euthanasia_invoice"></div>
                
                            <label>Iznos</label>
                            <input type="text" class="form-control" name="euthanasia_ammount">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning  mr-2">Spremite podatke</button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>