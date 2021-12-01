@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/') }}" rel="stylesheet" />
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
      Dodaj smještajne jedinice
      <i class="btn-icon-append" data-feather="user-plus"></i>
    </a>                  
  </div>
</div>
@if($shelterAccomodationItem)
<div class="row inbox-wrapper mt-3">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 email-aside border-lg-right">
            <div class="aside-content">
              <div class="aside-header">
               <span class="title">{{ $shelterAccomodationItem->accommodationType->name }}</span>
               <p class="description mt-3"><span class="text-secondary">Numeracija: </span> {{ $shelterAccomodationItem->accommodationType->type_mark  }}</p>
                <p class="description mt-3"><span class="text-secondary">Opis oznake: </span> {{ $shelterAccomodationItem->accommodationType->type_description  }}</p>
              </div>
              
              <div class="aside-nav collapse">
            
                <span class="title">Akcije</span>
                <ul class="nav nav-pills nav-stacked">
                  <li>
                    <a href="{{ route('shelters.accomodations.edit', [$shelter->id, $shelterAccomodationItem->id]) }}"><i data-feather="tag" class="text-warning"></i> Izmjeni jedinicu</a>
                  </li>
                  <li><a href="{{ route('shelters.accomodations.index', [$shelter->id]) }}">
                    <i data-feather="tag" class="text-primary"></i> Povratak na popis</a>
                  </li>
                  <li>
                    <a id="deleteAccomodation" href="#" data-shelter-id="{{ $shelter->id }}" data-accomodation-id="{{ $shelterAccomodationItem->id  }}"> <i data-feather="tag" class="text-danger"></i> Brisanje jedinice</a>
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
                    <span class="text-secondary">Naziv jedinice: </span>
                    <span class="ml-2"> {{ $shelterAccomodationItem->name }}</span>
                  </div>         
                </div>
              </div>
              <div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center">          
                  <span class="title text-secondary">Dimenzije: </span>
                  <div class="sender d-flex align-items-center">
                    <span>{{ $shelterAccomodationItem->dimensions }}</span>
                
                  </div>
                </div>        
              </div>
            </div>
            <div class="email-body">
              <div class="title mb-3"><span class="title text-secondary">Opis jedinice: </span></div>
              {!! $shelterAccomodationItem->description !!}
            
            </div>
            <div class="email-attachments">
              <span class="title text-secondary">Fotodokumentacija: </span>
              <div class="latest-photos mt-3">
                <div class="row">
                  @foreach ($shelterAccomodationItem->media as $thumbnail) 
                  <div class="col-md-2 col-sm-2">
                    <a href="{{ $thumbnail->getUrl() }}" data-lightbox="accomodation">
                    <figure>
                      <img class="img-fluid" src="{{ $thumbnail->getUrl() }}" alt="">
                    </figure>
                    </a>
                  </div>                  
                  @endforeach
                </div>
              </div>
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
  <script src="{{ asset('assets/plugins/bootstrap-fileinput/fileinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-fileinput/lang/cr.js') }}"></script> 
  <script src="{{ asset('assets/plugins/lightbox2/lightbox.min.js') }}"></script> 
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/file-upload.js') }}"></script>
<script src="{{ asset('assets/js/tinymce.js') }}"></script>
<script>
 $(function() {

          // Delete accomodation
          $('body').on('click', '#deleteAccomodation', function() {

           var accomodation_id = $(this).data('accomodation-id');
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
                    url: "/shelters/" + shelter_id + "/accomodations/"+ accomodation_id,
                    data: {_token: '{{csrf_token()}}'},
                    dataType: 'JSON',
                    success: function (results) {
                      window.location= "/shelters/" + shelter_id + "/accomodations/"
                    }
                });

              } else {
                e.dismiss;
              }

              }, function (dismiss) {
              return false;
              })
          });
});
</script>
@endpush