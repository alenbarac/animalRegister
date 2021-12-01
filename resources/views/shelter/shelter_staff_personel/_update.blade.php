<!-- Update Staffs Modal -->
<div id="editStaffPersonelModal" class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Izmjeni pravno odgovornu osobu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <form id="updatePersonelStaff" action="{{ route('shelter_personel_staff.update', $staff->id ?? '') }}" enctype="multipart/form-data">
              
              @method('PUT')
              @csrf
            <div class="modal-body">
              
                <div id="dangerPersonelStaffUpdate" class="alert alert-danger alert-legal-staff alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="successPersonelStaffUpdate" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Uspjeh!</strong>Osoba za skrb životinja uspješno spremljena.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
      
                <div class="form-group">
                  <label for="name">Ime i prezime</label>
                  <input type="text" class="form-control" name="staff_personel_name" placeholder="Ime i prezime odgovorne osobe" value="{{ $staff->name ?? '' }}">
                  <input type="hidden"   name="shelter_id" placeholder="Ime i prezime odgovorne osobe" value="{{ $shelter->id ?? '' }}">
                 </div>
  
                <div class="form-group"> 
                  <label for="name">OIB</label>
                  <input type="text" class="form-control" name="staff_personel_oib" placeholder="OIB odgovorne osobe u pravnoj osobi" value="{{ $staff->oib ?? '' }}">
                </div>
  
                <div class="form-group"> 
                  <label for="name">Adresa prebivališta</label>
                  <input type="text" class="form-control" name="staff_personel_address" autocomplete="off" 
                  placeholder="adresa prebivališta" value="{{ $staff->address ?? '' }}">
                </div>
                <div class="form-group"> 
                  <label for="name">Adresa boravišta</label>
                  <input type="text" class="form-control" name="staff_personel_address_place" autocomplete="off" 
                  placeholder="Adresa boravišta(ako postoji)" value="{{ $staff->address_place ?? '' }}">
                </div>
  
                <div class="form-group"> 
                  <label for="name">Kontakt telefon</label>
                  <input type="text" class="form-control" name="staff_personel_phone" autocomplete="off" placeholder="Kontakt telefon" value="{{ $staff->phone ?? '' }}">          
                </div>
  
                <div class="form-group"> 
                  <label for="name">Kontakt mobilni telefon</label>
                  <input type="text" class="form-control"  name="staff_personel_phone_cell" autocomplete="off" placeholder="Kontakt mobitel" value="{{ $staff->phone_cell ?? '' }}">
                </div>
  
                <div class="form-group">
                  <label for="email">Email adresa</label>
                  <input type="email" class="form-control"  name="staff_personel_email" placeholder="Email" value="{{ $staff->email ?? ''}}">
                </div>

                <div class="form-group">
                  <label for="email">Stručna sprema i struka</label>
                  <input type="text" class="form-control"  name="staff_personel_education" placeholder="Stručna sprema i struka" value="{{ $staff->education ?? ''}}">
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

