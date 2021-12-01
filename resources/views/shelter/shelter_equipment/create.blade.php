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
    <a class="nav-link" href="{{ route('shelters.accomodations.index', $shelter_id) }}">Smještajne jedinice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.nutritions.index', $shelter_id) }}">Hranjenje životinja</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ route('shelters.equipments.index', $shelter_id) }}">Oprema, prijevoz životinja</a>
  </li>
</ul>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
      <h5 class="mb-3 mb-md-0">Kreiraj opremu oporavilišta</h5>
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
                    <form data-action="{{ route('shelters.equipments.store', $shelter_id) }}" method="POST" id="storeShelterEquipment" enctype="multipart/form-data">
                        @csrf                
                        <div id="dangerEquipmentStore" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div id="successEquipmentStore" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Uspjeh!</strong> Oprema oporavilišta uspješno spremljena.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
            
                        <div class="form-group">
                            <label class="control-label">Tip entiteta:</label>
                            
                            <select id="equipmentType" class="js-example-basic w-100" name="equipment_type">
                                <option selected disabled>---</option>
                                @foreach ($equipment_types as $equipmentType)
                                    <option value="{{ $equipmentType['id'] }}">{{ $equipmentType['name'] }}</option>
                                @endforeach
                            </select>   
                        </div>

                        <div id="js-equipment-title" class="form-group">
                            <label>Naziv opreme/prijevoza:</label>
                            <input type="text" class="form-control size" name="equipment_title" id="equipmentSize" placeholder="Naziv opreme/prijevoznog sredstva oporavilišta"> 
                        </div>
                        
                      
                          <div id="js-valture-field" class="form-group">
                                <label>Nadležna služba</label>
                                <input type="text" class="form-control size" name="equipment_valture_service" id="equipmentSize" placeholder="Nadležna veterinarska stanica"> 
                          </div>
                      
                                
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Opis entiteta</label>
                            <textarea class="form-control" id="equipmentDesc" name="equipment_desc" rows="5"></textarea>                    
                        </div>  
                                        
                        <div id="js-equipmnt-photos" class="form-group">
                            <label>Popratna fotodokumentacija (jpg, png)</label>  
                                <input name="equipment_photos[]" type="file" id="equipmentPhotos" multiple>
                                <div id="errorEquipmentPhotos"></div> 
                        </div>

                        <div id="js-equipment-contract" class="form-group">
                          <label>Ugovor/sporazum/drugi dokaz sa subjektom ovlaštenim za obavljanje navedenih poslova</label>  
                              <input name="equipment_docs[]" type="file" id="equipmentDocs" multiple>
                              <div id="errorEquipmentDocs"></div> 
                        </div>
                        <button type="submit" class="btn btn-warning submit">Spremi enitet</button>                                   
                    </form>
            </div>
        </div>
      </div>

      <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <p class="card-description">Lista entiteta</p>
                @if ($shelterEquipmentItems)       
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>                                 
                                 
                          <th class="pt-0">Naziv entiteta</th>                    
                          <th>Tip entiteta</th>
                          <th class="pt-0">Pregled/Uredi</th> 
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($shelterEquipmentItems as $equipmentItem)
                        <tr>                                        
                          <td class="td-nowrapp" style="width: 50%;">{{ $equipmentItem->equipment_title }}</td>                     
                          <td>{{ $equipmentItem->equipmentType->name }}</td>
                          <td>
                            <div class="d-flex align-items-center">
                              
                              <a type="button" class="btn btn-primary btn-icon mr-2" href="{{ route('shelters.equipments.show', [$shelter_id, $equipmentItem->id]) }}">
                                <i data-feather="check-square"></i>                          
                              </a>                    
                              <a href="{{ route('shelters.equipments.edit', [$shelter_id, $equipmentItem->id]) }}" type="button" class="btn btn-warning btn-icon">
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

  //show/hide fields based on dropdown
  $("#js-valture-field").hide();
  $("#js-equipment-contract").hide();

  $("#equipmentType").change(function(){
      var drop_id = $("#equipmentType").val();
      
      if(drop_id ==  '6'){
          $("#js-equipment-title").hide();
          $("#js-valture-field").show();

          $("#js-equipmnt-photos").hide();              
          $("#js-equipment-contract").show();
          
      }
      else {
        $("#js-equipment-title").show();
        $("#js-equipmnt-photos").show();
        $("#js-valture-field").hide();
        $("#js-equipment-contract").hide();
        
      }
    });
    
    $("#equipmentPhotos").fileinput({
        dropZoneEnabled: false,
        language: "cr",
        showPreview: false,
        showUpload: false,
        allowedFileExtensions: ["jpg", "png", "gif"],
        elErrorContainer: '#errorEquipmentPhotos',
        msgInvalidFileExtension: 'Nevažeća fotografija, Podržani su "{extensions}" formati.'

    });

    $("#equipmentDocs").fileinput({
        dropZoneEnabled: false,
        language: "cr",
        showPreview: false,
        showUpload: false,
        allowedFileExtensions: ["doc", "docx", "pdf", 'jpg', 'png'],
        elErrorContainer: '#errorEquipmentDocs',
        msgInvalidFileExtension: 'Nevažeći formati, Podržani su "{extensions}" formati.'

    });

    tinymce.init({
            selector: 'textarea#equipmentDesc',
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


        var formId = '#storeShelterEquipment';
        $(formId).on('submit', function(e) {
            e.preventDefault();
      
            var formData = new FormData(document.getElementById("storeShelterEquipment"));;
            var accomodation_desc = tinyMCE.get('equipmentDesc').getContent();

            formData.append('equipment_desc', accomodation_desc);
                 
            var alertDanger = $('#dangerEquipmentStore');
            var alertSuccess = $('#successEquipmentStore');

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
  



