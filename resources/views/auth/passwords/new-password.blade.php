<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @if ($errors->any())
        <div class="bg-red-500 p-4 mb-6 text-white text-center absolute w-full">
            {{ implode('', $errors->all(':message')) }}
        </div>
    @endif
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 bg-gray-100">
        <div class="w-full grid grid-cols-2 shadow md:mt-0 sm:max-w-4xl min-h-[65vh]">
            <div class="col-span-1 bg-white rounded-l-2xl p-4 flex items-center justify-center w-full p-8">
                <form method="POST" class="w-full" action="{{ route('change.password') }}">
                    <div class="flex flex-1 justify-center mb-6">

                        <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                    </div>
                    {{ csrf_field() }}
                    <div for="password" class="mb-1 text-sm font-semibold">Password Baru</div>
                    <input id="password" type="password"
                        class="w-full rounded-lg border border-gray-300 px-1 py-1 focus:ring-3 focus:ring-primary-300 focus:border-primary-300"
                        name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-red-600">
                            <small>{{ $errors->first('password') }}</small>
                        </span>
                    @endif
                    <div for="password_confirmation" class="mb-1 text-sm font-semibold">Confirm Password Baru</div>
                    <input id="password_confirmation" type="password"
                        class="w-full rounded-lg border border-gray-300 px-1 py-1 focus:ring-3 focus:ring-primary-300 focus:border-primary-300"
                        name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-red-600">
                            <small>{{ $errors->first('password_confirmation') }}</small>
                        </span>
                    @endif
                    <div class="flex flex-1 justify-center mt-6">
                        <button type="submit" class="bg-blue-800 rounded-xl px-20 py-2 text-white font-semibold">Ubah
                            Password Baru</button>
                    </div>
                </form>
            </div>
            <div class="col-span-1 bg-blue-800 rounded-r-2xl p-8 flex justify-center items-center">
                <div class="font-bold text-white p-4">
                    <p class="text-3xl mb-4">Selamat Datang di SISUKMA ITK</p>
                    <p class="mb-4 font-semibold">Ubah password anda untuk meningkatkan keamanan.</p>
                    {{-- <p class="mb-4">
                        Apabila anda belum memiliki akun, silahkan hubungi Admin SIKUSMA lewat email:eoffice@itk.ac.id untuk mendapatkan akun
                    </p> --}}
                </div>
            </div>
        </div>
    </div>
    </section>

</body>

</html>
