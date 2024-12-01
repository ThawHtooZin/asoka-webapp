<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Asoka Center of  Buddhist Studies' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- Jquery Of Course Why Not --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Myanmar:wght@400;700&display=swap" rel="stylesheet">

</head>
<style>
    pre {
        white-space: pre-wrap;
        /* Wrap text, but preserve whitespace */
        word-wrap: break-word;
        /* Break long words */
        overflow-wrap: break-word;
        /* For better browser support */
        overflow: hidden;
        /* Prevent content from spilling out */
    }
</style>

<body>

    <x-header />
    <x-navbar />
    {{ $slot }}
    <x-footer />
    @if (session('success'))
        <div id="alert"
            class="fixed bottom-5 right-5 bg-blue-500 text-white p-4 rounded shadow-lg transition-opacity duration-500"
            style="opacity: 1;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="alert"
            class="fixed bottom-5 right-5 bg-red-500 text-white p-4 rounded shadow-lg transition-opacity duration-500"
            style="opacity: 1;">
            {{ session('error') }}
        </div>
    @endif
    @error('payment_image')
        <div id="alert"
            class="fixed bottom-5 right-5 bg-red-500 text-white p-4 rounded shadow-lg transition-opacity duration-500"
            style="opacity: 1;">
            {{ $message }}
        </div>
    @enderror


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0'; // Fade out
                    setTimeout(() => {
                        alert.remove(); // Remove from DOM after fade out
                    }, 500); // Match duration with CSS transition
                }, 5000); // Show for 5 seconds
            }
        });
    </script>
    @vite('resources/js/app.js')
</body>

</html>
