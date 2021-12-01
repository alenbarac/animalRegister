@extends('layout.master')

<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />

@section('content')
<div class="row">
    <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title">Invazivne vrste</h6>
                       
                    </div>
                    <div>
                        <a href="{{ route("create_ij_animal_type") }}" class="btn btn-primary">Dodaj novu jedinku</a>
                    </div>
                </div>

                <div class="row align-items-start mb-4 mt-4">
                    <div class="col-md-7">
                      <p class="text-muted tx-13 mb-3 mb-md-0">Ministarstvo gospodarstva i održivog razvoja</p>
                    </div>
              
                  </div>
                @if($msg = Session::get('msg'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $msg }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif

                <div class="table-responsive-sm">


                <table class="table" id="animals-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Naziv jedinke</th>
                        <th>Latinski naziv jedinke</th>
                        <th>Razred</th>
                        <th>Red</th>                                  
                        <th>Porodica</th>
                        <th>Tip jedinke</th>
                        <th>Akcija</th>
                        
                    </tr>
                    </thead>
                    <tbody></tbody>
                    </table>  
                
                </div>      
           
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush


@push('custom-scripts')
  <script>
      $(function() {
            $('#animals-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('ij_animal_type') !!}',
        
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'latin_name', name: 'latin_name'},
                    { data: 'animal_system_category', name: 'animal_system_category.latin_name'},
                    { data: 'animal_order', name: 'animal_order.order_name'},
                    { data: 'animal_category', name: 'animal_category.latin_name'},                                  
                    { data: 'animal_type', name: 'animal_type.type_name'},                  
                    { data: 'action', name: 'action'},   
                      
                ],
                
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.11.1/i18n/hr.json"
                 }
           
            });
            // Delete
            $('#users-table').on('click', '#bntDeleteUser', function(e){
                e.preventDefault();
                var id = $(this).find('#userId').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
       
            });
        })
  </script>
@endpush