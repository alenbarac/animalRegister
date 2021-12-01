@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<ul class="nav shelter-nav">

  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelter.show', $shelter->id) }}">Oporavilište</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelter.shelter_staff', $shelter->id) }}">Odgovorne osobe</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.accomodations.index', $shelter->id) }}">Smještajne jedinice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.nutritions.index', $shelter->id) }}">Hranjenje životinja</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ route('shelters.equipments.index', $shelter->id) }}">Oprema, prijevoz životinja</a>
  </li>
</ul>

<div class="d-flex align-items-center justify-content-between">
  <h5 class="mb-3 mb-md-0">Oprema oporavilišta</h5>
  <div>      
    <a id="createEquipment" href="{{ route('shelters.equipments.create', $shelter->id) }}" type="button" class="btn btn-primary btn-icon-text">
      Dodaj smještajnu jedinicu
      <i class="btn-icon-append" data-feather="user-plus"></i>
    </a>  
    <a id="createEquipment" href="{{ route('shelters.equipments.index', $shelter->id) }}" type="button" class="btn btn-warning btn-icon-text">
      Popis svih
      <i class="btn-icon-append"  data-feather="box"></i>
    </a>                 
  </div>
</div>
<div class="row inbox-wrapper mt-4">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Izmjeni entitet oporavilišta</h6>
        <!-- Modal body -->
          <form data-action="{{ route('shelters.equipments.update', [$shelter->id, $shelterEquipmentItem->id]) }}" id="updateEquipment" method="POST" enctype="multipart/form-data"> 
            @method('PUT') 
            @csrf  
            
            <div id="dangerEquipmentUpdate" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="successEquipmentUpdate" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
              <strong>Uspjeh!</strong> Entitet oporavilišta uspješno spremljen.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>

            
              <div class="form-group">
                <label class="control-label">Tip entiteta:</label>
                <select class="js-example-basic w-100" name="equipment_type">
                    <option selected disabled>---</option>
                    @foreach ($equipment_types as $equipmentType)
                        <option disabled value="{{ $equipmentType['id']}}" {{ ( $equipmentType['id'] == $selectedEquipmentType) ? 'selected' : '' }}>{{ $equipmentType['name'] }}</option>
                    @endforeach
                </select>   
            </div>
           
            @if ($selectedEquipmentType != '6') 
            <div id="js-equipment-title" class="form-group">
              <label>Naziv entiteta</label>
              <input type="text" class="form-control size" name="edit_equipment_title" id="updateEquipmentTitle" placeholder="Naziv entiteta npr. Kavez 01" value="{{ $shelterEquipmentItem->equipment_title }}">             
            </div> 
               @else
              <div id="js-valture-field" class="form-group">
                <label>Nadležna služba</label>
                <input type="text" class="form-control size" name="edit_equipment_valture_service" id="equipmentSize" placeholder="Nadležna veterinarska stanica" value="{{ $shelterEquipmentItem->equipment_title }}"> 
              </div>
             @endif 
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Opis entiteta</label>
                <textarea class="form-control" id="updateEquipmentDesc" name="edit_equipment_desc" rows="8">{{ $shelterEquipmentItem->equipment_desc }}</textarea>
            </div>  

            <div class="email-attachments mb-2">
              @if ($selectedEquipmentType != '6')<span class="title text-secondary">Fotodokumentacija:</span> @endif
              <div class="latest-photos mt-3">
                <div class="row">
                  @if ($shelterEquipmentItem->media)
                    @foreach ($shelterEquipmentItem->media as $thumbnail) 
                      @if ($shelterEquipmentItem->equipmentType->type != 'zbrinjavanje lešina')
                      <div class="col-md-2 col-sm-2">
                        <a href="{{ $thumbnail->getUrl() }}">
                        <figure>
                          <img class="img-fluid" src="{{ $thumbnail->getUrl() }}" alt="">
                        </figure>
                        </a>
                        <a type="button" data-href="{{ route('equipment.thumbDelete', $thumbnail) }}" class="btn btn-sm btn-danger btn-icon deleteThumb" >
                          <i data-feather="trash"></i>
                        </a>
                      </div> 
                        @else
                        <div class="col-md-6 col-sm-6">
                          <i data-feather="paperclip" class="text-muted mr-2"></i> <a href="{{ $thumbnail->getUrl() }}"> {{ $thumbnail->file_name }}</a>
                          <a type="button" data-href="{{ route('equipment.thumbDelete', $thumbnail) }}" class="btn btn-sm btn-danger btn-icon deleteThumb" >
                            <i data-feather="trash"></i>
                          </a>
                        </div>
                      @endif                 
                    @endforeach
                  @endif       
                </div>
              </div>
            </div>
            @if ($shelterEquipmentItem->equipmentType->type != 'zbrinjavanje lešina')        
            <div class="form-group">
                <label>Dodatne fotografije:</label>
                <input  name="edit_equipment_photos[]" type="file" id="updateEquipmentPhotos" multiple>
                <div id="errorEquipmentPhotos"></div> 
            </div>
              @else
              <div class="form-group">
                <label>Dodatna dokumentacija:</label>
                <input  name="edit_equipment_docs[]" type="file" id="updateEquipmentDocs" multiple>
                <div id="errorEquipmentDocs"></div> 
              </div>
            @endif
          <input type="submit" class="submitBtn btn btn-warning" value="Spremi">      
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script> 
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/file-upload.js') }}"></script>
<script src="{{ asset('assets/js/tinymce.js') }}"></script>
<script>

  $(function() {
    var formId = '#updateEquipment';
    $('#updateEquipmentPhotos').fileinput({
          language: "cr",
          showPreview: false,
          showUpload: false,
          uploadAsync: false,
          overwriteInitial: false,
          uploadUrl: $(formId).attr('data-action'),
          allowedFileExtensions: ['jpg', 'png'],
          elErrorContainer: '#errorEquipmentPhotos',
          msgInvalidFileExtension: 'Nevažeća fotografija, Podržani su "{extensions}" formati.'
      });

      $('#updateEquipmentDocs').fileinput({
          language: "cr",
          showPreview: false,
          showUpload: false,
          uploadAsync: false,
          overwriteInitial: false,
          uploadUrl: $(formId).attr('data-action'),
          allowedFileExtensions: ['jpg', 'png', 'pdf', 'doc', 'docx'],
          elErrorContainer: '#errorEquipmentDocs',
          msgInvalidFileExtension: 'Nevažeći format, Podržani su "{extensions}" formati.'
      });

      tinymce.init({
            selector: 'textarea#updateEquipmentDesc',
            height: 400,
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


     // var formId = '#updateEquipment';

      $(formId).on('submit', function(e) {
          e.preventDefault();

          var formData = new FormData(document.getElementById("updateEquipment"));;
          var equipment_desc = tinyMCE.get('updateEquipmentDesc').getContent();

          formData.append('edit_equipment_desc', equipment_desc);
          
          var alertDanger = $('#dangerEquipmentUpdate');
          var alertSuccess = $('#successEquipmentUpdate');

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