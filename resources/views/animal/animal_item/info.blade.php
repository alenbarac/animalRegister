@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <div>
            <a href="/shelter/{{ $animalItems->shelter_id }}/animal/{{ $animalItems->shelter_code }}" class="btn btn-primary">
                Natrag
            </a>
        </div>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card rounded">
            <div class="card-body">
                <div class="mb-2">
                    <h6 class="card-title mb-0">Podatci Životinje</h6>
                </div>

                <div class="row">
                    <div class="col-md-6 grid-margin">
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Naziv: </label>
                            <p class="text-muted">{{ $animalItems->animal->name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Latinski naziv: </label>
                            <p class="text-muted">{{ $animalItems->animal->latin_name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Šifra oporavilišta:</label>
                            <p class="text-muted">{{ $animalItems->shelter_code }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Dob:</label>
                            <p class="text-muted">{{ $animalItems->animal_dob }}</p>
                        </div>

                        @if (!empty($animalItems->dateRange->end_date))
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Datum početka skrbi o životinji</label>
                                <p class="text-muted">
                                    <strong>{{ $animalItems->dateRange->start_date }}</strong>
                                </p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Datum prestanka skrbi o životinji</label>
                                <p class="text-muted">
                                    <strong>{{ $animalItems->dateRange->end_date ?? '' }}</strong>
                                </p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Razlog prestanka skrbi o životinji</label>
                                <p class="text-muted">
                                    {{ $animalItems->dateRange->reason_date_end }}
                                </p>
                            </div>
                        @endif

                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Status:</label>
                                @if ($animalItems->status == 1)
                                    <p class="text-success">
                                    Aktivan
                                    </p>
                                @else
                                    <p class="text-danger">
                                    Neaktivan
                                    </p>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin">
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Razlog zaprimanja životinje u oporavilište: </label>
                            <p class="text-muted">{{ $animalItems->reason ?? '' }}</p>
                            <span>Dodatni opis razloga:</span>
                            <p class="text-muted">{{ $animalItems->reason_desc ?? '' }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Veličina: </label>
                            <p class="text-muted">{{ $animalItems->animalSizeAttributes->name ?? '' }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Spol:</label>
                            <p class="text-muted">{{ $animalItems->animal_gender }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Lokacija:</label>
                            <p class="text-muted">{{ $animalItems->location }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Pronađena:</label>
                            <p class="text-muted">{{ $animalItems->date_found }}</p>
                        </div>
                        @if (!empty($animalItems->dateRange->end_date))
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Broj dana skrbi</label>
                                <p class="text-muted">
                                    {{ $diff_in_days }}
                                </p>
                            </div>
                            <div class="mt-3">
                                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Standardna cijena</label>
                                <p class="text-muted">
                                    {{ $totalPriceStand }} kn
                                </p>
                            </div>

                            @if ($totalPriceFullCare > 0)
                                <div class="mt-3">
                                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Cijena proširene skrbi</label>
                                    <p class="text-muted">
                                        {{ $totalPriceFullCare }} kn
                                    </p>
                                </div>
                            @endif
                            
                            @if ($totalPriceHibern > 0)
                                <div class="mt-3">
                                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">Cijena s hibernacijom</label>
                                    <p class="text-muted">
                                        {{ $totalPriceHibern }} kn
                                    </p>
                                </div>
                            @endif

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin">
        <div class="card rounded grid-margin">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="card-title mb-0">Dokumenti životinje</h6>
                </div>

                <div class="row">
                    <div class="col-md-6 grid-margin">
                        <p class="mb-3">Grupa</p>

                        @foreach ($mediaFiles as $fi)
                            <p>Dokumenti</p>
                            <p>
                                <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                                    href="{{ $fi->getUrl() }}">
                                    {{ $fi->file_name }}
                                </a>
                            </p>
                        @endforeach

                        @if ($mediaStanjeZaprimanja)
                            <p>Stanje životinje u trenutku zaprimanja u oporavilište</p>
                            @foreach ($mediaStanjeZaprimanja as $file)
                            <p id="findFile">
                                <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                                    href="{{ $file->getUrl() }}">
                                    {{ $file->file_name }}
                                </a>
                            </p>
                            @endforeach
                        @endif

                        @if ($mediaStanjePronadena)
                            <p>Stanje u kojem je životinja pronađena</p>
                            @foreach ($mediaStanjePronadena as $file)
                            <p id="findFile">
                                <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                                    href="{{ $file->getUrl() }}">
                                    {{ $file->file_name }}
                                </a>
                            </p>
                            @endforeach
                        @endif

                        @if ($mediaReasonFile)
                            <p>Razlog zaprimanja životinje u oporavilište</p>
                            @foreach ($mediaReasonFile as $file)
                            <p id="findFile">
                                <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                                    href="{{ $file->getUrl() }}">
                                    {{ $file->file_name }}
                                </a>
                            </p>
                            @endforeach
                        @endif

                    </div>

                    <div class="col-md-6 grid-margin">
                        <p class="mb-2">Pojedinačni dokumenti</p>

                        @if ($animalItemsMedia)
                            @foreach ($animalItemsMedia as $file)
                            <p id="findFile">
                                <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                                    href="{{ $file->getUrl() }}">
                                    {{ $file->file_name }}
                                </a>
                            </p>
                            @endforeach
                        @endif

                    </div>
                </div>

            </div>
        </div>

        <div class="card rounded grid-margin">
            <div class="card-body">
                <p>Stanje životinje u trenutku zaprimanja u oporavilište</p>

                <div class="d-flex align-items-center flex-wrap">
                @foreach ($mediaStanjeZaprimanja as $fi)
                    <a href="{{ $fi->getUrl() }}" class="m-2">
                        <img src="{{ $fi->getUrl('thumb') }}" alt="{{ $fi->name }}">
                    </a>
                @endforeach
                </div>

                <p>Stanje u kojem je životinja pronađena</p>
                    
                <div class="d-flex align-items-center flex-wrap">
                @foreach ($mediaStanjePronadena as $fi)
                    <a href="{{ $fi->getUrl() }}" class="m-2">
                        <img src="{{ $fi->getUrl('thumb') }}" alt="{{ $fi->name }}">
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection