@props([
    'image' => 'assets/img/default.jpg', 
    'name' => 'User Name', 
    'description' => 'User description', 
    'time' => 'some time ago'
])

<a class="list-group-item">
    <div class="row">
        <div class="col-auto">
            <div class="avatar avatar-40 coverimg rounded-circle" style="background-image: url(&quot;{{ $image }}&quot;);">
                <img src="{{ $image }}" alt="" style="display: none;">
            </div>
        </div>
        <div class="col align-self-center">
            <p class="lh-small mb-0"><b>{{ $name }}</b> {{ $description }}</p>
            <p class="small text-opac">{{ $time }}</p>
        </div>
    </div>
</a>
