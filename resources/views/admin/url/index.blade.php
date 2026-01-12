<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All URLs (Admin)') }}
        </h2>
    </x-slot>

    @include('admin.menu')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Short URL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Original URL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($urls as $url)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $url->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ url($url->short_url) }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ url($url->short_url) }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $url->url }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $url->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <form action="{{ route('admin.url.delete', $url->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($urls->isEmpty())
                        <p class="text-center text-gray-500 py-4">No URLs.</p>
                    @endif

                    <div class="mt-4">
                        {{ $urls->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
