@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">

    <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title">Nalaznici</h6>
                        <p class="card-description">Ministarstvo gospodarstva i održivog razvoja</p>
                    </div>
                    <div>
                        <a href="{{ route('shelters.founders.create', auth()->user()->shelter->id) }}" class="create btn btn-primary">Dodaj</a>
                    </div>
                </div>

                @if($msg = Session::get('msg'))
                <div id="successMessage" class="alert alert-success"> {{ $msg }}</div>
                @endif

                @if($error = Session::get('error'))
                <div id="dangerMessage" class="alert alert-danger">
                    @foreach ($error as $err)
                        <p>{{ $err }}</p>
                    @endforeach
                </div>
                @endif

                <div class="table-responsive-sm">
                    <table class="table" id="founder-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>IME</th>
                                <th>PREZIME</th>
                                <th>EMAIL</th>
                                <th>ADRESA</th>
                                <th>KONTAKT</th>
                                <th>SLUŽBA</th>
                                <th>OSTALO</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
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
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script>
      $(function() {
        var table = $('#founder-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('shelters.founders.index', 'auth()->user()->shelter->id' ) !!}',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name'},
                { data: 'lastname', name: 'lastname'},
                { data: 'email', name: 'email'},
                { data: 'address', name: 'address'},
                { data: 'contact', name: 'contact'},
                { data: 'service', name: 'service'},
                { data: 'others', name: 'others'},
                { data: 'action', name: 'action'},
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.1/i18n/hr.json'
            }
        });

        // Delete
        $('#founder-table').on('click', '.trash', function(e){
            e.preventDefault();

            url = $(this).attr('data-href');

            Swal.fire({
                title: 'Jeste li sigurni?',
                text: "Želite obrisati nalaznika i više neće biti dostupan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Da, obriši!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {_token: '{{csrf_token()}}'},
                        success: function (results) {
                            table.ajax.reload();
                        }
                    });
                }
            });
        });
    });
  </script>
@endpush
