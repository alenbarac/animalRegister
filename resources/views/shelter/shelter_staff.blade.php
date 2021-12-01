@extends('layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<ul class="nav shelter-nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelter.show', $shelter->id) }}">Oporavilište</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ route('shelter.shelter_staff', $shelter->id) }}">Odgovorne osobe</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.accomodations.index', [$shelter->id]) }}">Smještajne jedinice</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.nutritions.index', [$shelter->id]) }}">Hranjenje životinja</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.equipments.index', [$shelter->id]) }}">Oprema, transport</a>
  </li>

</ul>

    <div class="d-flex align-items-center justify-content-between">
      <div> <h5 class="mb-3 mb-md-0">{{ $shelter->name }}</h5></div>
      <div>      
          <a href="javascript:void(0)" class="btn btn-primary btn-icon-text" data-toggle="modal" 
          data-target="#createStaffModal" type="button" class="btn btn-primary btn-icon-text">
            Pravna osoba
            <i class="btn-icon-append" data-feather="user-plus"></i>
          </a>
    
          <a type="button" class="btn btn-warning btn-icon-text" data-toggle="modal" 
          data-target="#createCareStaffModal">
            Osoba - skrb životinja
            <i class="btn-icon-append" data-feather="user-plus"></i>
          </a>
    
          <a type="button" class="btn btn-info btn-icon-text" data-toggle="modal" data-target="#createVetStaffModal">
            Pružatelj veterinarske usluge
            <i class="btn-icon-append" data-feather="plus-circle"></i>
          </a>               
      </div>
    </div>


    <div class="row mt-4">
      <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body ">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-title">Pravno Odgovorna osoba </h6>        
            </div>
            <div>
              @if ($shelterLegalStaff)
              <button type="button" class="btn btn-primary btn-icon"  data-id="{{ $shelterLegalStaff->id ?? ''  }}"  data-toggle="modal" data-target="#editStaffLegalModal">
                <i data-feather="check-square"></i>
              </button>        
                <button type="button" id="deleteLegalStaff" type="button" class="btn btn-danger btn-icon" 
                data-id="{{ $shelterLegalStaff->id ?? ''  }}">
                  <i data-feather="box"></i>
                </button>
                @endif       
            </div>
          </div> 
          <div class="row">
         
            <div class="col-md-4 grid-margin">  
             
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Ime i prezime: </label>
                <p class="text-muted">{{ $shelterLegalStaff->name ?? '' }}</p>
              </div>
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">OIB:</label>
                <p class="text-muted">{{ $shelterLegalStaff->oib ?? '' }}</p>
              </div>
    
               
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Adresa prebivališta:</label>
                <p class="text-muted">{{ $shelterLegalStaff->address ?? '' }}</p>
              </div>                     
            </div> 
    
            <div class="col-md-4 grid-margin">
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Adresa Boravišta</label>
                <p class="text-muted">{{ $shelterLegalStaff->address_place ?? '' }}</p>
              </div> 
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Telefon:</label>
                <p class="text-muted">{{ $shelterLegalStaff->phone ?? '' }}</p>
              </div>
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Mobitel: </label>
                <p class="text-muted">{{ $shelterLegalStaff->phone_cell ?? '' }}</p>
              </div>
                  
            </div> 
            <div class="col-md-4 grid-margin">
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                <p class="text-muted">{{ $shelterLegalStaff->email ?? '' }}</p>
              </div>
    
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Uvjerenje protiv kaznenog postupka:</label>        
                  <div class="d-md-block mt-2">
                      @if ($fileLegal)
                      <i data-feather="paperclip" class="text-muted"></i> <a href="{{ $fileLegal->getUrl() }}"> {{ $fileLegal->file_name }}  </a>
                      @endif     
                  </div>
              </div>
            </div>       
          </div>       
        </div>
      </div> 
    
      <div class="card mt-4">
        <div class="card-body ">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-title">Osoba odgovorna za skrb životinja</h6>        
            </div>
            <div>
              @if ($shelterCareStaff)
              <button type="button" class="btn btn-primary btn-icon"  data-id="{{ $shelterCareStaff->id ?? ''  }}"  data-toggle="modal" data-target="#editStaffCareModal">
                <i data-feather="check-square"></i>
              </button>        
                <button type="button" id="deleteCareStaff" type="button" class="btn btn-danger btn-icon" 
                data-id="{{ $shelterCareStaff->id ?? ''  }}">
                  <i data-feather="box"></i>
                </button>
                @endif       
            </div>
          </div> 
          <div class="row">
            <div class="col-md-4 grid-margin">   
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Ime i prezime: </label>
                <p class="text-muted">{{ $shelterCareStaff->name ?? '' }}</p>
              </div>
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">OIB:</label>
                <p class="text-muted">{{ $shelterCareStaff->oib ?? '' }}</p>
              </div>
    
               
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Adresa prebivališta:</label>
                <p class="text-muted">{{ $shelterCareStaff->address ?? '' }}</p>
              </div>                     
            </div> 
    
            <div class="col-md-4 grid-margin">
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Adresa Boravišta</label>
                <p class="text-muted">{{ $shelterCareStaff->address_place ?? '' }}</p>
              </div> 
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Telefon:</label>
                <p class="text-muted">{{ $shelterCareStaff->phone ?? '' }}</p>
              </div>
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Mobitel: </label>
                <p class="text-muted">{{ $shelterCareStaff->phone_cell ?? '' }}</p>
              </div>
                  
            </div> 
            <div class="col-md-4 grid-margin">
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                <p class="text-muted">{{ $shelterCareStaff->email ?? '' }}</p>
              </div>
    
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Stručna sprema i struka:</label>
                <p class="text-muted">{{ $shelterCareStaff->education ?? '' }}</p>
              </div>
    
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kopija ugovora o radu ili drugog sporazuma:</label>        
                  <div class="d-md-block mt-2">
                      @if ($fileContract)
                      <i data-feather="paperclip" class="text-muted"></i> <a href="{{ $fileContract->getUrl() }}"> {{ $fileContract->file_name }}  </a>
                      @endif     
                  </div>
              </div>
            </div>  
            
            <div class="col-md-4 grid-margin">
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Dokaz o odgovarajućoj osposobljenosti:</label>        
                  <div class="d-md-block mt-2">
                      @if ($fileCertificate)
                      <i data-feather="paperclip" class="text-muted"></i> <a href="{{ $fileCertificate->getUrl() }}"> {{ $fileCertificate->file_name }}  </a>
                      @endif     
                  </div>
              </div>
            </div>
            
          </div>       
        </div>
      </div> 
    
    
      <div class="card mt-4">
        <div class="card-body ">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-title">Podaci o pružatelju veterinarske usluge</h6>        
            </div>
            <div>
              @if ($shelterVetStaff)
                @if ($fileVetAmbulance )
                <button type="button" class="btn btn-primary btn-icon"  data-id="{{ $shelterVetStaff->id ?? ''  }}"  data-toggle="modal" data-target="#editAmbulanceModal">
                  <i data-feather="check-square"></i>
                </button> 
                @else
                <button type="button" class="btn btn-primary btn-icon"  data-id="{{ $shelterVetStaff->id ?? ''  }}"  data-toggle="modal" data-target="#editVetStaffModal">
                  <i data-feather="check-square"></i>
                </button> 
                @endif
               
                <button type="button" id="deleteVetStaff" type="button" class="btn btn-danger btn-icon" 
                data-id="{{ $shelterVetStaff->id ?? ''  }}">
                  <i data-feather="box"></i>
                </button>
                @endif       
            </div>
          </div> 
          <div class="row">
            <div class="col-md-4 grid-margin">   
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Ime i prezime/Naziv ustanove: </label>
                <p class="text-muted">{{ $shelterVetStaff->name ?? '' }}</p>
              </div>
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">OIB:</label>
                <p class="text-muted">{{ $shelterVetStaff->oib ?? '' }}</p>
              </div>
    
               
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Adresa prebivališta:</label>
                <p class="text-muted">{{ $shelterVetStaff->address ?? '' }}</p>
              </div>                     
            </div> 
    
            <div class="col-md-4 grid-margin">
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Adresa Boravišta</label>
                <p class="text-muted">{{ $shelterVetStaff->address_place ?? '' }}</p>
              </div> 
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Telefon:</label>
                <p class="text-muted">{{ $shelterVetStaff->phone ?? '' }}</p>
              </div>
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Mobitel: </label>
                <p class="text-muted">{{ $shelterVetStaff->phone_cell ?? '' }}</p>
              </div>
                  
            </div> 
            <div class="col-md-4 grid-margin">
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Email:</label>
                <p class="text-muted">{{ $shelterVetStaff->email ?? '' }}</p>
              </div>
    
              @if ($fileVetContract)
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kopija ugovora o radu ili drugog sporazuma:</label>        
                  <div class="d-md-block mt-2">        
                      <i data-feather="paperclip" class="text-muted"></i> <a href="{{ $fileVetContract->getUrl() }}"> {{ $fileVetContract->file_name }}  </a>             
                  </div>
              </div>
              @endif 
    
              @if ($fileVetDiploma)
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kopija diplome doktora:</label>        
                  <div class="d-md-block mt-2">            
                      <i data-feather="paperclip" class="text-muted"></i> <a href="{{ $fileVetDiploma->getUrl() }}"> {{ $fileVetDiploma->file_name }}  </a>             
                  </div>
              </div>
              @endif
    
              @if ($fileVetAmbulance)
              <div class="mt-2">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Kopija ugovora ili drugog sporazuma - vanjski pružatelj usluge</label>        
                  <div class="d-md-block mt-2">        
                      <i data-feather="paperclip" class="text-muted"></i> <a href="{{ $fileVetAmbulance->getUrl() }}"> {{ $fileVetAmbulance->file_name }}  </a>            
                  </div>
              </div>
              @endif 
            </div>  
       
          </div>       
        </div>
      </div>
    
    
    </div>
    </div> 
  
    <!-- end row -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">  
        <div class="card rounded">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="card-title">Ostale osobe za skrb životinja</h6>        
                </div>
                <div>        
                  <a type="button" class="btn btn-info btn-icon-text" data-toggle="modal" data-target="#createPersonelStaffModal">
                    Dodaj<i class="btn-icon-append" data-feather="user-plus"></i>
                  </a>                      
                </div>
              </div> 
              
                <div class="table-responsive mt-4">
                  <table class="table">
                      <thead>
                      <tr>
                          <th>Ime  i prezime</th>
                          <th>OIB</th>
                          <th>Adresa Prebivališta</th>
                          <th>Adresa boravišta</th>
                          <th>Telefon</th>
                          <th>Mobitel</th>
                          <th>Email</th>
                          <th>Stručna sprema</th>
                          <th>Akcija</th>
                      </tr>
                      </thead>
                      <tbody>
                        @if ($shelterPersonelStaff)
                        
                        @foreach($shelterPersonelStaff as $staff)   
                        <tr>
                          <td>{{ $staff->name }}</td>
                          <td>{{ $staff->oib }}</td>
                          <td>{{ $staff->address }}</td>
                          <td>{{ $staff->address_place }}</td>
                          <td>{{ $staff->phone }}</td>
                          <td>{{ $staff->phone_cell }}</td>
                          <td>{{ $staff->email }}</td>
                          <td>{{ $staff->education }}</td>
                        
                          <td><button type="button" class="btn btn-primary btn-icon"  data-id="{{ $staff->id ?? ''  }}"  data-toggle="modal" data-target="#editStaffPersonelModal">
                            <i data-feather="check-square"></i>
                          </button>        
                          <button type="button" id="deletePersonelStaff" type="button" class="btn btn-danger btn-icon" 
                            data-id="{{ $staff->id ?? ''  }}">
                              <i data-feather="box"></i>
                            </button></td>
                        </tr>
                        @endforeach
                      
                        @endif
                      </tbody>
                  </table>
                </div>          
                  
            </div>
          </div>
        </div> 
    </div>
  
  

