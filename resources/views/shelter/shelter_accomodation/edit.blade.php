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
    <a class="nav-link active" href="{{ route('shelters.accomodations.index', $shelter->id) }}">Smještajne jedinice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.nutritions.index', $shelter->id) }}">Hranjenje životinja</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{ route('shelters.equipments.index', $shelter->id) }}">Oprema, prijevoz životinja</a>
  </li>
</ul>

<div class="d-flex align-items-center justify-content-between">
  <h5 class="mb-3 mb-md-0">Smještajna jedinica</h5>
  <div>      
    <a id="createAccomodation" href="{{ route('shelters.accomodations.create', $shelter->id) }}" type="button" class="btn btn-primary btn-icon-text">
      Dodaj smještajnu jedinicu
      <i class="btn-icon-append" data-feather="user-plus"></i>
    </a>  
    <a id="createAccomodation" href="{{ route('shelters.accomodations.index', $shelter->id) }}" type="button" class="btn btn-warning btn-icon-text">
      Popis svih
      <i class="btn-icon-append"  data-feather="box"></i>
    </a>                 
  </div>
</div>
<div class="row inbox-wrapper mt-4">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Izmjeni smještajnu jedinicu</h6>
        <!-- Modal body -->
          <form data-action="{{ route('shelters.accomodations.update', [$shelter->id, $shelterAccomodationItem->id]) }}" id="updateAccomodation" method="POST" enctype="multipart/form-data"> 
            @method('PUT') 
            @csrf  
            
            <div id="dangerAccomodationUpdate" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="successAccomodationUpdate" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
              <strong>Uspjeh!</strong> Smještajna jedinica uspješno spremljena.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form-group">
              <label>Naziv</label>
              <input type="text" class="form-control size" name="edit_accomodation_name" id="updateAccomodationName" placeholder="Naziv nastambe npr. Kavez 01" value="{{ $shelterAccomodationItem->name }}">             
            </div>
                    
            <div class="form-group">
                <label>Dimenzije</label>
                <input type="text" class="form-control size" name="edit_accomodation_size" id="updateAccomodationSize" placeholder="dimenzija u metrima D x Š x V" value="{{ $shelterAccomodationItem->dimensions }}">           
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Opis nastambe</label>
                <textarea class="form-control" id="updateAccomodationDesc" name="edit_accomodation_desc" rows="8">{{ $shelterAccomodationItem->description }}</textarea>
            </div>  

            <div class="email-attachments mb-2">
              <span class="title text-secondary">Fotodokumentacija: </span>
              <div class="latest-photos mt-3">
                <div class="row">
                  @if ($shelterAccomodationItem->media)
                    @foreach ($shelterAccomodationItem->media as $thumbnail) 
                    <div class="col-md-2 col-sm-2">
                      <a href="{{ $thumbnail->getUrl() }}">
                      <figure>
                        <img class="img-fluid" src="{{ $thumbnail->getUrl() }}" alt="">
                      </figure>
                      </a>
                      <a type="button" data-href="{{ route('accomodation.thumbDelete', $thumbnail) }}" class="btn btn-sm btn-danger btn-icon deleteThumb" >
                        <i data-feather="trash"></i>
                    </a>
                    </div>                  
                    @endforeach
                  @endif       
                </div>
              </div>
            </div>
                      
            <div class="form-group">
                <label>Dodatne fotografije:</label>
                  <input  name="edit_accomodation_photos[]" type="file" id="updateAccomodationPhotos" multiple>
            </div>
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
    var formId = '#updateAccomodation';
    $('#updateAccomodationPhotos').fileinput({
          language: "cr",
          showPreview: false,
          showUpload: false,
          uploadAsync: false,
          overwriteInitial: false,
          uploadUrl: $(formId).attr('data-action'),
          allowedFileExtensions: ['jpg', 'png']
      });

      tinymce.init({
            selector: 'textarea#updateAccomodationDesc',
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


     // var formId = '#updateAccomodation';

      $(formId).on('submit', function(e) {
          e.preventDefault();

          var formData = new FormData(document.getElementById("updateAccomodation"));;
          var accomodation_desc = tinyMCE.get('updateAccomodationDesc').getContent();

          formData.append('edit_accomodation_desc', accomodation_desc);
          
          var alertDanger = $('#dangerAccomodationUpdate');
          var alertSuccess = $('#successAccomodationUpdate');

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