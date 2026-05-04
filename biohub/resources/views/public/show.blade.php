<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-md mx-auto py-16 px-4 flex flex-col items-center text-center">

        {{-- Avatar --}}
        <div class="w-24 h-24 rounded-full bg-purple-300 flex items-center justify-center text-5xl mb-4">
            👤
        </div>

        {{-- Name & Bio --}}
        <h1 class="text-2xl font-bold text-gray-800">John Doe</h1>
        <p class="text-gray-500 mt-1 mb-8">Full Stack Developer 🚀</p>

        {{-- Links --}}
        <div class="w-full flex flex-col gap-3">

            <a href="https://portfolio.com"
               class="w-full bg-white shadow rounded-xl py-4 px-6 font-medium text-gray-700 hover:bg-purple-600 hover:text-white transition">
                🌐 My Portfolio
            </a>

            <a href="https://github.com"
               class="w-full bg-white shadow rounded-xl py-4 px-6 font-medium text-gray-700 hover:bg-purple-600 hover:text-white transition">
                💻 GitHub
            </a>

            <a href="https://linkedin.com"
               class="w-full bg-white shadow rounded-xl py-4 px-6 font-medium text-gray-700 hover:bg-purple-600 hover:text-white transition">
                💼 LinkedIn
            </a>

        </div>

        {{-- Footer --}}
        <p class="text-gray-400 text-sm mt-10">Made with BioHub 💜</p>

    </div>

</body>
</html>