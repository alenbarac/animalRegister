@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
@endpush

@section('content')
<ul class="nav shelter-nav">

  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelter.show', $shelter_id) }}">Oporavilište</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelter.shelter_staff', $shelter_id) }}">Odgovorne osobe</a>
  </li>

  <li class="nav-item">
    <a class="nav-link active" href="{{ route('shelters.accomodations.index', $shelter_id) }}">Smještajne jedinice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.nutritions.index', $shelter_id) }}">Hranjenje životinja</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{ route('shelters.equipments.index', $shelter_id) }}">Oprema, prijevoz životinja</a>
  </li>
</ul>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
      <h5 class="mb-3 mb-md-0">Kreiraj smještajnu jedinicu</h5>
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
      <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                    <form data-action="{{ route('shelters.accomodations.store', $shelter_id) }}" method="POST" id="storeShelterAccomodation" enctype="multipart/form-data">
                        @csrf                
                        <div id="dangerAccomodationStore" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div id="successAccomodationStore" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Uspjeh!</strong> Smještajna jedinica uspješno spremljena.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
            
                        <div class="form-group">
                            <label class="control-label">Tip smještajne jedinice</label>
                            <input type="hidden" name="shelter_id" id="shelterID" value="{{ $shelter_id }}">
                            <select class="js-example-basic w-100" name="accomodation_type">
                                <option selected disabled>---</option>
                                @foreach ($accomodation_types as $accomodationType)
                                    <option value="{{ $accomodationType['id'] }}">{{ $accomodationType['name'] }}</option>
                                @endforeach
                            </select>   
                        </div>

                        <div class="form-group">
                            <label>Naziv</label>
                            <input type="text" class="form-control size" name="accomodation_name" id="accomodationSize" placeholder="Naziv nastambe npr. Kavez 01"> 
                        </div>
                                
                        <div class="form-group">
                            <label>Dimenzije</label>
                            <input type="text" class="form-control size" name="accomodation_size" id="accomodationSize" placeholder="dimenzija u metrima D x Š x V"> 
                          
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Opis smještajne jedinice</label>
                            <textarea class="form-control" id="accomodationDesc" name="accomodation_desc" rows="5"></textarea>                    
                        </div>  
                                        
                        <div class="form-group">
                            <label>Popratna fotodokumentacija (jpg, png)</label>  
                                <input name="accomodation_photos[]" type="file" id="accomodationPhotos" multiple>
                                <div id="errorAccomoadionPhotos"></div> 
                        </div>
                        <button type="submit" class="btn btn-primary submit">Spremi nastambu</button>                                   
                    </form>
            </div>
        </div>
      </div>

      <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <p class="card-description">Lista jedinica</p>
                @if ($shelterAccomodationItems)
                    
            
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>                                 
                                 
                          <th class="pt-0">Naziv jedinice</th>                    
                          <th>Dimenzije</th>
                          <th class="pt-0">Pregled/Uredi</th> 
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($shelterAccomodationItems as $shelterItem)
                        <tr>                                        
                          <td>{{ $shelterItem->name }}</td>                     
                          <td>{{ $shelterItem->dimensions }}</td>
                          <td>
                            <div class="d-flex align-items-center">
                              
                              <a type="button" class="btn btn-primary btn-icon mr-2" href="{{ route('shelters.accomodations.show', [$shelter_id, $shelterItem->id]) }}">
                                <i data-feather="check-square"></i>                          
                              </a>                    
                              <a href="{{ route('shelters.accomodations.edit', [$shelter_id, $shelterItem->id]) }}" type="button" class="btn btn-warning btn-icon">
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
    $("#accomodationPhotos").fileinput({
        dropZoneEnabled: false,
        language: "cr",
        showPreview: false,
        showUpload: false,
        allowedFileExtensions: ["jpg", "png", "gif"],
        elErrorContainer: '#errorAccomoadionPhotos',
        msgInvalidFileExtension: 'Nevažeća fotografija, Podržani su "{extensions}" formati.'

    });

    tinymce.init({
            selector: 'textarea#accomodationDesc',
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


        var formId = '#storeShelterAccomodation';
        $(formId).on('submit', function(e) {
            e.preventDefault();
      
            var formData = new FormData(document.getElementById("storeShelterAccomodation"));;
            var accomodation_desc = tinyMCE.get('accomodationDesc').getContent();

            formData.append('accomodation_desc', accomodation_desc);
                 
            var alertDanger = $('#dangerAccomodationStore');
            var alertSuccess = $('#successAccomodationStore');

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
  



