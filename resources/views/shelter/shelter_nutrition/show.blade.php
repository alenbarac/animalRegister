@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
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

<div class="d-flex align-items-center justify-content-between">
  <h5 class="mb-3 mb-md-0">Smještajna jedinica</h5>
  <div>      
    <a id="createAccomodation" href="{{ route('shelters.accomodations.create', $shelter->id) }}" type="button" class="btn btn-primary btn-icon-text">
      Dodaj smještajne jedinice
      <i class="btn-icon-append" data-feather="user-plus"></i>
    </a>                  
  </div>
</div>
@if($shelterNutritionItem)
<div class="row inbox-wrapper mt-3">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 email-aside border-lg-right">
            <div class="aside-content">
               <div class="aside-header">
               <span class="title">Razred: {{ $shelterNutritionItem->animalSystemCategory->latin_name }}</span>
               
              </div> 
              
              <div class="aside-nav collapse">
            
                <span class="title">Akcije</span>
                <ul class="nav nav-pills nav-stacked">
                  <li>
                    <a href="{{ route('shelters.nutritions.edit', [$shelter->id, $shelterNutritionItem->id]) }}"><i data-feather="tag" class="text-warning"></i> Izmjeni jedinicu</a>
                  </li>
                  <li><a href="{{ route('shelters.nutritions.index', [$shelter->id]) }}">
                    <i data-feather="tag" class="text-primary"></i> Povratak na popis</a>
                  </li>
                  <li>
                    <a id="deleteNutrition" href="#" data-shelter-id="{{ $shelter->id }}" data-nutrition-id="{{ $shelterNutritionItem->id  }}"> <i data-feather="tag" class="text-danger"></i> Brisanje jedinice</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-9 email-content">
            <div class="email-head">
              <div class="email-head-subject">
                <div class="title d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <span class="text-secondary">Vrsta/skupina divljih životinja: </span>
                    <span class="ml-2"> {{ $shelterNutritionItem->nutrition_unit }}</span>
                  </div>         
                </div>
              </div>
             
            </div>
            <div class="email-body">
              <div class="title mb-3"><span class="title text-secondary">Program hranjenja: </span></div>
              {!! $shelterNutritionItem->nutrition_desc !!}          
            </div>
          </div>
        </div>
          
      </div>
    </div>
  </div>
</div>
@endif


@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush

@push('custom-scripts')

<script src="{{ asset('assets/js/tinymce.js') }}"></script>
<script>
 $(function() {

          // Delete nutrition item
          $('body').on('click', '#deleteNutrition', function() {

           var accomodation_id = $(this).data('nutrition-id');
           var shelter_id = $(this).data('shelter-id');

            Swal.fire({
                title: "Brisanje?",
                text: "Potvrdite ako ste sigurni za brisanje!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Da, brisanje!",
                cancelButtonText: "Ne, odustani!",
                reverseButtons: !0
            }).then(function (e) {

            if (e.value === true) {
                            
                $.ajax({
                    type: 'DELETE',
                    url: "/shelters/" + shelter_id + "/nutritions/"+ accomodation_id,
                    data: {_token: '{{csrf_token()}}'},
                    dataType: 'JSON',
                    success: function (results) {
                      window.location= "/shelters/" + shelter_id + "/nutritions/"
                    }
                });

              } else {
                e.dismiss;
              }

              }, function (dismiss) {
              return false;
              })
          });

 // Close Modal
 $(".modal").on('click', '.modal-close', function(){
            $(".modal").hide();
        });


});
</script>
@endpush