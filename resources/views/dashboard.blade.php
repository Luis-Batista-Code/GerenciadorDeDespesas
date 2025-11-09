<x-app-layout>
    {{-- FUNDO DA PÁGINA (CINZA CLARO, ESTILO macOS) --}}
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 
                CARD PRINCIPAL (EFEITO VIDRO FOSCO - "FROSTED GLASS")
                bg-white/70 -> Cor branca com 70% de opacidade
                backdrop-blur-lg -> O efeito "vidro fosco"
                rounded-xl -> Cantos arredondados do macOS
            --}}
            <div class="bg-white/70 backdrop-blur-lg overflow-hidden shadow-lg rounded-xl">
                <div class="p-6 text-gray-900">
                    {{-- TÍTULO DA "JANELA" COM OS BOTÕES DE TRÁFEGO --}}
                    <div class="flex items-center justify-between pb-4 border-b border-gray-300">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                        <h2 class="text-xl font-semibold text-center">Meu Gerenciador de Despesas</h2>
                        <div class="w-16"></div> {{-- Espaçador --}}
                    </div>

                    {{-- SEÇÃO DO TOTAL GASTO --}}
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">Total Gasto</p>
                        <p class="text-4xl font-bold text-gray-800">R$ {{ number_format($total, 2, ',', '.') }}</p>
                    </div>

                    {{-- FORMULÁRIO DE ADICIONAR DESPESA --}}
                    <form action="{{ route('despesas.store') }}" method="POST" class="mt-8 space-y-4">
                        @csrf {{-- Token de segurança do Laravel --}}
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {{-- Descrição --}}
                            <div>
                                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                                <input type="text" name="descricao" id="descricao" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            
                            {{-- Valor --}}
                            <div>
                                <label for="valor" class="block text-sm font-medium text-gray-700">Valor (R$)</label>
                                <input type="number" name="valor" id="valor" step="0.01" min="0.01" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            {{-- Data --}}
                            <div>
                                <label for="data" class="block text-sm font-medium text-gray-700">Data</logo>
                                <input type="date" name="data" id="data" value="{{ date('Y-m-d') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                             {{-- Categoria --}}
                             <div>
                                <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                                <select name="categoria_id" id="categoria_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Selecione...</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Botão Salvar (Estilo macOS Azul) --}}
                            <div class="md:pt-6">
                                <button type="submit" 
                                    class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Adicionar Despesa
                                </button>
                            </div>
                        </div>

                         {{-- Exibe erros de validação --}}
                        @if ($errors->any())
                            <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- TABELA DE HISTÓRICO (Outra "Janela") --}}
            <div class="bg-white/70 backdrop-blur-lg overflow-hidden shadow-lg rounded-xl">
                <div class="p-6 text-gray-900">
                    {{-- Título da "JANELA" --}}
                    <div class="flex items-center space-x-2 pb-4 border-b border-gray-300">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <h3 class="ml-4 text-lg font-semibold">Histórico de Despesas</h3>
                    </div>

                    {{-- Tabela (Estilo Finder) --}}
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/80 divide-y divide-gray-200">
                                @forelse ($despesas as $despesa)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $despesa->descricao }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-semibold">- R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                                {{ $despesa->categoria->nome }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $despesa->data->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Nenhuma despesa registrada ainda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>