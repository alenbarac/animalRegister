<!-- Create Staffs Modal -->
<div id="createStaffModal" class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Dodaj pravno odgovornu osobu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <form id="createLegalStaff" action="{{ route('shelter_legal_staff.store') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
             
                @csrf
                <div id="dangerLegalStaffCreate" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="successLegalStaffCreate" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Uspjeh!</strong> Odogovorna osoba uspješno kreirana.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
      
                <div class="form-group">
                  <label for="name">Ime i prezime</label>
                  <input type="text" class="form-control"  name="staff_legal_name" placeholder="Ime i prezime odgovorne osobe">
                  <input type="hidden" name="shelter_id" value="{{ $shelter->id }}">
                 </div>
  
                <div class="form-group"> 
                  <label for="name">OIB</label>
                  <input type="text" class="form-control" name="staff_legal_oib" placeholder="OIB odgovorne osobe u pravnoj osobi">
                </div>
  
                <div class="form-group"> 
                  <label for="name">Adresa prebivališta</label>
                  <input type="text" class="form-control"  name="staff_legal_address" autocomplete="off" placeholder="adresa prebivališta">
                </div>
                <div class="form-group"> 
                  <label for="name">Adresa boravišta</label>
                  <input type="text" class="form-control"  name="staff_legal_address_place" autocomplete="off" placeholder="Adresa boravišta(ako postoji)">
                </div>
  
                <div class="form-group"> 
                  <label for="name">Kontakt telefon</label>
                  <input type="text" class="form-control" name="staff_legal_phone" autocomplete="off" placeholder="Kontakt telefon">          
                </div>
  
                <div class="form-group"> 
                  <label for="name">Kontakt mobilni telefon</label>
                  <input type="text" class="form-control"  name="staff_legal_phone_cell" autocomplete="off" placeholder="Kontakt mobitel">
                </div>
  
                <div class="form-group">
                  <label for="email">Email adresa</label>
                  <input type="email" class="form-control"  name="staff_legal_email" id="staffEmail" placeholder="Email">
                </div>
  
                <div class="form-group">
                  <label>Uvjerenje - kazneni postupak</label>
                  <input type="file" name="staff_legal_file" class="file-upload-default">
                  <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info"  placeholder="Uvjerenje da se ne vodi kazneni postupak protiv odgovorne osobe">
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