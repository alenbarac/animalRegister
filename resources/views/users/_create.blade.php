
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Dodaj korisnika</h4>
        <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
    </div>
    <form method="POST" id="user-ajax" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-body">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                <strong>Uspjeh!</strong> Korisnik je uspješno spremljen.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Naziv</label>
                        <input type="text" class="form-control name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Lozinka</label>
                        <input type="password" class="form-control password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control role_id" name="role_id" id="">
                            <option value="">Odaberi</option>
                            <option value="1">Shelter-Admin</option>
                            <option value="2">Super-Admin</option>
                            <option value="3">Shelter-User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Oporavilište</label>
                        <select class="form-control shelter_id" name="shelter_id" id="">
                            @foreach ($shelters as $shelter)
                                <option value="{{ $shelter->id }}">{{ $shelter->name }}</option>
                            @endforeach
                        </select>
                    </div>
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