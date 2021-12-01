<!DOCTYPE html>
<html>
<head>
    <title>PDF - {{ $animalItems->animal->name }}</title>

    <style>
        body {font-family: DejaVu Sans, sans-serif;}
        strong, h2 {color: rgb(0, 0, 0) !important;}
        p {color: rgb(90, 108, 131);}
        .title {text-align: center;}
    </style>
</head>
<body>

    <div class="title">
        <h1>Izvještaj</h1>
    </div>

    <h2>Životinja</h2>

    <p><strong>Naziv:</strong> {{ $animalItems->animal->name }}</p>
    <p><strong>Latinski naziv:</strong> {{ $animalItems->animal->latin_name }}</p>
    <p><strong>Šifra:</strong> {{ $animalItems->shelter_code }}</p>
    <p><strong>Veličina:</strong> {{ $animalItems->animalSizeAttributes->name ?? '' }}</p>
    <p><strong>Spol:</strong> {{ $animalItems->animal_gender }}</p>
    <p><strong>Lokacija:</strong> {{ $animalItems->location }}</p>

    <hr>
    <h2>Dokumenti</h2>

    <p><strong>Grupa</strong></p>
    <div>
        @foreach ($mediaFiles as $fi)
            @foreach ($fi->getMedia('media') as $media)
                <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                        href="{{ $media->getUrl() }}">
                        {{ $media->name }}
                    </a>
            @endforeach
        @endforeach
    </div>

    <p><strong>Pojedinačni</strong></p>
    @if ($animalItems->getMedia('media'))
        @foreach ($animalItems->getMedia('media') as $file)
            <div>
                <a class="text-muted mr-2" target="_blank" data-toggle="tooltip" data-placement="top" 
                    href="{{ $file->getUrl() }}">
                    {{ $file->name }}
                </a>
            </div>
        @endforeach
    @endif

    <hr>
    <h2>Oporavilište</h2>

    <p><strong>Oporavilište:</strong> {{ $animalItems->shelter->name }}</p>
    <p><strong>Šifra oporavilišta:</strong> {{ $animalItems->shelter->shelterCode }}</p>
    <p><strong>Email:</strong> {{ $animalItems->shelter->email }}</p>
    <p><strong>Adresa:</strong> {{ $animalItems->shelter->address }}</p>
    <p><strong>OIB:</strong> {{ $animalItems->shelter->oib }}</p>
    <p><strong>Poštanski broj:</strong> {{ $animalItems->shelter->place_zip }}</p>
    <p><strong>Telefon:</strong> {{ $animalItems->shelter->telephone }}</p>

</body>
</html>