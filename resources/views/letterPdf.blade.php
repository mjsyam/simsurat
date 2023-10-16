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
            display: flex;
            margin: 0 50px;
            margin-top: 1rem;
        }

        #header_image {
            width: 100px;
            float: left;
        }

        #header_image img {
            height: 130px;
        }

        #header_text_container {
            width: 100%;
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
    <div id="">

        <header style="text-align: center">
            <div style="float: left; width: 10%;">
                <img src="{{ public_path('images/Lambang_ITK.png') }}" style="height: 150px; margin-top: 20px; padding-left: 50px">
            </div>
            <div style="float: right; width: 90%;">
                <div id="header_text_letter">
                    <p>kementerian pendidikan, kebudayaan,</p>
                    <p>riset, dan teknologi</p>
                    <p>institut teknologi kalimantan</p>
                    <p style="font-weight: 600;">{{ $letter->institution }}</p>
                </div>
                <div id="header_text_address">
                    <p>Kampus ITK Karang Joang, Balikpapan 76127</p>
                    <p>Telepon (0542) 8530801 Faksimile (0542) 8530800</p>
                    <p>Surat elektronik : lppm@itk.ac.id laman : www.itk.ac.id</p>
                </div>
            </div>

        </header>


        <hr class="border-2 border-black mt-1" style="margin: 0 10px; margin-top: 200px;">
        <section class="mx-8" style="padding: 0 20px;">
            <div class="flex">
                <div>
                    <table>
                        <tr>
                            <td style="width: 50px;"><span style="padding-right: 50px;">Nomor</span> </td>
                            <td>: {{ $letter->refrences_number }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50px;"><span style="padding-right: 50px;">Hal</span> </td>
                            <td>: {{ $letter->letterCategory->name }}</td>
                        </tr>
                    </table>
                </div>
                <div id="date" style="float: right; margin-top:-48px">
                    <p>{{ Carbon::parse($letter->date)->format('j F Y') }}</p>
                </div>
            </div>

            <br>

            <div style="margin-bottom: 1.25rem;">
                <p>Yth. {{ $letter->letter_destination }}</p>
            </div>

            <div id="body" style="min-height: 400px;">
                {!! $letter->body !!}
            </div>

            <footer style="float: right;">
                <div style="flex: 1 1 0%;"></div>
                <div style="flex-shrink: 1; margin-right:1rem;">
                    <div>
                        <p>{{ $letter->role->role }} {{-- $letter->identifiers->name --}}</p>
                    </div>
                    {{-- {{ public_path('images/' . $letter->user->signature) }} --}}
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Tanda_Tangan_Mick_Schumacher.png"
                        id="ttd">
                    <div>
                        <p>{{ $letter->user->name }}</p>
                        <p>NIP {{ $letter->user->number }}</p>
                    </div>
                    {{-- <img src="{{ public_path('images/ttd.png') }}" class="max-h-[50px] mt-4"> --}}
                </div>
            </footer>

        </section>

    </div>
</body>

</html>
