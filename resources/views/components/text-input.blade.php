<div class="relative">
    <!-- Title or Description -->
    <p class="mb-2 text-sm font-medium text-gray-600">
        {{ $title ?? 'Description of the input field' }}
    </p>

    <!-- Input Field -->
    <input
        type="{{ $isObscure ? 'password' : 'text' }}"
        id="{{ $id ?? 'input-field' }}"
        name="{{ $name ?? 'input' }}"
        class="block w-full px-4 py-2 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 sm:text-sm hover:border-gray-400"
        placeholder="{{ $placeholder ?? 'Enter text' }}"
        value="{{ $value ?? '' }}"
    />

    <!-- Helper Text (Optional) -->
    @if(isset($helperText))
        <p class="mt-2 text-sm text-gray-500">
            {{ $helperText }}
        </p>
    @endif
</div>