{{-- Create Legal Staff Modal --}}
@include('shelter.shelter_staff_legal._create')

{{-- Update Legal Staff Modal --}}
@include('shelter.shelter_staff_legal._update')

{{-- Create Care Staff Modal --}}
@include('shelter.shelter_staff_care._create')
{{-- Update Legal Staff Modal --}}
@include('shelter.shelter_staff_care._update')

{{-- Create Vet Staff Modal --}}
@include('shelter.shelter_staff_vet._create')

{{-- Update Vet Staff Modals --}}
@include('shelter.shelter_staff_vet._update')
@include('shelter.shelter_staff_vet._update-ambulance')

{{-- Create Personel Staff Modal --}}
@include('shelter.shelter_staff_personel._create')
{{-- Update Personel Staff Modal --}}
@include('shelter.shelter_staff_personel._update')


@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/file-upload.js') }}"></script>

<script>

      $(function() {
           
        // Create Legal Shelter Staff Ajax request.
        $('#createLegalStaff').on('submit', function(e) {
          e.preventDefault();

          var legalForm = this;
          var alertDanger = $('#dangerLegalStaffCreate');
          var alertSuccess = $('#successLegalStaffCreate');
        
          $.ajax({
              url: $(legalForm).attr('action'),
              method: 'POST',
              data: new FormData(legalForm),
              processData: false,
              dataType: 'json',
              contentType: false,

              success: function(result) {
                console.log(result);
                
                  if(result.errors) {
                      alertDanger.html('');
                      console.log(result);
                      $.each(result.errors, function(key, value) {
                          alertDanger.show();
                          alertDanger.append('<strong><li>'+value+'</li></strong>');
                      });
                  } else {
                      alertDanger.hide();
                      alertSuccess.show();
      
                      setInterval(function(){ 
                          alertSuccess.hide();
                          $('#createStaffLegalModal').modal('hide');
                          location.reload();
                      }, 2000);
                  }
              }
          });
        });
        
        // Update Legal Shelter Staff Ajax request.
        $('#updateLegalStaff').on('submit', function(e) {
            e.preventDefault();
            var updateLegalForm = this;
            var alertDanger = $('#dangerLegalStaffUpdate');
            var alertSuccess = $('#successLegalStaffUpdate');
          
            $.ajax({
                url: $(updateLegalForm).attr('action'),
                method: 'POST',
                data: new FormData(updateLegalForm),
                processData: false,
                dataType: 'json',
                contentType: false,

                success: function(result) {
                console.log(result);
                  
                    if(result.errors) {
                        alertDanger.html('');
                        console.log(result);
                        $.each(result.errors, function(key, value) {
                            alertDanger.show();
                            alertDanger.append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                    
                        alertDanger.hide();
                        alertSuccess.show();
        
                        setInterval(function(){ 
                            alertDanger.hide();
                            $('#editStaffLegalModal').modal('hide');
                            location.reload();
                            console.log(result);
                        }, 2000);
                    }
                }
            });
        });

        // Delete legal Staff
        $('body').on('click', '#deleteLegalStaff', function() {

          deleteID = $(this).data('id');
          
          Swal.fire({
              title: "Brisanje?",
              text: "Potvrdite ako ste sigurni za brisanje Osobe!",
              type: "warning",
              showCancelButton: !0,
              confirmButtonText: "Da, brisanje!",
              cancelButtonText: "Ne, odustani!",
              reverseButtons: !0
          }).then(function (e) {
              if (e.value === true) {           
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            
                });
                $.ajax({
                    type: 'DELETE',
                    url: "{{url('/shelter_legal_staff')}}/" + deleteID,
                    data: {_token: '{{csrf_token()}}'},
                    dataType: 'JSON',
                    success: function (results) {
                        location.reload();
                    }
                });
              } else {
                e.dismiss;
              }

          }, function (dismiss) {
              return false;
          })
        });

            // Create Care Staff
            $('#createCareStaff').on('submit', function(e) {
              e.preventDefault();

              var careForm = this;
              var alertDanger = $('#dangerCareStaffCreate');
              var alertSuccess = $('#successCareStaffCreate');
            
              $.ajax({
                  url: $(careForm).attr('action'),
                  method: 'POST',
                  data: new FormData(careForm),
                  processData: false,
                  dataType: 'json',
                  contentType: false,

                  success: function(result) {
                    console.log(result);
                  
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
                            $('.alert-success').hide();
                            $('#createStaffCareModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                  }
              });
            });

            // Update Legal Shelter Staff Ajax request.
            $('#updateCareStaff').on('submit', function(e) {
              e.preventDefault();
              var updateCareForm = this;
              var alertDanger = $('#dangerCareStaffUpdate');
              var alertSuccess = $('#successCareStaffUpdate');
            
              $.ajax({
                  url: $(updateCareForm).attr('action'),
                  method: 'POST',
                  data: new FormData(updateCareForm),
                  processData: false,
                  dataType: 'json',
                  contentType: false,

                  success: function(result) {
                  console.log(result);
                    
                      if(result.errors) {
                          alertDanger.html('');
                          console.log(result);
                          $.each(result.errors, function(key, value) {
                              alertDanger.show();
                              alertDanger.append('<strong><li>'+value+'</li></strong>');
                          });
                      } else {
                      
                          alertDanger.hide();
                          alertSuccess.show();
          
                          setInterval(function(){ 
                              alertDanger.hide();
                              $('#editStaffCareModal').modal('hide');
                              console.log(result)
                              location.reload();
                              ;
                          }, 2000);
                      }
                  }
              });
            });

            // Delete care Staff
            $('body').on('click', '#deleteCareStaff', function() {

              deleteID = $(this).data('id');

              Swal.fire({
                  title: "Brisanje?",
                  text: "Potvrdite ako ste sigurni za brisanje Osobe!",
                  type: "warning",
                  showCancelButton: !0,
                  confirmButtonText: "Da, brisanje!",
                  cancelButtonText: "Ne, odustani!",
                  reverseButtons: !0
              }).then(function (e) {

              if (e.value === true) {
                              
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }

              });
                $.ajax({
                    type: 'DELETE',
                    url: "{{url('/shelter_legal_staff')}}/" + deleteID,
                    data: {_token: '{{csrf_token()}}'},
                    dataType: 'JSON',
                    success: function (results) {
                        location.reload();
                    }
                });

              } else {
                e.dismiss;
              }

              }, function (dismiss) {
              return false;
              })
            });

            // Vet Staff - show fields
            $('.staff_vet_type').click(function(){
              var inputValue = $(this).attr("value");
              var targetBox = $("." + inputValue);
              $(".staff_form_group").not(targetBox).hide();
              $(targetBox).show();
            });

            // Create VET Shelter Staff Ajax request.
            $('#createVetStaff').on('submit', function(e) {
                      e.preventDefault();

                      var vetForm = this;
                      var alertDanger = $('#dangerVetStaffCreate');
                      var alertSuccess = $('#successVetStaffCreate');
                    
                      $.ajax({
                          url: $(vetForm).attr('action'),
                          method: 'POST',
                          data: new FormData(vetForm),
                          processData: false,
                          dataType: 'json',
                          contentType: false,

                          success: function(result) {
                            console.log(result);
                            
                              if(result.errors) {
                                  alertDanger.html('');
                                  console.log(result);
                                  $.each(result.errors, function(key, value) {
                                      alertDanger.show();
                                      alertDanger.append('<strong><li>'+value+'</li></strong>');
                                  });
                              } else {
                                  alertDanger.hide();
                                  alertSuccess.show();
                  
                                  setInterval(function(){ 
                                      alertSuccess.hide();
                                      $('#createVetStaffModal').modal('hide');
                                      location.reload();
                                  }, 2000);
                              }
                          }
                      });
                });

                // Update Ambulance Shelter Staff Ajax request.
                $('#updateAmbulanceStaff').on('submit', function(e) {
                    e.preventDefault();
                    var updateAmbulanceForm = this;
                    var alertDanger = $('#dangerAmbulanceUpdate');
                    var alertSuccess = $('#successAmbulanceUpdate');
                  
                    $.ajax({
                        url: $(updateAmbulanceForm).attr('action'),
                        method: 'POST',
                        data: new FormData(updateAmbulanceForm),
                        processData: false,
                        dataType: 'json',
                        contentType: false,

                        success: function(result) {
                        console.log(result);
                          
                            if(result.errors) {
                                alertDanger.html('');
                                console.log(result);
                                $.each(result.errors, function(key, value) {
                                    alertDanger.show();
                                    alertDanger.append('<strong><li>'+value+'</li></strong>');
                                });
                            } else {
                            
                                alertDanger.hide();
                                alertSuccess.show();
                
                                setInterval(function(){ 
                                    alertDanger.hide();
                                    $('#editAmbulanceModal').modal('hide');
                                    location.reload();
                                    console.log(result);
                                }, 2000);
                            }
                        }
                    });
                });


                 // Update Vet Shelter Staff Ajax request.
                 $('#updateVetStaff').on('submit', function(e) {
                    e.preventDefault();
                    var updateVetForm = this;
                    var alertDanger = $('#dangerVetStaffUpdate');
                    var alertSuccess = $('#successVetStaffUpdate');
                  
                    $.ajax({
                        url: $(updateVetForm).attr('action'),
                        method: 'POST',
                        data: new FormData(updateVetForm),
                        processData: false,
                        dataType: 'json',
                        contentType: false,

                        success: function(result) {
                        console.log(result);
                          
                            if(result.errors) {
                                alertDanger.html('');
                                console.log(result);
                                $.each(result.errors, function(key, value) {
                                    alertDanger.show();
                                    alertDanger.append('<strong><li>'+value+'</li></strong>');
                                });
                            } else {
                            
                                alertDanger.hide();
                                alertSuccess.show();
                
                                setInterval(function(){ 
                                    alertDanger.hide();
                                    $('#editVetStaffModal').modal('hide');
                                    location.reload();
                                    console.log(result);
                                }, 2000);
                            }
                        }
                    });
                });

                    // Delete care Staff
            $('body').on('click', '#deleteVetStaff', function() {

                deleteID = $(this).data('id');

                Swal.fire({
                    title: "Brisanje?",
                    text: "Potvrdite ako ste sigurni za brisanje Osobe!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Da, brisanje!",
                    cancelButtonText: "Ne, odustani!",
                    reverseButtons: !0
                }).then(function (e) {

                if (e.value === true) {
                                
                  $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                });
                  $.ajax({
                      type: 'DELETE',
                      url: "{{url('/shelter_vet_staff')}}/" + deleteID,
                      data: {_token: '{{csrf_token()}}'},
                      dataType: 'JSON',
                      success: function (results) {
                          location.reload();
                      }
                  });

                } else {
                  e.dismiss;
                }

                }, function (dismiss) {
                return false;
                })
            });

                // Create Personel Shelter Staff Ajax request.
                $('#createPersonelStaff').on('submit', function(e) {
                e.preventDefault();

                var personelForm = this;
                var alertDanger = $('#dangerPersonelStaffCreate');
                var alertSuccess = $('#successPersonelStaffCreate');
                    
                      $.ajax({
                          url: $(personelForm).attr('action'),
                          method: 'POST',
                          data: new FormData(personelForm),
                          processData: false,
                          dataType: 'json',
                          contentType: false,

                          success: function(result) {
                            console.log(result);
                            
                              if(result.errors) {
                                  alertDanger.html('');
                                  console.log(result);
                                  $.each(result.errors, function(key, value) {
                                      alertDanger.show();
                                      alertDanger.append('<strong><li>'+value+'</li></strong>');
                                  });
                              } else {
                                  alertDanger.hide();
                                  alertSuccess.show();
                  
                                  setInterval(function(){ 
                                      alertSuccess.hide();
                                      $('#createVetStaffModal').modal('hide');
                                      location.reload();
                                  }, 2000);
                              }
                          }
                      });
                });

                // Update Personel Shelter Staff Ajax request.
              $('#updatePersonelStaff').on('submit', function(e) {
                e.preventDefault();
                var updatePersonelForm = this;
                var alertDanger = $('#dangerPersonelStaffUpdate');
                var alertSuccess = $('#successPersonelStaffUpdate');
              
                $.ajax({
                    url: $(updatePersonelForm).attr('action'),
                    method: 'POST',
                    data: new FormData(updatePersonelForm),
                    processData: false,
                    dataType: 'json',
                    contentType: false,

                    success: function(result) {
                    console.log(result);
                      
                        if(result.errors) {
                            alertDanger.html('');
                            console.log(result);
                            $.each(result.errors, function(key, value) {
                                alertDanger.show();
                                alertDanger.append('<strong><li>'+value+'</li></strong>');
                            });
                        } else {
                        
                            alertDanger.hide();
                            alertSuccess.show();
            
                            setInterval(function(){ 
                                alertDanger.hide();
                                $('#editStaffPersonelModal').modal('hide');
                                console.log(result)
                                location.reload();
                                ;
                            }, 2000);
                        }
                    }
                });
            });

            // Delete legal Staff
            $('body').on('click', '#deletePersonelStaff', function() {

              deleteID = $(this).data('id');

              Swal.fire({
                  title: "Brisanje?",
                  text: "Potvrdite ako ste sigurni za brisanje Osobe!",
                  type: "warning",
                  showCancelButton: !0,
                  confirmButtonText: "Da, brisanje!",
                  cancelButtonText: "Ne, odustani!",
                  reverseButtons: !0
              }).then(function (e) {

              if (e.value === true) {
                              
                $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }

              });
                $.ajax({
                    type: 'DELETE',
                    url: "{{url('/shelter_personel_staff')}}/" + deleteID,
                    data: {_token: '{{csrf_token()}}'},
                    dataType: 'JSON',
                    success: function (results) {
                        location.reload();
                    }
                });

              } else {
                e.dismiss;
              }

              }, function (dismiss) {
              return false;
              })
            });

         })
     
  </script>
 
@endpush