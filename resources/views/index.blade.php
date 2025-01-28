<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Presentes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-center mb-6">Chá da Madalena</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/select') }}" method="POST">
            @csrf
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Seu Nome:</label>
                <input type="text" name="name" id="name" class="border rounded w-full px-3 py-2 mb-4" placeholder="Digite seu nome" required>

                <h2 class="text-xl font-semibold mb-4">Escolha os presentes:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($presents as $present)
                        <div class="bg-gray-100 rounded-lg p-4 shadow">
                            <label class="flex items-center">
                                <input type="checkbox" name="presents[]" value="{{ $present->id }}" class="mr-2">
                                <span class="text-gray-800 font-medium">{{ $present->name }}</span>
                            </label>
                            <p class="text-gray-600 text-sm">{{ $present->description }}</p>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-600">Todos os presentes já foram escolhidos!</p>
                    @endforelse
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded w-full">
                Selecionar presentes
            </button>
        </form>
    </div>
</body>
</html>

