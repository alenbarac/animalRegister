@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <div>
                <a href="/shelter/{{ $animalItem->shelter_id }}/animal/{{ $animalItem->shelter_code }}" class="btn btn-primary">
                    <i data-feather="left" data-toggle="tooltip" title="Connect"></i>
                    Natrag
                </a>
            </div>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        @if($msg = Session::get('msg_update'))
                        <div id="successMessage" class="alert alert-success"> {{ $msg }}</div>
                        @endif

                        @if($msg = Session::get('error'))
                        <div id="dangerMessage" class="alert alert-danger"> {{ $msg }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="/animalItem/update/{{$animalItem->id}}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="hib_est_from_to">
                                            <label>Hibernacija/estivacija</label>
                                            <div class="d-flex">
                                                <div class="input-group date datepicker" id="datePickerExample">
                                                    <input type="text" name="hib_est_from" class="form-control hib_est_from" value="{{ $animalItem->dateRange->hibern_start }}">
                                                    <span class="input-group-addon">
                                                        <i data-feather="calendar"></i>
                                                    </span>
                                                </div>
                                                <div class="input-group date datepicker" id="datePickerExample">
                                                    <input type="text" name="hib_est_to" class="form-control hib_est_to" value="{{ $animalItem->dateRange->hibern_end }}">
                                                    <span class="input-group-addon">
                                                        <i data-feather="calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="form-group" id="period">
                                            <label>Razdoblje provođenja proširene skrbi <strong>(ostalo {{ $totalDays }} dana)</strong></label>
                                            @if ($totalDays != 0)
                                            <div class="d-flex">
                                                <div class="input-group date datepicker" id="datePickerExample">
                                                    <input type="text" name="full_care_start" class="form-control full_care_start">
                                                    <span class="input-group-addon">
                                                        <i data-feather="calendar"></i>
                                                    </span>
                                                </div>
                                                <div class="input-group date datepicker" id="datePickerExample">
                                                    <input type="text" name="full_care_end" class="form-control full_care_end">
                                                    <span class="input-group-addon">
                                                        <i data-feather="calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Datum prestanka skrbi o životinji (<strong>Datum početka skrbi {{ $dateRange->start_date }}</strong>)</label>
                                            <div class="input-group date datepicker" id="datePickerExample">
                                                <input type="text" name="end_date" class="form-control end_date" value="{{ $dateRange->end_date }}">
                                                <span class="input-group-addon">
                                                    <i data-feather="calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Razlog prestanka skrbi o životinji</label>
                                            <div class="input-group">
                                                <input type="text" name="reason_date_end" class="form-control" value="{{ $dateRange->reason_date_end }}">
                                            </div>
                                        </div> 
                                    </div>       
                                </div> 

                                <button type="submit" id="submit" class="btn btn-primary mr-2 mt-3">Ažuriraj</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        @if($msg = Session::get('msg'))
                        <div id="successMessage" class="alert alert-success"> {{ $msg }}</div>
                        @endif
                    </div>

                    <form method="POST" id="animalItemFile" action="{{ route('animaItem.addedFile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="animal_item_id" name="animal_item_id" value="{{$animalItem->id}}">

                        <div class="form-group">
                            <label>PDF</label>
                            <input type="file" id="file" name="filenames[]" multiple />
                            <div id="error_file"></div>
                        </div>
            
                        <button type="submit" class="btn btn-primary mr-2">Upload</button>
                    </form>

                    <div class="mb-2 mt-4">
                        <h6 class="card-title">Dokumenti životinje</h6>
                    </div>
                    
                    @if ($mediaItems)
                        @foreach ($mediaItems as $file)
                            <div id="findFile">
                                <div>
                                    <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                                        href="{{ $file->getUrl() }}">
                                        {{ $file->file_name }}
                                    </a>
                                    <a data-href="{{ route('animalItem.fileDelete', $file) }}" class="btn btn-sm btn-danger p-1 deleteFile" >
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("animal_item.update", $animalItem->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Veličina</label>
                                <select class="form-control" name="animal_size_attributes_id" id="">
                                    <option value="">Odaberi</option>
                                    @foreach ($size->sizeAttributes as $siz)
                                        @if ($animalItem->animal_size_attributes_id == $siz->id)
                                            <option selected value="{{$siz->id}}">{{ $siz->name }}</option>
                                        @else
                                            <option value="{{ $siz->id }}">{{ $siz->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('animal_size_attributes_id')
                                    <div class="text-danger">{{$errors->first('animal_size_attributes_id') }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Dob jedinke</label>
                                <select class="form-control" name="animal_dob" id="">
                                    @if ($animalItem->animal_dob)
                                        <option selected value="{{$animalItem->animal_dob}}">{{$animalItem->animal_dob}}</option>
                                    @endif
                                    <option value="">Odaberi</option>
                                    <option value="ADL">ADL (adultna)</option>
                                    <option value="JUV">JUV (juvenilna)</option>
                                    <option value="SA">SA (subadultna)</option>
                                </select>
                                @error('animal_dob')
                                    <div class="text-danger">{{$errors->first('animal_dob') }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Spol</label>
                                <select class="form-control" name="animal_gender" id="">
                                    @if ($animalItem->animal_dob)
                                        <option selected value="{{$animalItem->animal_gender}}">{{$animalItem->animal_gender}}</option>
                                    @endif
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

                        <div class="col-md-4">

                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Ažuriraj</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script>
        $(function() {
            $("#file").fileinput({
                language: "cr",
                required: true,
                showPreview: false,
                showUpload: false,
                allowedFileExtensions: ["pdf"],
                elErrorContainer: '#error_file',
                msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
            });

            if($('div#datePickerExample').length) {
                $('div#datePickerExample input').datepicker({
                    format: "dd.mm.yyyy",
                    todayHighlight: true,
                    autoclose: true,
                });
                $("div#datePickerExample").find(".end_date").datepicker('setDate', $("div#datePickerExample").find(".end_date").val());
                $("div#datePickerExample").find(".hib_est_from").datepicker('setDate', $("div#datePickerExample").find(".hib_est_from").val());
                $("div#datePickerExample").find(".hib_est_to").datepicker('setDate', $("div#datePickerExample").find(".hib_est_to").val());
            }

            // Proširena skrb, obavezno
            $('.full_care_start').on('change', function(){
                if($(this).val()){
                    $('#submit').attr("disabled", true);

                    $('.full_care_end').on('change', function(){
                        if($(this).val()){
                            $('#submit').attr("disabled", false);
                        }
                        else {
                            $('#submit').attr("disabled", true);
                        }
                    });
                }
                else {
                    $('#submit').attr("disabled", false);
                }
            });

            // Delete files
            $(".deleteFile").on('click', function(e){
                e.preventDefault();

                url = $(this).attr('data-href');

                Swal.fire({
                    title: 'Jeste li sigurni?',
                    text: "Želite obrisati oporavilište i više neće biti dostupno!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Da, obriši!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(result) {
                                if(result.msg == 'success'){
                                    location.reload();
                                }
                            }
                        }); 
                    }
                });
            });
        })
    </script>
@endpush