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

        <!-- Formulário de Adição -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <h2 class="text-xl font-semibold mb-4">Adicionar Novo Presente</h2>
            <form action="{{ url('/admin/add') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nome do Presente:</label>
                    <input type="text" name="name" id="name" class="border rounded w-full px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Descrição (opcional):</label>
                    <textarea name="description" id="description" class="border rounded w-full px-3 py-2"></textarea>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Adicionar</button>
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
                        <th class="border px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presents as $present)
                        <tr>
                            <td class="border px-4 py-2">{{ $present->name }}</td>
                            <td class="border px-4 py-2">{{ $present->description }}</td>
                            <td class="border px-4 py-2">{{ $present->is_selected ? $present->selected_by : 'Não escolhido' }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('presents.delete', $present->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este presente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                                @if ($present->selected_by)
                                        <form action="{{ route('presents.removeDonor', $present->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja liberar este presente?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning">Liberar presente</button>
                                        </form> 
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border px-4 py-2 text-center">Nenhum presente cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
