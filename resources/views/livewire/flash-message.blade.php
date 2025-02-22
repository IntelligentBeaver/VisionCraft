<div>
    @if (session('success'))
        <div class="mx-auto px-8 py-3">
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mx-auto px-8 py-3">
            <div class="alert alert-error">
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="mx-auto px-8 py-3">
            <div class="alert alert-warning">
                <p>{{ session('warning') }}</p>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="mx-auto px-8 py-3">
            <div class="alert alert-info">
                <p>{{ session('info') }}</p>
            </div>
        </div>
    @endif
</div>
