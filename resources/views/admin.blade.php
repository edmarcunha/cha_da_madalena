<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Presentes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-wedding-gray">
    <!-- Navbar -->
    <nav class="bg-wedding-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-wedding-dark">Ravinny & Daniel</h1>
            <a href="{{ url('/') }}" class="text-wedding-dark hover:text-wedding-gold transition">Voltar à Lista</a>
        </div>
    </nav>

    <div class="container mx-auto py-8">
        <!-- Mensagens -->
        @if(session('success'))
            <div class="bg-wedding-olive text-wedding-dark p-4 rounded-lg shadow mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-wedding-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 text-red-600 p-4 rounded-lg shadow mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Link para Configurações -->
        <div class="mb-6">
            <a href="{{ route('settings.edit') }}" class="text-wedding-gold hover:text-wedding-olive transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Configurar Mensagem do WhatsApp
            </a>
        </div>

        <!-- Formulário de Adição -->
        <div class="bg-wedding-olive rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-wedding-dark mb-6">Adicionar Novo Presente</h2>
            <form action="{{ url('/admin/add') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-wedding-dark font-semibold mb-2">Nome do Presente:</label>
                    <input type="text" name="name" id="name" class="border border-gray-300 rounded-lg w-full px-4 py-3 focus:ring-2 focus:ring-wedding-gold focus:border-transparent" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-wedding-dark font-semibold mb-2">Descrição (opcional):</label>
                    <textarea name="description" id="description" class="border border-gray-300 rounded-lg w-full px-4 py-3 focus:ring-2 focus:ring-wedding-gold focus:border-transparent"></textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="purchase_link" class="block text-wedding-dark font-semibold mb-2">Link de Compra (opcional):</label>
                    <input type="url" name="purchase_link" id="purchase_link" class="border border-gray-300 rounded-lg w-full px-4 py-3 focus:ring-2 focus:ring-wedding-gold focus:border-transparent" placeholder="https://exemplo.com/produto">
                    @error('purchase_link')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="bg-gradient-to-r from-wedding-gold to-wedding-olive text-wedding-dark px-6 py-3 rounded-lg hover:from-wedding-olive hover:to-wedding-gold transition">Adicionar</button>
            </form>
        </div>

        <!-- Lista de Presentes -->
        <div class="bg-wedding-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-wedding-dark mb-6">Presentes Cadastrados</h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-wedding-olive text-wedding-dark">
                            <th class="border border-gray-200 px-4 py-3">Nome</th>
                            <th class="border border-gray-200 px-4 py-3">Descrição</th>
                            <th class="border border-gray-200 px-4 py-3">Link de Compra</th>
                            <th class="border border-gray-200 px-4 py-3">Selecionado Por</th>
                            <th class="border border-gray-200 px-4 py-3">Telefone</th>
                            <th class="border border-gray-200 px-4 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presents as $present)
                            <tr class="hover:bg-wedding-olive hover:text-wedding-dark transition">
                                <td class="border border-gray-200 px-4 py-3">{{ $present->name }}</td>
                                <td class="border border-gray-200 px-4 py-3">{{ $present->description ?? 'Sem descrição' }}</td>
                                <td class="border border-gray-200 px-4 py-3">
                                    @if ($present->purchase_link)
                                        <a href="{{ $present->purchase_link }}" target="_blank" class="text-wedding-gold hover:text-wedding-olive transition">Link</a>
                                    @else
                                        Sem link
                                    @endif
                                </td>
                                <td class="border border-gray-200 px-4 py-3">{{ $present->is_selected ? $present->selected_by : 'Não escolhido' }}</td>
                                <td class="border border-gray-200 px-4 py-3">{{ $present->is_selected ? ($present->selected_by_phone ?? 'Não informado') : 'Não escolhido' }}</td>
                                <td class="border border-gray-200 px-4 py-3 flex items-center space-x-2">
                                    <form action="{{ route('presents.delete', $present->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este presente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button>
                                    </form>
                                    @if ($present->is_selected)
                                        <form action="{{ route('presents.removeDonor', $present->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja liberar este presente?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Liberar</button>
                                        </form>
                                    @endif
                                    @if ($present->is_selected && $present->selected_by_phone)
                                        @php
                                            $relatedPresents = \App\Models\Present::where('selected_by_phone', $present->selected_by_phone)->where('is_selected', true)->get();
                                            $presentsList = $relatedPresents->map(function($p) {
                                                $line = $p->name . ($p->description ? ': ' . $p->description : '');
                                                if ($p->purchase_link) {
                                                    $line .= "\nLink de Compra: " . $p->purchase_link;
                                                }
                                                return $line;
                                            })->implode("\n- ");
                                            $greeting = Auth::user()->whatsapp_greeting ? str_replace('{nome}', $present->selected_by, Auth::user()->whatsapp_greeting) : 'Olá, ' . $present->selected_by . '! Você escolheu o(s) presente(s):';
                                        @endphp
                                        <a href="{{ url('https://wa.me/+55' . preg_replace('/[^0-9]/', '', $present->selected_by_phone) . '?text=' . urlencode($greeting . "\n- " . $presentsList . "\npara o chá de panela de Ravinny e Daniel. " . (Auth::user()->whatsapp_message ?? 'Muito obrigado pela sua generosidade! Estamos ansiosos para celebrar com você!'))) }}"
                                           target="_blank" class="bg-wedding-gold text-wedding-dark px-3 py-1 rounded hover:bg-wedding-olive">WhatsApp</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-gray-200 px-4 py-3 text-center text-gray-600">Nenhum presente cadastrado ainda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Rodapé -->
    <footer class="bg-wedding-white text-wedding-dark text-center py-4">
        <p>Feito com ❤️</p>
        <p>2025 Ravinny & Daniel</p>
        <!-- <p><small>&copy; Desenvolvido por Edmar de Freitas</small> -->
    </footer>
</body>
</html>