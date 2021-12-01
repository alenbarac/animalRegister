<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form action="" method="POST" id="founder-form" enctype="multipart/form-data">
            @csrf
            @method('POST')
            
            <div class="modal-body">

                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Uspjeh!</strong> Nalaznik je uspješno spremljen.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    
                <div class="row mt-3">
                    <div class="col-md-12">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Služba koja je izvršila zaplijenu</label>
                                    <select id="sluzba" name="service" class="form-control">
                                        <option value="">------</option>
                                        <option value="Državni inspektorat-inspekcija zaštite prirode">Državni inspektorat-inspekcija zaštite prirode</option>
                                        <option value="Državni inspektorat-veterinarska inspekcija">Državni inspektorat-veterinarska inspekcija</option>
                                        <option value="Ministarstvo unutarnjih poslova">Ministarstvo unutarnjih poslova</option>
                                        <option value="Ministarstvo financija, Carinska uprava">Ministarstvo financija, Carinska uprava</option>
                                        <option value="fizička/pravna osoba">fizička/pravna osoba</option>
                                        <option value="komunalna služba-lokalna i regionalna samouprava">komunalna služba-lokalna i regionalna samouprava</option>
                                        <option value="nepoznato">nepoznato</option>
                                        <option value="djelatnici Javnih ustanova NP/PP ili županija">djelatnici Javnih ustanova NP/PP ili županija</option>
                                        <option value="vlasnik životinje">vlasnik životinje</option>
                                        <option value="ostalo-navesti:">ostalo-navesti:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="ostalo">
                                <div class="form-group">
                                    <label>Ostalo navesti</label>
                                    <input type="text" name="others" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ime</label>
                                    <input type="text" name="name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Prezime</label>
                                    <input type="text" name="lastname" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Adresa</label>
                                    <input type="text" name="address" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Država (prebivališta)</label>
                                    <input type="text" name="country" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kontakt mobitel/telefon</label>
                                    <input type="text" name="contact" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email adresa</label>
                                    <input type="text" name="email" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="shelter_type" id="">
                                        <option value="">---</option>
                                        @foreach ($type as $ty)
                                            <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ako se radi o službenoj osobi, podaci o službi-naziv institucije</label>
                                    <input type="file" id="founder_documents" name="founder_documents[]" multiple />
                                    <div id="error_founder_documents"></div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-2">Dodaj nalaznika</button>
            </div>

        </form>
    </div>
</div>