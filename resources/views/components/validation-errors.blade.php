@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative']) }} role="alert">

        <div class="font-bold">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif
