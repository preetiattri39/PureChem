<div class="col-12 d-flex flex-column justify-content-center align-items-center gap-4">
    <h1 class="display-6 fw-bold col-12 col-lg-6 text-center">
        {{ $title }}
    </h1>

    <form method="{{ $method }}" action="{{ $action }}" class="d-flex justify-content-center col-12 col-lg-6 position-relative search-form">
        @if($method === 'POST')
            @csrf
        @endif
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="{{ $placeholder }}"
            value = "{{ $formValue }}"
            {{ $required ? 'required' : ''}}
        />
        <button type="submit" class="btn-yellow search-form-button">
            {{ $buttonText }}
        </button>
    </form>
</div>
