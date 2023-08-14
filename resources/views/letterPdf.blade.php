@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap">
</head>

<body>
    <div class="m-10 max-w-[210mm] h-full" style="font-family: 'Times New Roman', serif;">

        <div class="items-center justify-center mt-4 flex">
            <div class="mr-7">
                <img src="{{ asset('images/logo-itk.png') }}" class="h-[130px]">
            </div>
            <div class="mx-4 text-center">
                <div class="uppercase text-lg font-medium">
                    <p>kementerian pendidikan, kebudayaan,</p>
                    <p>riset, dan teknologi</p>
                    <p>institut teknologi kalimantan</p>
                    <p class="font-semibold">lembaga penelitian dan pengabdian masyarakat</p>
                </div>
                <div>
                    <p>Kampus ITK Karang Joang, Balikpapan 76127</p>
                    <p>Telepon (0542) 8530801 Faksimile (0542) 8530800</p>
                    <p>Surat elektronik : lppm@itk.ac.id laman : www.itk.ac.id</p>
                </div>
            </div>
        </div>

        <hr class="border-2 border-black mt-1">

        <div class="mx-8 mt-5">
            <div class="flex">
                <div>
                    <div class="flex">
                        <p class="mr-10">Nomor</p>
                        <p>: {{ $letter->refrences_number }}</p>
                    </div>
                    <div class="flex">
                        <p class="mr-[62px]">Hal</p>
                        <p>: {{ $letter->letterCategory->name }}</p>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-right">{{ Carbon::parse($letter->date)->format('j F Y') }}</p>
                </div>
            </div>
            <br>

            <div class="mb-5">
                <p>Yth. {{ $letter->letter_destination }}</p>
            </div>

            <div class="min-h-[30vh]">
                {{ $letter->body }}
            </div>

            <div class="flex mt-24">
                <div class="flex-1"></div>
                <div class="flex-shrink mr-4">
                    <div>
                        <p>a.n. {{ $letter->sender }}</p>
                        {{-- <p>a.n. Andi Agung</p>
                        <p>Mahasiswa Informatika 2021</p> --}}
                    </div>
                    <img src="{{ asset('images/ttd.png') }}" class="max-h-[50px] mt-4">
                </div>
            </div>

        </div>

    </div>

</body>

</html>
