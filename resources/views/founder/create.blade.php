@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
@endpush

@section('content')

<div>
    <a type="button" class="btn btn-warning btn-icon-text" href="{{ route('shelters.founders.index', auth()->user()->shelter->id) }}">
        Povratak na popis
        <i class="btn-icon-append" data-feather="clipboard"></i>
    </a>
</div>

<div class="row mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('shelters.founders.store', auth()->user()->shelter->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @if($msg = Session::get('founder'))
                    <div id="successMessage" class="alert alert-success"> {{ $msg }}</div>
                    @endif
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Služba koja je izvršila zaplijenu</label>
                                <select id="sluzba" name="service" class="form-control">
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
                                <input type="text" name="others" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ime</label>
                                <input type="text" name="name" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prezime</label>
                                <input type="text" name="lastname" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Adresa</label>
                                <input type="text" name="address" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Država (prebivališta)</label>
                                <input type="text" name="country" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kontakt mobitel/telefon</label>
                                <input type="text" name="contact" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email adresa</label>
                                <input type="text" name="email" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type</label>
                                <select name="shelter_type" id="">
                                    @foreach ($type as $ty)
                                        <option value="{{ $ty->id }}">{{ $ty->name }}</option>
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
                
                    <button type="submit" class="btn btn-primary mr-2">Dodaj nalaznika</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script>
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
    });
  </script>
@endpush
