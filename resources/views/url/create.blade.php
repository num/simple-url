<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Short URL') }}
        </h2>
    </x-slot>

    @include('menu')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form action="{{ route('url.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="url" class="block font-medium text-sm text-gray-700">
                                Original URL
                            </label>
                            <input 
                                type="url" 
                                name="url" 
                                id="url" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="https://example.com"
                                required
                            >
                        </div>

                        <div class="flex items-center gap-4">
                            <button 
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                Create Short URL
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>