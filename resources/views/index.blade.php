<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Presentes - Ravinny e Daniel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-wedding-gray">
    <!-- Navbar -->
    <nav class="bg-wedding-blue shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-wedding-dark">Ravinny & Daniel</h1>
            <a href="{{ route('admin') }}" class="text-wedding-dark hover:text-wedding-pink transition">Admin</a>
        </div>
    </nav>

    <div class="container mx-auto py-8">
        <!-- Mensagens -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulário -->
        <form action="{{ url('/select') }}" method="POST">
            @csrf
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="mb-6">
                    <label for="name" class="block text-wedding-dark font-semibold mb-2">Seu Nome:</label>
                    <input type="text" name="name" id="name" class="border border-wedding-blue rounded-lg w-full px-4 py-3 focus:ring-2 focus:ring-wedding-pink focus:border-transparent" placeholder="Digite seu nome" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-wedding-dark font-semibold mb-2">Telefone:</label>
                    <input type="tel" name="phone" id="phone" class="border border-wedding-blue rounded-lg w-full px-4 py-3 focus:ring-2 focus:ring-wedding-pink focus:border-transparent" placeholder="99-99999-9999" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}" required>
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <h2 class="text-2xl font-bold text-wedding-dark mb-6">Escolha os Presentes:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($presents as $present)
                        <div class="bg-wedding-gray rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="presents[]" value="{{ $present->id }}" class="mr-3 h-4 w-4 text-wedding-pink focus:ring-wedding-pink border-wedding-blue rounded">
                                <span class="text-wedding-dark font-semibold text-md">{{ $present->name }}</span>
                            </label>
                            <p class="text-gray-600 text-sm mt-2">{{ $present->description ?? 'Sem descrição' }}</p>
                            @if ($present->purchase_link)
                                <p class="text-sm mt-3">
                                    <a href="{{ $present->purchase_link }}" target="_blank" class="text-wedding-blue hover:text-wedding-pink transition flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        Link de Sugestão
                                    </a>
                                </p>
                            @endif
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-600 text-lg">Todos os presentes já foram escolhidos!</p>
                    @endforelse
                </div>

                <button type="submit" class="bg-gradient-to-r from-wedding-blue to-wedding-pink text-white px-8 py-4 rounded-lg w-full mt-8 hover:from-wedding-pink hover:to-wedding-blue transition font-semibold text-lg">Selecionar Presentes</button>
            </div>
        </form>
    </div>

    <!-- Rodapé -->
    <footer class="bg-wedding-dark text-gray text-center py-4">
        <p>Feito com ❤️</p>
        <p>2025 Ravinny & Daniel</p>
        <p><small>&copy; Desenvolvido por Edmar de Freitas</small> 
    </footer>

    <script src="https://unpkg.com/imask"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            IMask(document.getElementById('phone'), {
                mask: '00-00000-0000'
            });
        });
    </script>
</body>
</html>