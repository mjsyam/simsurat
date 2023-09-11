@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html,
        body,
        p {
            margin: 0;
            padding: 0;
        }

        #container {
            font-family: 'Times New Roman', Times, serif;
            max-width: 210mm;
            height: 100%;
            margin: 2.5rem;
        }

        header {
            justify-content: center;
            align-items: center;
            display: flex;
            margin-top: 1rem;
        }

        #header_image {
            margin-right: 1.75rem;
        }

        #header_image img {
            height: 130px;
        }

        #header_text_container {
            text-align: center;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        #header_text_letter {
            text-transform: uppercase;
            font-weight: 500;
            font-size: 1.125rem;
            line-height: 1.75rem;
        }

        hr {
            border-width: 2px;
            margin-top: 0.25rem;
            border-color: black;
            border-style: solid;
        }

        section {
            margin-top: 1.25rem;
            margin-left: 2rem;
            margin-right: 2rem;
        }

        .flex {
            display: flex;
        }

        #nomor {
            margin-right: 2.5rem;
        }

        #hal {
            margin-right: 62px;
        }

        #date {
            flex: 1 1 0%;
        }

        #date p {
            text-align: right;
        }

        #body {
            min-height: 30vh;
        }

        footer {
            display: flex;
            margin-top: 6rem;
        }

        #ttd {
            max-height: 80px;
            margin-top: 1rem;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div id="container">

        <header>
            <div id="header_image">
                <img src="{{ public_path('images/logo-itk.png') }}" class="h-[130px]">
            </div>
            <div id="header_text_container">
                <div id="header_text_letter">
                    <p>kementerian pendidikan, kebudayaan,</p>
                    <p>riset, dan teknologi</p>
                    <p>institut teknologi kalimantan</p>
                    <p style="font-weight: 600;">lembaga penelitian dan pengabdian masyarakat</p>
                </div>
                <div id="header_text_address">
                    <p>Kampus ITK Karang Joang, Balikpapan 76127</p>
                    <p>Telepon (0542) 8530801 Faksimile (0542) 8530800</p>
                    <p>Surat elektronik : lppm@itk.ac.id laman : www.itk.ac.id</p>
                </div>
            </div>
        </header>

        <hr class="border-2 border-black mt-1">

        <section class="mx-8 mt-5">
            <div class="flex">
                <div>
                    <div class="flex">
                        <p id="nomor">Nomor</p>
                        <p>: {{ $letter->refrences_number }}</p>
                    </div>
                    <div class="flex">
                        <p id="hal">Hal</p>
                        <p>: {{ $letter->letterCategory->name }}</p>
                    </div>
                </div>
                <div id="date">
                    <p>{{ Carbon::parse($letter->date)->format('j F Y') }}</p>
                </div>
            </div>

            <br>

            <div style="margin-bottom: 1.25rem;">
                <p>Yth. {{ $letter->letter_destination }}</p>
            </div>

            <div id="body">
                {!! $letter->body !!}
            </div>

            <footer>
                <div style="flex: 1 1 0%;"></div>
                <div style="flex-shrink: 1; margin-right:1rem;">
                    <div>
                        <p>{{ $letter->role->role }} {{ $letter->identifiers->name }}</p>
                    </div>
                    {{-- {{ public_path('images/' . $letter->user->signature) }} --}}
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Tanda_Tangan_Mick_Schumacher.png"
                        id="ttd">
                    <div>
                        <p>{{ $letter->user->name }}</p>
                        <p>NIP {{ $letter->user->nip }}</p>
                    </div>
                    <img src="{{ public_path('images/ttd.png') }}" class="max-h-[50px] mt-4">
                </div>
            </footer>

        </section>

    </div>
</body>

</html>
