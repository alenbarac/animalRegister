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
                        <h6 class="card-title">Oporavilišta za divlje životinje</h6>
                        <p class="card-description">Ministarstvo gospodarstva i održivog razvoja</p>
                    </div>
                    <div>
                        <button class="btn btn-primary add-price" data-toggle="modal" data-target="#CreateSizeModal">Dodaj Cijene</button>
                    </div>
                </div>

                @if($msg = Session::get('msg'))
                <div class="alert alert-success"> {{ $msg }}</div>
                @endif

              <div class="table-responsive-sm">
                <table class="table sizeDataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Naziv grupe</th>
                        <th> Veličine jedinki</th>
                        <th width="250">Solitarna skrb - cijena/dan</th>
                        <th width="250">Grupna skrb - cijena/dan</th>
                        <th>Akcija</th> 
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

<!-- Create Size Modal -->
<div class="modal" id="CreateSizeModal" tabindex="-1" role="dialog"  aria-labelledby="CreateOrderModal" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">Kreiraj Cijene</h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                  <strong>Uspjeh!</strong>Cijena je uspješno kreirana.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <div class="form-group">
                <label>Naziv Grupe:</label>
                <select class="js-example-basic-single w-100" name="group_name" id="groupName">   
                  <option>----</option>       
                    @foreach ($size_groups as $size)
                      <option value="{{ $size->id }}">{{ $size->group_name }} </option>
                    @endforeach    
                </select>  
              </div>  
              <div class="form-group">
                  <label for="groupName">Veličina jedinke:</label>
                  <input type="text" class="form-control" name="name" id="sizeName">                                   
              </div>
              <div class="form-group">
                <label for="groupName">Solitarna skrb - cijena/dan</label>
                <input type="text" class="form-control" name="base_price" id="basePrice">                                 
              </div>

              <div class="form-group">
                <label for="groupName">Grupna skrb - cijena/dan</label>
                <input type="text" class="form-control" name="group_price" id="groupPrice">                                 
              </div>

          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="SubmitAnimalSizeForm">Spremi</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Zatvori</button>
          </div>
      </div>
  </div>
</div>


<!-- Edit Size Modal -->
<div class="modal" id="EditSizeModal">
  <div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">Uredi Cijenu</h4>
              <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                  <strong>Uspjeh!</strong> Cijena je uspješno spremljena.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div id="EditSizeModalBody">
                  
              </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="SubmitEditAnimalSizeForm">Spremi</button>
              <button type="button" class="btn btn-primary modelClose" data-dismiss="modal">Zatvori</button>
          </div>
      </div>
  </div>
</div>

<!-- Delete AnimalSize Modal -->
<div class="modal" id="DeleteSizeModal">
  <div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">Brisanje Cijene</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Uspjeh!</strong> Cijena izbrisana
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <h4>Jeste li sigurni?</h4>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="SubmitDeleteSizeForm">Da</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Ne</button>
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
     $(document).ready(function() {
 
      // init datatable.
      var dataTable = $('.sizeDataTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 15,
            
            // scrollX: true,
            "order": [[ 0, "desc" ]],
           
            ajax: '{{ route('get_animal_size') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'group_name', name: 'group_name', searchable: true},
                {data: 'animal_size', name: 'name'},
                {data: 'base_price', name: 'base_price'},
                {data: 'group_price', name: 'group_price'},
                {data: 'action', name: 'action' ,orderable:false,serachable:false}, 
            ],
            language: {
                    "url": "//cdn.datatables.net/plug-ins/1.11.1/i18n/hr.json"
                 }
        });

         // Create  Ajax request.
         $('#SubmitAnimalSizeForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('animal_size.store') }}",
                method: 'post',
                data: {
                    group_name: $('#groupName').val(),
                    name: $('#sizeName').val(),
                    base_price: $('#basePrice').val(),
                    group_price: $('#groupPrice').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.sizeDataTable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#CreateSizeModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });


        // Show Edit Modal
        $('.modelClose').on('click', function(){
        $('#EditSizeModal').hide();
        });
        var id;
        $('body').on('click', '#getEditSizeData', function(e) {
            // e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "animal_size/"+id+"/edit",
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    $('#EditSizeModalBody').html(result.html);
                    $('#EditSizeModal').show();
                }
            });
        });

        // Update Modal.
        $('#SubmitEditAnimalSizeForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "animal_size/"+id,
                method: 'PUT',
                data: {
                    name: $('#editsizeName').val(),
                    base_price: $('#editbasePrice').val(),
                    group_price: $('#editgroupPrice').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#EditSizeModal').hide();
                            location.reload();
                           
                        }, 2000);
                    }
                }
            });
        });


        // Delete Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteSizeForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                
            });
            $.ajax({
                url: "animal_size/"+id,
                method: 'DELETE',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function(result) {
                    $('.alert-danger').hide();
                        $('.alert-success').show();
                    setInterval(function(){ 
                        $('.datatable').DataTable().ajax.reload();
                        $('.alert-success').hide();
                        $('#DeleteSizeModal').hide();
                        location.reload();
                    }, 1200);
                }
            });
        });
 
 
   
    });
</script>

@endpush