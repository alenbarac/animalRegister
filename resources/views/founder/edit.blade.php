@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div>
    <a type="button" class="btn btn-warning btn-icon-text" href="{{ route('shelters.founders.index', auth()->user()->shelter->id) }}">
        Povratak na popis
        <i class="btn-icon-append" data-feather="clipboard"></i>
    </a>
</div>


<form action="{{ route('shelters.founders.update', [auth()->user()->shelter->id, $founder->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if($msg = Session::get('msg_update'))
    <div id="successMessage" class="alert alert-success"> {{ $msg }}</div>
    @endif

    <div class="row">
        
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Služba koja je izvršila zaplijenu</label>
                                <select id="sluzba" name="service" class="form-control">
                                    @if ($founder->service)
                                        <option selected value="{{$founder->service}}">{{$founder->service}}</option>
                                    @endif
                                    <option value="">------</option>
                                    <option value="Državni inspektorat-inspekcija zaštite prirode">Državni inspektorat-inspekcija zaštite prirode</option>
                                    <option value="Državni inspektorat-veterinarska inspekcija">Državni inspektorat-veterinarska inspekcija</option>
                                    <option value="Ministarstvo unutarnjih poslova">Ministarstvo unutarnjih poslova</option>
                                    <option value="Ministarstvo financija, Carinska uprava">Ministarstvo financija, Carinska uprava</option>
                                    <option value="fizička/pravna osoba">fizička/pravna osoba</option>
                                    <option value="komunalna služba-lokalna i regionalna samouprava">komunalna služba-lokalna i regionalna samouprava</option>
                                    <option value="nepoznato">nepoznato</option>
                                    <option value="djelatnici Javnih ustanova NP/PP ili županija">djelatnici Javnih ustanova NP/PP ili županija</option>
                                    <option value="vlasnik životinje">vlasnik životinje</option>
                                    <option value="ostalo-navesti:">ostalo-navesti:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="ostalo">
                            <div class="form-group">
                                <label>Ostalo navesti</label>
                                <input type="text" name="others" class="form-control" value="{{ $founder->others }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ime</label>
                                <input type="text" name="name" class="form-control" value="{{ $founder->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prezime</label>
                                <input type="text" name="lastname" class="form-control" value="{{ $founder->lastname }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Adresa</label>
                                <input type="text" name="address" class="form-control" value="{{ $founder->address }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Država (prebivališta)</label>
                                <input type="text" name="country" class="form-control" value="{{ $founder->country }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kontakt mobitel/telefon</label>
                                <input type="text" name="contact" class="form-control" value="{{ $founder->contact }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email adresa</label>
                                <input type="text" name="email" class="form-control" value="{{ $founder->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type</label>
                                <select name="shelter_type" id="">
                                    @foreach ($type as $ty)
                                        @if ($founder->shelter_type_id == $ty->id)
                                            <option selected value="{{$ty->id}}">{{$ty->name}}</option>
                                        @else
                                            <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ako se radi o službenoj osobi, podaci o službi-naziv institucije</label>
                                <input type="file" id="founder_documents" name="founder_documents[]" multiple />
                                <div id="error_founder_documents"></div>
                            </div>
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary mr-2">Ažuriraj</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-body">
                    <p>Dokumenti</p>
        
                    @foreach ($mediaFiles as $file)
                        <div class="mb-3">
                            <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                                href="{{ $file->getUrl() }}">
                                {{ $file->file_name }}
                            </a>
                            <a data-href="{{ route('founder.fileDelete', $file) }}" class="btn btn-sm btn-danger p-1 deleteFile" >
                                <i class="mdi mdi-delete"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</form>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script>
    $(function() {
        $("#founder_documents").fileinput({
            language: "cr",
            maxFileCount: 2,
            showPreview: false,
            showUpload: false,
            allowedFileExtensions: ['pdf', 'doc', 'docx', 'jpg', 'png'],
            elErrorContainer: '#error_founder_documents',
            msgInvalidFileExtension: 'Nevažeći format "{name}". Podržani su: "{extensions}"',
        });

        // SLUZBA
        $("#ostalo").hide();
        $("#sluzba").change(function(){
            var id = $("#sluzba").val();

            if(id != 'ostalo-navesti:'){
                $("#ostalo").hide();
            }
            else {
                $("#ostalo").show();
            }
        });

        // Delete files
        $(".deleteFile").on('click', function(e){
            e.preventDefault();

            url = $(this).attr('data-href');

            Swal.fire({
                title: 'Jeste li sigurni?',
                text: "Želite obrisati dokument i više neće biti dostupan!",
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
    });
  </script>
@endpush
