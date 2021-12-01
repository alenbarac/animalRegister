<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Uredi korisnika</h4>
            <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
        </div>
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
                        <input type="text" class="form-control name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label>Oporavilište</label>
                        <select class="form-control shelter_id" id="">
                            <option value="{{ $user->shelter->id }}">{{ $user->shelter->name }}</option>
                            <option value="">-------------</option>
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
            <button type="button" class="submitBtn btn btn-warning">Spremi</button>
            <button type="button" class="btn btn-primary modal-close" data-dismiss="modal">Zatvori</button>
        </div>
    </div>
</div>