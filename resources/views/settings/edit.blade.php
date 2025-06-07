<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-center mb-6">Configurações da Mensagem do WhatsApp</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="whatsapp_greeting" class="block text-gray-700 font-semibold mb-2">Saudação Inicial:</label>
                    <textarea name="whatsapp_greeting" id="whatsapp_greeting" class="border rounded w-full px-3 py-2" rows="3" placeholder="Digite a saudação inicial (ex.: Olá, {nome}! Você escolheu o(s) presente(s):)">{{ old('whatsapp_greeting', $user->whatsapp_greeting ?? 'Olá, {nome}! Você escolheu o(s) presente(s):') }}</textarea>
                    @error('whatsapp_greeting')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="whatsapp_message" class="block text-gray-700 font-semibold mb-2">Mensagem Final:</label>
                    <textarea name="whatsapp_message" id="whatsapp_message" class="border rounded w-full px-3 py-2" rows="5" placeholder="Digite a mensagem personalizada para os doadores">{{ old('whatsapp_message', $user->whatsapp_message ?? 'Muito obrigado pela sua generosidade! Estamos ansiosos para celebrar com você!') }}</textarea>
                    @error('whatsapp_message')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Salvar Configurações</button>
            </form>

            <!-- Área de Pré-visualização -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Pré-visualização da Mensagem</h2>
                <div id="preview" class="bg-gray-100 p-4 rounded-lg text-gray-800 border-l-4 border-green-500">
                    {{ $user->whatsapp_greeting ? str_replace('{nome}', 'João Silva', $user->whatsapp_greeting) : 'Olá, João Silva! Você escolheu o(s) presente(s):' }}
                    <ul class="list-disc pl-5">
                        <li>Panela de Pressão: 5 litros, antiaderente</li>
                        <li>Jogo de Talheres: Conjunto de 24 peças</li>
                    </ul>
                    {{ $user->whatsapp_message ?? 'Muito obrigado pela sua generosidade! Estamos ansiosos para celebrar com você!' }}
                </div>
            </div>
        </div>

        <a href="{{ route('admin') }}" class="text-blue-500 hover:underline">Voltar para Administração</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const greetingTextarea = document.getElementById('whatsapp_greeting');
            const messageTextarea = document.getElementById('whatsapp_message');
            const preview = document.getElementById('preview');

            function updatePreview() {
                const greeting = greetingTextarea.value || 'Olá, {nome}! Você escolheu o(s) presente(s):';
                const message = messageTextarea.value || 'Muito obrigado pela sua generosidade! Estamos ansiosos para celebrar com você!';
                const formattedGreeting = greeting.replace('{nome}', 'João Silva');
                preview.innerHTML = `
                    ${formattedGreeting}
                    <ul class="list-disc pl-5">
                        <li>Panela de Pressão: 5 litros, antiaderente</li>
                        <li>Jogo de Talheres: Conjunto de 24 peças</li>
                    </ul>
                    ${message}
                `;
            }

            // Atualiza a pré-visualização ao carregar a página
            updatePreview();

            // Atualiza a pré-visualização ao digitar
            greetingTextarea.addEventListener('input', updatePreview);
            messageTextarea.addEventListener('input', updatePreview);
        });
    </script>
</body>
</html>