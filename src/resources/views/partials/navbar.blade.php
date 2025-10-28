<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo / App name --}}
            <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800 hover:text-indigo-600">
                MyShop
            </a>

            {{-- Categories --}}
            <ul class="flex space-x-6">
                @foreach($categories as $category)
                    <li>
                        <a
                            href="{{ route('categories.index') . '/' . Str::slug($category->name) }}"
                            class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-200
                                   {{ request()->is('categories/' . Str::slug($category->name)) ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : '' }}"
                        >
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

{{-- Add some top padding so content isn’t hidden behind fixed navbar --}}
<div class="pt-20"></div>
