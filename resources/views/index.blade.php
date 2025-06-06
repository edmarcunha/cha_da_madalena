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
        <h1 class="text-2xl font-bold text-center mb-6">Ravinny e Daniel</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/select') }}" method="POST">
            @csrf
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Seu Nome:</label>
                    <input type="text" name="name" id="name" class="border rounded w-full px-3 py-2" placeholder="Digite seu nome" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Telefone:</label>
                    <input type="tel" name="phone" id="phone" class="border rounded w-full px-3 py-2" placeholder="99-99999-9999" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}" required>
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <h2 class="text-xl font-semibold mb-4">Escolha os presentes:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($presents as $present)
                        <div class="bg-gray-100 rounded-lg p-4 shadow">
                            <label class="flex items-center">
                                <input type="checkbox" name="presents[]" value="{{ $present->id }}" class="mr-2">
                                <span class="text-gray-800 font-medium">{{ $present->name }}</span>
                            </label>
                            <p class="text-gray-600 text-sm">{{ $present->description ?? 'Sem descrição' }}</p>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-600">Todos os presentes já foram escolhidos!</p>
                    @endforelse
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded w-full hover:bg-blue-600">Selecionar presentes</button>
        </form>
    </div>
</body>
</html>

<script src="https://unpkg.com/imask"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        IMask(document.getElementById('phone'), {
            mask: '00-00000-0000'
        });
    });
</script>