<div class="py-6">
    <div class="p-6 text-center">
        <a href="{{ route('dashboard') }}" class="mx-3 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 inline-block">Dashboard</a>
        <a href="{{ route('url') }}" class="mx-3 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 inline-block">URL</a>
        <a href="{{ route('url.create') }}" class="mx-3 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 inline-block">Create URL</a>
        
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="mx-3 px-4 py-2 border border-red-300 rounded hover:bg-red-50 inline-block text-red-600">Admin Panel</a>
        @endif
    </div>
</div>