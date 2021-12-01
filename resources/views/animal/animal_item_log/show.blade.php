@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div> <h5 class="mb-3 mb-md-0">{{ $animalItem->shelter->name }}</h5></div>

  <div>      
    <a href="/shelters/{{ $animalItem->shelter_id }}/animal_groups/{{ $animalItem->animal_group_id }}/animal_items/{{ $animalItem->id }}" type="button" class="btn btn-warning btn-sm btn-icon-text">
       Povratak na jedinku
       <i class="btn-icon-append" data-feather="clipboard"></i>
       
     </a> 
  </div>

</div>
<div class="row"><div class="separator separator--small"></div></div>

<div class="d-flex align-items-center justify-content-between mt-3">
  <h5 class="mb-3 mb-md-0">Zapis postupka</h5>
  <div>      
    <a id="createAccomodation" href="{{ route('animal_items.animal_item_logs.create', $animalItem->id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text">
      Dodaj novi zapis
      <i class="btn-icon-append" data-feather="user-plus"></i>
    </a>                  
  </div>
</div>
@if($animalItemLog)
<div class="row inbox-wrapper mt-3">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 email-aside border-lg-right">
            <div class="aside-content">
              <div class="aside-header">
               <span class="title">{{ $animalItemLog->logType->type_name }}</span>
              {{--  <p class="description mt-3"><span class="text-secondary">Numeracija: </span> {{ $shelterAccomodationItem->accommodationType->type_mark  }}</p>
                <p class="description mt-3"><span class="text-secondary">Opis oznake: </span> {{ $shelterAccomodationItem->accommodationType->type_description  }}</p> --}}
              </div>
              
              <div class="aside-nav collapse">
            
                <span class="title">Akcije</span>
                <ul class="nav nav-pills nav-stacked">
                  <li>
                    <a href="{{ route('animal_items.animal_item_logs.edit', [$animalItem->id, $animalItemLog->id]) }}"><i data-feather="tag" class="text-warning"></i> Izmjeni zapis</a>
                  </li>
                  <li><a href="/shelters/{{ $animalItem->shelter_id }}/animal_groups/{{ $animalItem->animal_group_id }}/animal_items/{{ $animalItem->id }}">
                    <i data-feather="tag" class="text-primary"></i> Povratak na zapise</a>
                  </li>
                  <li>
                    <a id="deleteAnimalLog" href="#" data-item-id="{{ $animalItem->id }}" data-log-id="{{ $animalItemLog->id  }}"> <i data-feather="tag" class="text-danger"></i> Brisanje zapisa</a>
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
                    <span class="text-secondary">Predmet postupanja: </span>
                    <span class="ml-2"> {{ $animalItemLog->log_subject }}</span>
                  </div>         
                </div>
              </div>
         
            </div>
            <div class="email-body">
              <div class="title mb-3"><span class="title text-secondary">Opis postupanja: </span></div>
              {!! $animalItemLog->log_body !!}
            
            </div>
            <div class="email-attachments">
              <span class="title text-secondary">Dokumentacija: </span>
              <div class="latest-photos mt-3">
                <div class="row">
                  @foreach ($animalItemLog->media as $thumbnail) 
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
          $('body').on('click', '#deleteAnimalLog', function() {

           var animal_item_id = $(this).data('item-id');
           var log_id = $(this).data('log-id');

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
                    url: "/animal_items/" + animal_item_id + "/animal_item_logs/"+ log_id,
                    data: {_token: '{{csrf_token()}}'},
                    dataType: 'JSON',
                    success: function (results) {
                      window.location= "/animal_items/" + animal_item_id + "/animal_item_logs/create"
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