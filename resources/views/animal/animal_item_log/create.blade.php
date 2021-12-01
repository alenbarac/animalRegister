@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />  
@endpush

@section('content')


<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div> <h5 class="mb-3 mb-md-0">{{ $animalItem->shelter->name }}</h5></div>

  <div>      
    <a href="/shelters/{{ $animalItem->shelter_id }}/animal_groups/{{ $animalItem->animal_group_id }}" type="button" class="btn btn-primary btn-sm btn-icon-text">
       Povratak na popis
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
      <div class="col-md-6">
        <div class="card">
            <div class="card-body">
              <h5 class="card-heading mb-4">Kreiraj zapis postupanja jedinke</h5>
                    <form data-action="{{ route('animal_items.animal_item_logs.store', $animalItem->id) }}" method="POST" id="storeAnimalLog" enctype="multipart/form-data">
                        @csrf                
                        <div id="dangerLogStore" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div id="successLogStore" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Uspjeh!</strong> Zapis postupanja uspješno spremljen.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
            
                        <div class="form-group">
                            <label class="control-label">Odabir akcije postupanja</label>
                            
                            <select class="js-example-basic w-100" name="log_type">
                                <option selected disabled>---</option>
                                @foreach ($logTypes as $logType)
                                    <option value="{{ $logType['id'] }}">{{ $logType['type_name'] }}</option>
                                @endforeach
                            </select>   
                        </div>

                        <div class="form-group">
                            <label>Predmet postupanja jedinke</label>
                            <input type="text" class="form-control size" name="log_subject" id="logSubject" placeholder="Npr. Jedinka zaprimljena u oporavilište ..."> 
                        </div>
                                
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Opis postupanja u oporavilištu</label>
                            <textarea class="form-control" id="logBody" name="log_body" rows="5"></textarea>                    
                        </div>  
                                        
                        <div class="form-group">
                            <label>Popratna dokumentacija</label>  
                                <input name="animal_log_photos[]" type="file" id="animalLogPhotos" multiple>
                                <div id="errorAccomoadionPhotos"></div> 
                        </div>
                        <button type="submit" class="btn btn-primary submit">Spremi zapis</button>                                   
                    </form>
            </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <p class="card-description">Posljednje uneseno</p>
                @if ($animalLogs)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>                                 
                                 
                          <th class="pt-0">Predmet postupanja</th>  
                          <th>Akcija postupanja</th> 
                          <th>Uneseno</th>                             
                          <th class="pt-0">Pregled/Uredi</th> 
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($animalLogs as $logItem)
                        <tr>                                        
                          <td class="td-nowrapp" style="width: 40%;">{{ $logItem->log_subject }}</td>                     
                          <td  class="td-nowrapp">{{ $logItem->logType->type_name }}</td>
                          <td>{{ $logItem->created_at->format('d.m.Y.') }}</td>
                          <td>
                            <div class="d-flex align-items-center">
                              
                              <a type="button" class="btn btn-primary btn-icon mr-2" href="{{ route('animal_items.animal_item_logs.show', [$animalItem->id, $logItem->id]) }}">
                                <i data-feather="check-square"></i>                          
                              </a>                    
                              <a href="{{ route('animal_items.animal_item_logs.edit', [$animalItem->id, $logItem->id]) }}" type="button" class="btn btn-warning btn-icon">
                                <i data-feather="box"></i>
                              </a>
                          </div>  
                          </td>
                        </tr>
                        @endforeach
          
                      </tbody>
                    </table>
                  </div>
                  @endif
                  
            </div>
        </div>
      </div>      
    </div><!-- end Row -->


@push('plugin-scripts')
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script>

@endpush

@push('custom-scripts')
<script>
$(function() {
    $("#animalLogPhotos").fileinput({
        dropZoneEnabled: false,
        language: "cr",
        showPreview: false,
        showUpload: false,
        allowedFileExtensions: ["jpg", "png", "gif", 'doc', 'pdf', 'xls'],
        elErrorContainer: '#errorAnimalLogPhotos',
        msgInvalidFileExtension: 'Nevažeća fotografija, Podržani su "{extensions}" formati.'

    });

    tinymce.init({
            selector: 'textarea#logBody',
            height: 350,
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


        var formId = '#storeAnimalLog';
        $(formId).on('submit', function(e) {
            e.preventDefault();
      
            var formData = new FormData(document.getElementById("storeAnimalLog"));;
            var log_body = tinyMCE.get('logBody').getContent();

            formData.append('log_body', log_body);
                 
            var alertDanger = $('#dangerLogStore');
            var alertSuccess = $('#successLogStore');

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
                            location.reload();
                            }, 2000);
                    }
                }   
                
            });  
        });

        
  });

</script>

@endpush

@endsection
  



