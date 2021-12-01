@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="d-flex align-items-center justify-content-between mb-3">
    <div> <h5 class="mb-3 mb-md-0">{{ $animalItem->shelter->name }}</h5></div>
    <div>      
       <a href="/shelters/{{ $animalItem->shelter_id }}/animal_groups/{{ $animalItem->animal_group_id }}" type="button" class="btn btn-primary btn-sm btn-icon-text">
          Povratak na popis
          <i class="btn-icon-append" data-feather="clipboard"></i>
        </a> 
        
        <a href="/shelters/{{ $animalItem->shelter_id }}/animal_groups/{{ $animalItem->animal_group_id }}" type="button" class="btn btn-warning btn-sm btn-icon-text">
          Premještaj jedinke
          <i class="btn-icon-append" data-feather="clipboard"></i>
        </a> 
        <a href="/shelters/{{ $animalItem->shelter_id }}/animal_groups/{{ $animalItem->animal_group_id }}" type="button" class="btn btn-info btn-sm btn-icon-text">
          Izvještaj jedinke
          <i class="btn-icon-append" data-feather="clipboard"></i>
        </a> 
    </div>
  </div>





    <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
          {{ $animalItem->animal->name }} - {{ $animalItem->animal->latin_name }}
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          Dokumentacija
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          Nalaznik
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          Izračun skrbi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          Eutanazija
        </a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row mt-4">

          <div class="col-md-5">
            <div class="card">
              <div class="card-body">
                <div class="row inbox-wrapper">
              
                  <div class="col-lg-12 email-content">
                    <div class="email-inbox-header">
                      <div class="row justify-content-between">           
                          <div class="email-title mb-2 mb-md-0"><span class="icon"><i data-feather="book"></i></span> Postupak postupanja u oporavilištu</div>  
                          <div>
                          <a href="{{ route('animal_items.animal_item_logs.create', $animalItem->id) }}" type="button" class="btn btn-primary btn-sm btn-icon-text">                
                                Dodaj zapis
                                <i class="btn-icon-append" data-feather="book"></i>
                              </a> 
                          </div>
                       
                      </div>
                    </div>
                    <div class="separator--small"></div>
               
                    <div class="email-list"> 
                       @foreach ($animalItem->animalItemLogs as $itemlLog)
                      <div class="email-list-item">
                 
                        <a href="{{ route('animal_items.animal_item_logs.show', [$animalItem->id, $itemlLog->id]) }}" class="email-list-detail">
                          <div>
                            <span class="from">{{  $itemlLog->log_subject }}</span>
                            <p class="msg">{{ $itemlLog->logType->type_name }} </p>
                          </div>
                          <div class="justify-content-between"> 
                          <span class="date">                        
                            {{ $itemlLog->created_at->format('d.m.Y.') }}
                          </span>
                          <a href="{{ route('animal_items.animal_item_logs.show', [$animalItem->id, $itemlLog->id]) }}" class="btn btn-warning btn-xs mt-1">
                              pregled
                           </a> 
                          </div>
                        </a>
                      </div>
                      @endforeach             
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        
          <div class="col-md-7 grid-margin">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  <div><h6 class="card-title">Podaci o zaprimanju</h6> </div> 
                  <a href="#" class="btn btn-primary btn-icon-text btn-sm" type="button">
                    Izmjeni podatke
                    <i class="btn-icon-append" data-feather="box"></i>
                  </a>
                </div> 
                @if($msg = Session::get('update_animal_item'))
                <div id="successMessage" class="alert alert-success"> {{ $msg }}</div>
                @endif      
                  <div class="row">
                    <div class="col-md-4 grid-margin">    
                        <div class="mt-2">
                          <label class="tx-11 font-weight-bold mb-0 text-uppercase">Naziv vrste: </label>
                          <p class="text-muted">{{ $animalItem->animal->name }}</p>
                        </div>
                        <div class="mt-2">
                          <label class="tx-11 font-weight-bold mb-0 text-uppercase">Latinski naziv:</label>
                          <p class="text-muted">{{ $animalItem->animal->latin_name ?? ''  }}</p>
                        </div>
                        <div class="mt-2">
                          <label class="tx-11 font-weight-bold mb-0 text-uppercase">Datum pronalaska:</label>
                          <p class="text-muted">{{ $animalItem->animal_date_found ?? '' }}</p>
                        </div>
          
                    </div> 
        
                    <div class="col-md-4 grid-margin">
                      
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Lokacija pronalaska: </label>
                        <p class="text-muted">{{ $animalItem->location ?? '' }}</p>
                      </div>
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Nalaznik: </label>
                        <p class="text-muted">{{ $animalItem->founder->name }} - {{ $animalItem->founder->service }}</p>
                      </div>
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Napomena nalaznika: </label>
                        <p class="text-muted">{{ $animalItem->founder_note }}</p>
                      </div>
                    </div>  
                    
                    <div class="col-md-4 grid-margin">    
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Spol:</label>
                        <p class="text-muted">{{ $animalItem->animal_gender ?? '' }}</p>
                      </div>
      
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Veličina:</label>
                        <p class="text-muted">{{ $animalItem->animalSizeAttributes->name ?? '' }}</p>
                      </div>
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Dob Jedinke:</label>
                        <p class="text-muted">{{ $animalItem->animal_age ?? '' }}</p>
                      </div>           
                  </div>     
                </div>   
                  <div class="row">
                    <div class="separator"></div>
                  </div> 
                  <div class="row">                 
            
                    <div class="col-md-4 grid-margin">  
                      
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Status jedinke:</label>
                        <p class="text-muted">U oporavilištu</p>
                      
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Način Držanja:</label>
                        <p class="text-muted">{{ $animalItem->solitary_or_group ?? '' }}</p>
                      </div>             
                    </div> 
                    <div class="col-md-4 grid-margin">
                      <label class="tx-11 font-weight-bold mb-0 text-uppercase">Oznaka jedinke:</label>
                     {{--  <p class="text-muted">{{ $animalItem->animalMarks->first()->animalMarkType->name }}</p> --}}
                      <div class="mt-2">
                        <label class="tx-11 font-weight-bold mb-0 text-uppercase">Naziv oznake:</label>
                       {{--  <p class="text-muted">{{ $animalItem->animalMarks->last()->animal_mark_note }}</p> --}}
                      </div>
                    </div> 
                    <div class="col-md-4 grid-margin">
                     {{--  @foreach ($animalItem->animalMarks->media as $thumbnail) 
                      
                        <a href="{{ $thumbnail->getUrl() }}" data-lightbox="equipment">
                        <figure>
                          <img class="img-fluid" src="{{ $thumbnail->getUrl() }}" alt="">
                        </figure>
                        </a>
                       
                      @endforeach --}}
                    </div>
                  </div>     
              </div>
            </div>    
          </div>
        
        
          
        </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
          <div class="col-md-6">
            <div class="card rounded grid-margin">
              <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                      <h6 class="card-title mb-0">Dokumenti</h6>
                  </div>
        
              </div>
          </div>
          </div>
          <div class="col-md-6">
            <div class="card rounded grid-margin">
                <div class="card-body">
                    <p>Stanje u trenutku zaprimanja u oporavilište</p>
        
                    <div class="d-flex align-items-center flex-wrap">
                  
                    </div>
        
                    <p>Stanje u kojem je zaplijena pronađena</p>            
                        <div class="d-flex align-items-center flex-wrap">
                        </div>
                </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
 
