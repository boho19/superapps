@props(['status'])

@if ($status)
<div class="toast-container">
    <div {{ $attributes->merge(['class' => 'toast align-items-center text-bg-success border-0']) }} role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ $status }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
