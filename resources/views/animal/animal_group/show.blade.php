@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="d-flex align-items-center justify-content-between">
    <h5 class="mb-3 mb-md-0">Popis jedinki unutar grupe</h5>
    <div>
        <a type="button" class="btn btn-warning btn-icon-text" href="/shelter/{{ $animal_group->shelters->first()->id }}">      
            Povratak na popis
            <i class="btn-icon-append" data-feather="clipboard"></i>
        </a>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 col-xl-8 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Podatci</h6>
                    <div>
                        <a href="javascript:void(0)" data-id="{{ $animal_group->id }}" class="changeShelter btn btn-warning btn-sm">Premjesti cijelu grupu</a>
                    </div>
                </div>

                @if($msg = Session::get('msg'))
                <div id="successMessage" class="alert alert-success"> {{ $msg }}</div>
                @endif

                <div class="table-responsive-sm">
                <table class="table" id="animal-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NAZIV</th>
                            <th>LATINSKI NAZIV</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card grid-margin">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 grid-margin">
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Naziv: </label>
                            <p class="text-muted">{{ $animal_items->first()->animal->name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Latinski naziv: </label>
                            <p class="text-muted">{{ $animal_items->first()->animal->latin_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin">
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Ukupni broj:</label>
                            <p class="text-muted">
                                {{ $animal_items->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="example">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="openModal" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Oporavilišta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" id="currentShelter" value="{{ $animal_group->shelters->first()->id }}">
                                <select class="form-control" id="shelters">
                                    <option value="">------</option>
                                    @foreach ($shelters as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="sendGroup" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

<script>
$(function() {
    var table = $('#animal-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('shelters.animal_groups.show', [$animal_group->shelters->first()->id, $animal_group->id]) !!}',
        columns: [
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name'},
            { data: 'latin_name', name: 'latin_name'},
            { data: 'action', name: 'action'},
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.1/i18n/hr.json'
        },
        pageLength: 5
    });

    // Premještaj Item
    $("#animal-table").on('click','#changeShelterItem', function(){
        $("#openModal").trigger('click');
        id = $(this).attr("data-id");

        console.log(id)

        $("#sendGroup").click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/animal_item/" + id,
                method: 'POST',
                data: {
                    selectedShelter: $("#shelters").val(),
                    currentShelter: $("#currentShelter").val()
                },
                success: function(data) {
                    if(data.msg == 'success'){
                        Swal.fire(
                            'Odlično!',
                            'Uspješno ste poslali jedinku u oporavilište <br>' + data.newShelter.name + '.',
                            'success'
                        ).then((result) => {
                            location.href = '/shelter/'+data.back;
                        });
                    }
                }
            });
        });
    });

    // Premještaj Group
    $(".changeShelter").click(function(){
        $("#openModal").trigger('click');
        id = $(this).attr("data-id");

        $("#sendGroup").click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "/animal_group/" + id,
                method: 'POST',
                data: {
                    selectedShelter: $("#shelters").val(),
                    currentShelter: $("#currentShelter").val()
                },
                success: function(data) {
                    if(data.msg == 'success'){
                        Swal.fire(
                            'Odlično!',
                            'Uspješno ste poslali grupu u oporavilište <br>' + data.newShelter.name + '.',
                            'success'
                        ).then((result) => {
                            location.href = '/shelter/'+data.back;
                        });
                    }
                }
            });
        });
    });
});
</script>

<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush