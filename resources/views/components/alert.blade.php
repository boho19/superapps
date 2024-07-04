<!-- resources/views/components/alert.blade.php -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    @foreach (['status' => 'success', 'success' => 'success', 'error' => 'danger', 'errors' => 'danger'] as $msg => $type)
        @if(session($msg) || ($msg == 'errors' && $errors->any()))
            <div class="toast align-items-center bg-{{ $type }} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        @if($msg == 'errors')
                            @foreach($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        @else
                            {{ session($msg) }}
                        @endif
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    @endforeach
</div>
