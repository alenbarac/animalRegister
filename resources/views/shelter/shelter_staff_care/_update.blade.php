<!-- Update Staffs Modal -->
<div id="editStaffCareModal" class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Izmjeni pravno odgovornu osobu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <form id="updateCareStaff" action="{{ route('shelter_care_staff.update', $shelterCareStaff->id ?? '') }}" enctype="multipart/form-data">
              
              @method('PUT')
              @csrf
            <div class="modal-body">
              
                <div id="dangerCareStaffUpdate" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="successCareStaffUpdate" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Uspjeh!</strong> Odogovorna osoba uspješno spremljena.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
      
                <div class="form-group">
                  <label for="name">Ime i prezime</label>
                  <input type="text" class="form-control" name="staff_care_name" placeholder="Ime i prezime odgovorne osobe" value="{{ $shelterCareStaff->name ?? '' }}">
                  <input type="hidden"   name="shelter_id" placeholder="Ime i prezime odgovorne osobe" value="{{ $shelter->id ?? '' }}">
                 </div>
  
                <div class="form-group"> 
                  <label for="name">OIB</label>
                  <input type="text" class="form-control" name="staff_care_oib" placeholder="OIB odgovorne osobe u pravnoj osobi" value="{{ $shelterCareStaff->oib ?? '' }}">
                </div>
  
                <div class="form-group"> 
                  <label for="name">Adresa prebivališta</label>
                  <input type="text" class="form-control" name="staff_care_address" autocomplete="off" 
                  placeholder="adresa prebivališta" value="{{ $shelterCareStaff->address ?? '' }}">
                </div>
                <div class="form-group"> 
                  <label for="name">Adresa boravišta</label>
                  <input type="text" class="form-control" name="staff_care_address_place" autocomplete="off" 
                  placeholder="Adresa boravišta(ako postoji)" value="{{ $shelterCareStaff->address_place ?? '' }}">
                </div>
  
                <div class="form-group"> 
                  <label for="name">Kontakt telefon</label>
                  <input type="text" class="form-control" name="staff_care_phone" autocomplete="off" placeholder="Kontakt telefon" value="{{ $shelterCareStaff->phone ?? '' }}">          
                </div>
  
                <div class="form-group"> 
                  <label for="name">Kontakt mobilni telefon</label>
                  <input type="text" class="form-control"  name="staff_care_phone_cell" autocomplete="off" placeholder="Kontakt mobitel" value="{{ $shelterCareStaff->phone_cell ?? '' }}">
                </div>
  
                <div class="form-group">
                  <label for="email">Email adresa</label>
                  <input type="email" class="form-control"  name="staff_care_email" placeholder="Email" value="{{ $shelterCareStaff->email ?? ''}}">
                </div>

                <div class="form-group">
                  <label for="email">Stručna sprema i struka</label>
                  <input type="text" class="form-control"  name="staff_care_education" placeholder="Stručna sprema i struka" value="{{ $shelterCareStaff->education ?? ''}}">
                </div>
  
                <div class="form-group">
                  <label>Kopija ugovora o radu ili drugog sporazuma:</label>
                  <input type="file" name="staff_contract_file" class="file-upload-default">
                  <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info"  placeholder="Kopija ugovora o radu ili drugog sporazuma">
                  <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Učitaj</button>
                  </span>
                  </div>
                </div> 

                <div class="form-group">
                  <label>Dokaz o osposobljenosti</label>
                  <input type="file" name="staff_certificate_file" class="file-upload-default">
                  <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info"  placeholder="Kopija ugovora o radu ili drugog sporazuma vezano za skrb o životinjama">
                  <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Učitaj</button>
                  </span>
                  </div>
                </div> 
            </div>
            
            <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="submitBtn btn btn-warning">Spremi</button>
            <button type="button" class="btn btn-primary modal-close" data-dismiss="modal">Zatvori</button>
          </div>
        </form>
    </div>
  </div>
</div>

