@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
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
    <a class="nav-link active" href="{{ route('shelters.nutritions.index', $shelter->id) }}">Hranjenje životinja</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.equipments.index', $shelter->id) }}">Oprema, prijevoz životinja</a>
  </li>
</ul>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
      <h5 class="mb-3 mb-md-0">Kreiraj program prehrane</h5>
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
      <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                    <form data-action="{{ route('shelters.nutritions.store', $shelter->id) }}" method="POST" id="storeShelterNutrition" enctype="multipart/form-data">
                        @csrf                
                        <div id="dangerNutritionStore" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div id="successNutritionStore" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Uspjeh!</strong> Program prehrane uspješno spremljen.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
            
                        <div class="form-group">
                            <label class="control-label">Razred životinja</label>
                            <select class="js-example-basic w-100" name="animal_class">
                                <option selected disabled>ovlašteno za oporavilište</option>
                               @foreach ($shelter->animalSystemCategory as $systemCat)
                                    <option value="{{ $systemCat->id }}">{{ $systemCat->latin_name }} ({{ $systemCat->name }})</option>
                                @endforeach 
                            </select>   
                          </div>
                                
                        <div class="form-group">
                            <label>Vrsta/skupina divljih životinja</label>
                            <input type="text" class="form-control size" name="nutrition_unit" id="nutritionUnit" placeholder="Vrsta/skupina divljih životinja za koje se iskazuje interes"> 
                          
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Opis programa hranjenja</label>
                            <textarea class="form-control" id="nutritionDesc" name="nutrition_desc" rows="5"></textarea>                    
                        </div>  
                                        
                        <button type="submit" class="btn btn-primary submit">Spremi program hranjenja</button>                                   
                    </form>
            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <p class="card-description">Lista programa prehrane</p>
                
                @if ($shelterNutritionItems) 
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>          
                        <th>Razred</th> 
                        <th>Vrsta/skupina životinja</th>
                        <th class="pt-0">Pregled/Uredi</th> 
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($shelterNutritionItems as $nutritionItem)
                      <tr>
                        <td>{{ $nutritionItem->animalSystemCategory->latin_name }}</td>
                        <td>{{ $nutritionItem->nutrition_unit }}</td>
                         
                        <td>
                        <div class="d-flex align-items-center">                
                          <a type="button" class="btn btn-primary btn-icon mr-2" href="{{ route('shelters.nutritions.show', [$shelter->id, $nutritionItem->id]) }}">
                            <i data-feather="check-square"></i>                          
                          </a>                    
                          <a href="{{ route('shelters.nutritions.edit', [$shelter->id, $nutritionItem->id]) }}" type="button" class="btn btn-warning btn-icon">
                            <i data-feather="clipboard"></i>
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
@endpush

@push('custom-scripts')
<script>
$(function() {
    tinymce.init({
            selector: 'textarea#nutritionDesc',
            height: 500,
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

        var formId = '#storeShelterNutrition';
        $(formId).on('submit', function(e) {
            e.preventDefault();
      
            var formData = new FormData(document.getElementById("storeShelterNutrition"));;
            var nutrition_desc = tinyMCE.get('nutritionDesc').getContent();

            formData.append('nutrition_desc', nutrition_desc);
                 
            var alertDanger = $('#dangerNutritionStore');
            var alertSuccess = $('#successNutritionStore');

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
  