<!-- Modal -->
<button type="button" id="openModal" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModalCenter">
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form id="changeShelterForm" action="" method="POST">
                    @csrf
                    @method('POST')
        
                    <div class="form-group">
                        <h6>Oporavilište u kojem se nalazi:</h6>
                       {{--  <span>{{ $animalItem->first()->shelter->name }}</span> --}}
                    </div>
                    <input type="hidden" name="animal_id" id="animal_id">
                    <input type="hidden" name="shelter_code" id="shelterCode">

                    <select id="shelter_id" name="shelter_id">
                        <option value="">Odaberite oporavilište</option>
                       {{--  @foreach ($shelters as $shelter)
                            @if ($animalItem->first()->shelter->id != $shelter->id)
                                <option value="{{$shelter->id}}">{{$shelter->name}}</option>
                            @endif
                        @endforeach --}}
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
        <button type="button" id="save" class="btn btn-primary">Ažuriraj</button>
    </div>
    </div>
</div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    

    <script>
        $(function() {
            // Premjestaj
            $(".premjesti").click(function(){
                $("#openModal").trigger('click');

                id = $(this).attr("data-id");

                $.get( "/animal_item/getId/" + id, function( data ) {
                    console.log(data)
                    $('#changeShelterForm').attr('action', '/animal_item/changeShelter/'+id);
                    $('#animal_id').val(data.animal_id);
                    $('#shelterCode').val(data.shelter_code);
                });
                
            });

            $("#save").click(function(){
                $("#changeShelterForm").submit();
            });
        })
    </script>

    <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush