@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="d-flex align-items-center justify-content-between">
    <h5 class="mb-3 mb-md-0">{{ $shelter->name }}</h5>
    <div>
        <a type="button" class="createFounder btn btn-primary btn-icon-text" href="javascript:void()">
            Dodaj nalaznika
            <i class="btn-icon-append" data-feather="user"></i>
        </a>
        <a type="button" class="btn btn-warning btn-icon-text" href="/shelter/{{ $shelter->id }}">
            Povratak na popis
            <i class="btn-icon-append" data-feather="clipboard"></i>
        </a>
    </div>
</div>

<hr>

<div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><h6>Dodavanje jedinke u oporavilište</h6></div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tip jedinke</label>
                                    <select class="form-control" id="shelterType">
                                        <option value="">------</option>
                                        @foreach ($shelterType as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nalaznik</label>
                                    <select class="form-control" id="founder">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <p class="card-description">U slučaju da nalaznik već nije spremljen u sustav, <a class="createFounder" href="javascript:void()">dodajte novog nalaznika.</a></p>
                    </div>       
                </div>
            </div>
        </div>
       

        <div class="template mt-3"></div> 

</div>

<div class="modal bd-example-modal-xl"></div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script>
@endpush

@push('custom-scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script>
        $(function() {
            // Get Founder
            $("#shelterType").change(function(){
                $(".template").html('');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('shelterAnimal.getfounder') }}",
                    method: 'POST',
                    data: {
                        'type_id': $(this).val(),
                    },
                    success: function(data) {
                        $('#founder').html(data.html);
                    }
                });
            });

            // Create founder
            $(".createFounder").click(function(e){
                e.preventDefault();

                $.ajax({
                    url: "/founder_modal",
                    method: 'GET',
                    success: function(result) {
                        $(".modal").show();
                        $(".modal").html(result['html']);
                        founderScript();

                        $('.modal').find("#founder-form").on('submit', function(e){
                            e.preventDefault();

                            var formData = this;

                            $.ajax({
                                url: "/founder_create",
                                method: 'POST',
                                data: new FormData(formData),
                                processData: false,
                                dataType: 'json',
                                contentType: false,
                                success: function(result) {
                                    if(result.errors) {
                                        $('.alert-danger').html('');
                                        $.each(result.errors, function(key, value) {
                                            $('.alert-danger').show();
                                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                                        });
                                    } 
                                    else {
                                        $('.alert-danger').hide();
                                        $('.alert-success').show();

                                        setInterval(function(){
                                            $('.alert-success').hide();
                                            $('.modal').modal('hide');
                                            location.reload();
                                        }, 2000);
                                    }
                                }
                            });
                        });
                    }
                });
            });

            // Close Modal
            $(".modal").on('click', '.modal-close', function(){
                $(".modal").hide();
            });

            // Get Form
            $("#founder").change(function(){
                if($(this).val() > 0){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('shelterAnimal.getForm') }}",
                        method: 'POST',
                        data: {
                            'founder_id': $(this).val(),
                            'type_id': $('#shelterType').val(),
                        },
                        success: function(data) {
                            $(".template").html(data.html);
                            scripts();
                        }
                    });
                }
            });

            function founderScript()
            {
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
            }

            function scripts()
            {
                if($('div#datePickerExample').length) {
                    var date = new Date();
                    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    $('div#datePickerExample').datepicker({
                        format: "mm/dd/yyyy",
                        todayHighlight: true,
                        autoclose: true,
                    });
                    $('div#datePickerExample').datepicker('setDate', today);
                }

                if($('div#datePickerHibernation').length) {
                    var date = new Date();
                    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    $('div#datePickerHibernation').datepicker({
                        format: "mm/dd/yyyy",
                        todayHighlight: true,
                        autoclose: true,
                    });
                    $('div#datePickerHibernation').datepicker('setDate', today);
                }

                if($('div#datePickerSeizedAnimal').length) {
                    var date = new Date();
                    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    $('div#datePickerSeizedAnimal').datepicker({
                        format: "mm/dd/yyyy",
                        todayHighlight: true,
                        autoclose: true,
                    });
                    $('div#datePickerSeizedAnimal').datepicker('setDate', today);
                }

                if($('div#datePickerShleterStart').length) {
                    var date = new Date();
                    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    $('div#datePickerShleterStart').datepicker({
                        format: "mm/dd/yyyy",
                        todayHighlight: true,
                        autoclose: true,
                    });
                    $('div#datePickerShleterStart').datepicker('setDate', today);
                }

                $("#founder_documents").fileinput({
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ['pdf', 'doc', 'docx', 'jpg', 'png'],
                    elErrorContainer: '#error_founder_documents',
                    msgInvalidFileExtension: 'Nevažeći format "{name}". Podržani su: "{extensions}"',
                });
                $("#documents").fileinput({
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ["pdf"],
                    elErrorContainer: '#error_documents',
                    msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
                });
                $("#reason_file").fileinput({ 
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ["png", "jpg"],
                    elErrorContainer: '#error_reason_file',
                    msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
                });
                $("#status_found_file").fileinput({
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ["jpg", "png",],
                    elErrorContainer: '#error_status_found_file',
                    msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
                });
                $("#status_receiving_file").fileinput({
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ["jpg", "png",],
                    elErrorContainer: '#error_status_receiving_file',
                    msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
                });

                $("#animal_mark_photos").fileinput({
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ["jpg", "png",],
                    elErrorContainer: '#error_animal_mark_photos',
                    msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
                });

                $("#vrsta_broj_dokumenta").fileinput({
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ["jpg", "png", "pdf", "doc", "xls"],
                    elErrorContainer: '#error_vrsta_broj_dokumenta',
                    msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
                });

                $("#euthanasia_invoice").fileinput({
                    language: "cr",
                    maxFileCount: 2,
                    showPreview: false,
                    showUpload: false,
                    allowedFileExtensions: ["jpg", "png", "pdf"],
                    elErrorContainer: '#error_vrsta_broj_dokumenta',
                    msgInvalidFileExtension: 'Nevažeći dokument "{name}". Podržani su samo "{extensions}"',
                });

                $('[data-toggle="tooltip"]').tooltip(); 

                // HIBERNACIJA
                $("#hib_est_from_to").hide();
                $(".hib_est").change(function(){
                    var id = $(".hib_est").val();

                    if(id != 'da'){
                        $("#hib_est_from_to").hide();
                    }
                    else {
                        $("#hib_est_from_to").show();
                    }
                });

                // HIBERNACIJA
                $("#euthanasia").hide();
                $(".euthanasia_select").change(function(){
                    var id = $(".euthanasia_select").val();

                    if(id != 'da'){
                        $("#euthanasia").hide();
                    }
                    else {
                        $("#euthanasia").show();
                    }
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

                //getAnimal size based on animal
                $("#animalSelect").change(function(){
                    $.ajax({
                        url: "{{ route('animals.get_by_size') }}?animal_id=" + $(this).val(),
                        method: 'GET',
                        success: function(data) {
                            $('#animalSize').html(data.html);
                        }
                    });
                });
            }
        });
    </script>
@endpush