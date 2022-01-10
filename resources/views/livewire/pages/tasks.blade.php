<main class="container mx-auto mx-auto pt-10 pb-12 px-4 lg:pb-16">

    {{-- chamando o método a ser executado no submit --}}
    <form wire:submit.prevent='save' method='post'>
        <div class="space-y-6">
            <div>
                <h1 class="text-lg leading-6 font-medium text-gray-900">To-do</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Não esqueça de nenhuma task hein?
                </p>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Tarefa
                </label>
                <div class="mt-1 flex gap-4">
                    {{-- wire.model seguido no nome da variavel chamada no componente --}}
                    {{-- lazy faz a request apenas após o input perder o foco --}}
                    <input wire:model.lazy='name' type="text"
                        class=" block shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm border-gray-300 rounded-md " />

                    <div>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ $task ? 'Atualizar' : 'Salvar' }}
                        </button>
                        @if ($task)
                        <a wire:click='cancel({{ $task->id }})' href="#"
                            class="ml-4 text-indigo-600 hover:text-indigo-900">
                            Cancelar
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <hr>

            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">
                    Buscar tarefa
                </label>
                <div class="mt-1">
                    {{-- debounce indica um delay para o envio da request --}}
                    <input wire:model.debounce.300ms='search' type="text"
                        class=" block w-full shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm border-gray-300 rounded-md " />
                </div>
            </div>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class=" py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 ">
                        <div class=" shadow overflow-hidden border-b border-gray-200 sm:rounded-lg ">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                                            Tarefa
                                        </th>
                                        <th scope="col"
                                            class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                                            Status
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Ações</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tasks as $task)
                                        <tr wire:loading.remove wire:target='delete({{ $task->id }})'>
                                            <td class=" px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                                                {{ $task->id }}
                                            </td>
                                            <td class=" px-6 py-4 whitespace-nowrap text-sm text-gray-500 ">
                                                {{ $task->name }}
                                            </td>
                                            <td class=" px-6 py-4 whitespace-nowrap text-sm text-gray-500 ">
                                                {{ $task->done ? 'Concluído' : 'Pendente' }}
                                            </td>
                                            <td class=" px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                                                {{-- chamando o método done com parametro --}}
                                                <a wire:click='done({{ $task->id }})' href="#"
                                                    class="ml-4 text-indigo-600 hover:text-indigo-900">
                                                    {{ $task->done ? 'Concluído' : 'Concluir' }}
                                                </a>
                                                
                                            </td>
                                            <td class=" px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                                                {{-- chamando o método edit com parametro --}}
                                                <a wire:click='edit({{ $task->id }})' href="#"
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                    Editar
                                                </a>
                                            </td>
                                            <td class=" px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                                                {{-- chamando o método delete com parametro --}}
                                                <a wire:click='delete({{ $task->id }})' href="#"
                                                    class="ml-4 text-indigo-600 hover:text-indigo-900">
                                                    Excluir
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- componente de loading screen a partir dos metodos indicados --}}
    <div wire:loading wire:target='save,edit,delete'>Processando... aguarde.</div>
</main>