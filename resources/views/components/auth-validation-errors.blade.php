@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600 fs-6 text-danger">
            {{ __('اوووپس، یه چیزی اشتباه پیش رفت.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600 list-unstyled fs-6 text-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif