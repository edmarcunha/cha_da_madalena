<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Presentes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-center mb-6">Administração de Presentes</h1>

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

        <!-- Formulário de Adição -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <h2 class="text-xl font-semibold mb-4">Adicionar Novo Presente</h2>
            <form action="{{ url('/admin/add') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nome do Presente:</label>
                    <input type="text" name="name" id="name" class="border rounded w-full px-3 py-2" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Descrição (opcional):</label>
                    <textarea name="description" id="description" class="border rounded w-full px-3 py-2"></textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Adicionar</button>
            </form>
        </div>

        <!-- Lista de Presentes -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-4">Presentes Cadastrados</h2>
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Nome</th>
                        <th class="border px-4 py-2">Descrição</th>
                        <th class="border px-4 py-2">Selecionado Por</th>
                        <th class="border px-4 py-2">Telefone</th>
                        <th class="border px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presents as $present)
                        <tr>
                            <td class="border px-4 py-2">{{ $present->name }}</td>
                            <td class="border px-4 py-2">{{ $present->description ?? 'Sem descrição' }}</td>
                            <td class="border px-4 py-2">{{ $present->is_selected ? $present->selected_by : 'Não escolhido' }}</td>
                            <td class="border px-4 py-2">{{ $present->is_selected ? ($present->selected_by_phone ?? 'Não informado') : 'Não escolhido' }}</td>
                            <td class="border px-4 py-2 flex space-x-2">

                                @if ($present->is_selected && $present->selected_by_phone)
                                    <a href="{{ url('https://wa.me/+55' . preg_replace('/[^0-9]/', '', $present->selected_by_phone) . '?text=' . urlencode('Olá, ' . $present->selected_by . '! Você escolheu o presente "' . $present->name . ($present->description ? ': ' . $present->description : '') . '" para o chá de panela de Ravinny e Daniel. Muito obrigado pela sua generosidade! Estamos ansiosos para celebrar com você!')) }}"
                                       target="_blank" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">WhatsApp</a>
                                @endif

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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border px-4 py-2 text-center">Nenhum presente cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>