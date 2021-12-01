@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />  
@endpush

@section('content')


<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div> <h5 class="mb-3 mb-md-0">{{ $animalItem->animal->name }} - {{ $animalItem->animal->latin_name }}</h5></div>

  <div>      
    <a href="/shelters/{{ $animalItem->shelter_id }}/animal_groups/{{ $animalItem->animal_group_id }}/animal_items/{{ $animalItem->id }}" type="button" class="btn btn-warning btn-sm btn-icon-text">
      Povratak na jedinku
      <i class="btn-icon-append" data-feather="clipboard"></i>
      
    </a> 
  </div>

</div>
   
    <div class="row">
      <div class="col-md-12">@if($msg = Session::get('msg'))
    
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ $msg }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif</div>
      <div class="col-md-12">
        <div class="card">
            <div class="card-body">
              <h5 class="card-heading mb-4">Uredi zapis postupanja jedinke</h5>
                    <form data-action="{{ route('animal_items.animal_item_logs.update', [$animalItem->id, $animalItemLog->id]) }}" method="POST" id="updateAnimalLog" enctype="multipart/form-data">   
                        @method('PUT') 
                        @csrf             
                        <div id="dangerLogUpdate" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div id="successLogUpdate" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Uspjeh!</strong> Zapis postupanja uspješno uređen.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
            
                        <div class="form-group">
                            <label class="control-label">Odabir akcije postupanja</label>
                            
                            <select class="js-example-basic w-100" name="log_type">
                                <option selected disabled>---</option>
                                @foreach ($logTypes as $logType)
                                    <option  value="{{ $logType['id']}}" {{ ( $logType['id'] == $selectedLogType) ? 'selected' : '' }}>{{ $logType['type_name'] }}</option>
                                @endforeach
                            </select>   
                        </div>

                        <div class="form-group">
                            <label>Predmet postupanja jedinke</label>
                            <input type="text" class="form-control size" name="edit_log_subject" id="logSubject" placeholder="Npr. Jedinka zaprimljena u oporavilište ..." value="{{ $animalItemLog->log_subject }}"> 
                        </div>
                                
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Opis postupanja u oporavilištu</label>
                            <textarea class="form-control" id="updateLogDesc" name="edit_log_body" rows="5">{{  $animalItemLog->log_body }}</textarea>                    
                        </div>  

                        <div class="email-attachments mb-2">
                          <span class="title text-secondary">Dokumentacija: </span>
                          <div class="latest-photos mt-3">
                            <div class="row">
                              @if ($animalItemLog->media)
                                @foreach ($animalItemLog->media as $thumbnail) 
                                <div class="col-md-2 col-sm-2">
                                  <a href="{{ $thumbnail->getUrl() }}">
                                  <figure>
                                    <img class="img-fluid" src="{{ $thumbnail->getUrl() }}" alt="">
                                  </figure>
                                  </a>
                                  <a type="button" data-href="{{ route('animal_item_log.thumbDelete', $thumbnail) }}" class="btn btn-sm btn-danger btn-icon deleteThumb">
                                    <i data-feather="trash"></i>
                                </a>
                                </div>                  
                                @endforeach
                              @endif       
                            </div>
                          </div>
                        </div>
                                        
                        <div class="form-group">
                            <label>Dodatna dokumentacija</label>  
                                <input name="edit_animal_log_photos[]" type="file" id="updateLogDocs" multiple>
                                <div id="errorLogPhotos"></div> 
                        </div>
                        <div class="row mt-4">
                          <div class="col-md-12">
                              <div class="d-flex justify-content-end mt-3">
                                  <button type="submit" class="btn btn-warning  mr-2">Spremite podatke</button>
                              </div>
                             
                          </div>
                      </div>
                                                         
                    </form>
            </div>
        </div>
      </div>    
    </div><!-- end Row -->


@push('plugin-scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script>

@endpush

@push('custom-scripts')
<script>
$(function() {
    var formId = '#updateAnimalLog';
    $('#updateLogDocs').fileinput({
          language: "cr",
          showPreview: false,
          showUpload: false,
          uploadAsync: false,
          overwriteInitial: false,
          uploadUrl: $(formId).attr('data-action'),
          allowedFileExtensions: ['jpg', 'png', 'doc', 'xls'],
          elErrorContainer: '#errorLogPhotos',
          msgInvalidFileExtension: 'Nevažeća fotografija, Podržani su "{extensions}" formati.'
      });

      tinymce.init({
            selector: 'textarea#updateLogDesc',
            height: 300,
            menubar: false,
            plugins: [
              'advlist autolink lists link charmap print preview anchor',
              'searchreplace visualblocks',
              'table paste help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px; color:#fff; }'
        });


     // var formId = '#updateAccomodation';

      $(formId).on('submit', function(e) {
          e.preventDefault();

          var formData = new FormData(document.getElementById("updateAnimalLog"));;
          var log_desc = tinyMCE.get('updateLogDesc').getContent();

          formData.append('edit_log_body', log_desc);
          
          var alertDanger = $('#dangerLogUpdate');
          var alertSuccess = $('#successLogUpdate');

           $.ajax({
              type: 'POST',
              url: $(formId).attr('data-action'),
              data: formData,
              processData: false,
              dataType: 'json',
              contentType: false, 
              success: function(result) {
                       
              if(result.errors) {
                  alertDanger.html('');
                  
                  $.each(result.errors, function(key, value) {
                      alertDanger.show();
                      alertDanger.append('<strong><li>'+value+'</li></strong>');
                  });
              } else {         
                  alertDanger.hide();
                  alertSuccess.show();
  
                  setInterval(function(){
                      window.location=result.redirectTo;
                      }, 1000);
              }
            }   
            
          });  
      });

      // Delete files
      $(".deleteThumb").on('click', function(e){
      e.preventDefault();
      url = $(this).attr('data-href');
      Swal.fire({
          title: 'Jeste li sigurni?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Da, obriši!',
          cancelButtonText: "Ne, odustani!",
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

@endsection
  



