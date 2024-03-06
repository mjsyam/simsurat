<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 bg-gray-100">
        <div class="w-full grid grid-cols-2 shadow md:mt-0 sm:max-w-4xl min-h-[65vh]">
            <div class="col-span-1 bg-white rounded-l-2xl p-4 flex items-center justify-center w-full p-8">
                <form method="POST" class="w-full" action="{{ route('login') }}">
                    <div class="flex flex-1 justify-center mb-6">

                        <img src="{{ asset('images/logo.png') }}" class="h-12" alt="">
                    </div>
                    {{ csrf_field() }}
                    <div for="email" class="mb-1 text-sm font-semibold">Email</div>
                    <input id="email" type="email" name="email"
                        class="w-full rounded-lg border border-gray-300 px-1 py-1 focus:ring-3 focus:ring-primary-300 focus:border-primary-300"
                        value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-red-600">
                            <small>{{ $errors->first('email') }}</small>
                        </span>
                    @endif

                    <div for="password" class="mb-1 text-sm font-semibold">Password</div>
                    <input id="password" type="password"
                        class="w-full rounded-lg border border-gray-300 px-1 py-1 focus:ring-3 focus:ring-primary-300 focus:border-primary-300"
                        name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-red-600">
                            <small>{{ $errors->first('password') }}</small>
                        </span>
                    @endif

                    <div class="flex flex-1 justify-center mt-6">
                        <button type="submit"
                            class="bg-blue-800 rounded-xl px-20 py-2 text-white font-semibold">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-span-1 bg-blue-800 rounded-r-2xl p-8 flex justify-center items-center">
                <div class="font-bold text-white p-4">
                    <p class="text-3xl mb-4">Selamat Datang di SISUKMA ITK</p>
                    <p class="mb-4 font-semibold">Apabila anda mengalami kesulitan dalam login, silahkan hubungi Admin
                        SISUKMA lewat <br>
                        email: eoffice@itk.ac.id</p>
                    <p>
                        Panduan penggunaan SISUKMA dapat diunduh melalui lini berikut:
                    </p>
                    <a href="{{ asset('USER GUIDE - WEB SISUKMA.pdf') }}" target="_blank" style="text-decoration: underline; color: orange">
                        <i class="fas fa-book fa-fw"></i>
                        User Guide
                    </a>
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
