<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full py-3 font-semibold text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 ' . ($attributes->get('class'))]) }}>
    {{ $slot }}
</button>
