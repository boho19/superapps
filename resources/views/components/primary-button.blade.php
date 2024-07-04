<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-login btn btn-lg btn-default shadow-sm']) }}>
    {{ $slot }}
</button>
