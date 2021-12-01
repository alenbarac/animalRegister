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
    <a class="nav-link" href="{{ route('shelters.nutritions.index', $shelter->id) }}">Hranjenje životinja</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ route('shelters.equipments.index', $shelter->id) }}">Oprema, prijevoz oporavilišta</a>
  </li>
</ul>

<div class="d-flex align-items-center justify-content-between">
  <h5 class="mb-3 mb-md-0">Oprema oporavilišta</h5>
  <div>      
    <a id="createEquipment" href="{{ route('shelters.equipments.create', $shelter->id) }}" type="button" class="btn btn-primary btn-icon-text">
      Dodaj opremu oporavilišta
      <i class="btn-icon-append" data-feather="user-plus"></i>
    </a>                  
  </div>
</div>
@if($shelterEquipmentItem)
<div class="row inbox-wrapper mt-3">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 email-aside border-lg-right">
            <div class="aside-content">
              <div class="aside-header">
               <span class="title">{{ $shelterEquipmentItem->equipmentType->name }}</span>
               <p class="description mt-3"><span class="text-secondary">Numeracija: </span> {{ $shelterEquipmentItem->equipmentType->type_mark  }}</p>
                <p class="description mt-3"><span class="text-secondary">Opis oznake: </span> {{ $shelterEquipmentItem->equipmentType->type_description  }}</p>
              </div>
              
              <div class="aside-nav collapse">
            
                <span class="title">Akcije</span>
                <ul class="nav nav-pills nav-stacked">
                  <li>
                    <a href="{{ route('shelters.equipments.edit', [$shelter->id, $shelterEquipmentItem->id]) }}"><i data-feather="tag" class="text-warning"></i> Izmjeni entitet</a>
                  </li>
                  <li><a href="{{ route('shelters.equipments.index', [$shelter->id]) }}">
                    <i data-feather="tag" class="text-primary"></i> Povratak na popis</a>
                  </li>
                  <li>
                    <a id="deleteEquipment" href="#" data-shelter-id="{{ $shelter->id }}" data-equipment-id="{{ $shelterEquipmentItem->id  }}"> <i data-feather="tag" class="text-danger"></i> Brisanje entiteta</a>
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
                    <span class="text-secondary">Naziv entiteta: </span>
                    <span class="ml-2"> {{ $shelterEquipmentItem->equipment_title }}</span>
                  </div>         
                </div>
              </div>
         
            </div>
            <div class="email-body">
              <div class="title mb-3"><span class="title text-secondary">Opis entiteta: </span></div>
              {!! $shelterEquipmentItem->equipment_desc !!}
            
            </div>
            <div class="email-attachments">
              @if ($shelterEquipmentItem->equipmentType->type != 'zbrinjavanje lešina')               
              <span class="title text-secondary">Fotodokumentacija: </span>
                @else  
                <span class="title text-secondary">Dokumentacija: </span>
              @endif
              <div class="latest-photos mt-3">
                <div class="row">
                  @foreach ($shelterEquipmentItem->media as $thumbnail) 
                    @if ($shelterEquipmentItem->equipmentType->type != 'zbrinjavanje lešina')
                    <div class="col-md-2 col-sm-2">
                      <a href="{{ $thumbnail->getUrl() }}" data-lightbox="equipment">
                      <figure>
                        <img class="img-fluid" src="{{ $thumbnail->getUrl() }}" alt="">
                      </figure>
                      </a>
                    </div> 
                      @else                  
                        <i data-feather="paperclip" class="text-muted mr-2"></i> <a href="{{ $thumbnail->getUrl() }}"> {{ $thumbnail->file_name }}</a>       
                    @endif                
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
        // Delete equipment
        $('body').on('click', '#deleteEquipment', function() {

        var equipment_id = $(this).data('equipment-id');
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
            url: "/shelters/" + shelter_id + "/equipments/"+ equipment_id,
            data: {_token: '{{csrf_token()}}'},
            dataType: 'JSON',
            success: function (results) {
              window.location= "/shelters/" + shelter_id + "/equipments/"
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