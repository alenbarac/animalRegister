@extends('layout.master')


@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />  
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush


@section('content') 
    <div class="row">
        <div class="col-md-8">
            @if($msg = Session::get('msg'))
              <div class="alert alert-info"> {{ $msg }}</div>
          @endif
      
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="card-title">Oporavilišta za divlje životinje</h6>
                    <p class="card-description">Ministarstvo gospodarstva i održivog razvoja</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#CreateCatModal">Dodaj Novu Porodicu</button>
                    <a href="{{ route('animal_import.index') }}" class="btn btn-warning">Import Podataka</a>
                </div>
            </div>
                                                   
             <div class="table-responsive-sm">
                <table class="table" id="animals-cat-table">
                 <thead>
                    <tr>
                      <th>#</th>
                      <th>Razred jedinke</th>
                      <th>Porodica jedinke</th>                      
                      <th>Akcija</th>             
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>      
              </div>
            </div>       
          </div>
        </div>  
    </div><!-- end Row -->

<!-- Create Category Modal -->
<div class="modal fade" id="CreateCatModal" tabindex="-1" role="dialog"  aria-labelledby="CreateCatModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">Kreiraj Novu Porodicu</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                  <strong>Uspjeh!</strong> Porodica je uspješno kreirana.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="form-group">
                <label>Razred Jedinke</label>
                <select class="form-control" name="animal_class" id="animalClass">     
                  <option selected disabled>----</option>   
                   @foreach ($animalClass as $className)
                    <option value="{{ $className->id }}"> {{ $className->latin_name }} </option>
                  @endforeach 
              </select> 
              </div>  
              <div class="form-group">
                  <label for="groupName">Naziv Porodice:</label>
                  <input type="text" class="form-control" name="category_name" id="catName">                                  
              </div>
          
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="SubmitCatForm">Spremi</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">zatvori</button>
          </div>
      </div>
  </div>
</div>


<!-- Edit Category Modal -->
<div class="modal" id="EditCatModal">
  <div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">Izmjena Porodice</h4>
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
                  <strong>Uspjeh!</strong> Porodica je uspješno spremljena.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div id="EditCatModalBody">
          
              </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="SubmitEditCatForm">Spremi</button>
              <button type="button" class="btn btn-primary modelClose" data-dismiss="modal">Zatvori</button>
          </div>
      </div>
  </div>
</div>

<!-- Delete AnimalSize Modal -->
<div class="modal" id="DeleteCatModal">
  <div class="modal-dialog">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">Brisanje Porodicaa</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Uspjeh!</strong> Porodica izbrisan
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <h5>Jeste li sigurni?</h5>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="SubmitDeleteCatForm">Da</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Ne</button>
          </div>
      </div>
  </div>
</div>
    

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>

@endpush


@endsection

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
  <script>
      $(function() {
            $('#animals-cat-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 15,
                ajax: '{!! route('animal_category.index') !!}',
        
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'animal_system_category', name: 'animal_system_category.latin_name'},  
                    { data: 'animal_category', name: 'latin_name'},                                                                                                       
                    { data: 'action', name: 'action'},                  
                ],
                
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.11.1/i18n/hr.json"
                 }
           
            });
        // Create Order Ajax request.
         $('#SubmitCatForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('animal_category.store') }}",
                method: 'POST',
                data: {
                    animal_class: $('#animalClass').val(),
                    category_name: $('#catName').val(),
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
                            $('#CreateCatModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
        // Show Edit Modal
         $('.modelClose').on('click', function(){
        $('#EditCatModal').hide();
        });
        var id;
        $('body').on('click', '#getEditCatData', function(e) {
            // e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "animal_category/"+id+"/edit",
                method: 'GET',
                 
                success: function(result) {
                    $('#EditCatModalBody').html(result.html);
                    $('#EditCatModal').show();
                }
            });
        });
        // Update Modal.
        $('#SubmitEditCatForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "animal_category/"+id,
                method: 'PUT',
                data: {
                  animal_class: $('#editAnimalClass').val(),
                    category_name: $('#editCatName').val(),
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
                            $('#EditCatModal').hide();
                            location.reload();
                           
                        }, 2000);
                    }
                }
            });
        });
        // Delete Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteCatId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteCatForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                
            });
            $.ajax({
                url: "animal_category/"+id,
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
                        $('#DeleteCatModal').hide();
                        location.reload();
                    }, 1200);
                }
            });
        });
        })
  </script>
@endpush