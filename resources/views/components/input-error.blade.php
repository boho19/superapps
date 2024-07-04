@props(['messages'])

@if ($messages)
    {{-- <button type="button" class="btn btn-link text-danger tooltip-btn invalid-tooltip"
    data-bs-toggle="tooltip" data-bs-placement="left">
    <i class="bi bi-exclamation-circle"></i> --}}
    </button>
    <ul {{ $attributes->merge(['class' => 'text-sm text-white text-left fst-italic']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
