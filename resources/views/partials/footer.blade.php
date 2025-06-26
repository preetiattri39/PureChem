<!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="scroll-to-top">
  ↑
</button>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img
                    src="{{ asset($globalFooterData['siteLogo']['1x']) }}"
                    srcset="
                        {{ asset($globalFooterData['siteLogo']['1x']) }} 1x,
                        {{ asset($globalFooterData['siteLogo']['2x']) }} 2x,
                        {{ asset($globalFooterData['siteLogo']['3x']) }} 3x
                    "
                    alt="Swizchem Logo"
                    class="logo"
                    style="height: 55px;"
                />
                <p class="mt-3 footer-quote">{!! $globalFooterData['footer-quote'] !!}</p>
            </div>

            <div class="col-md-3">
                <h6>Quick Links</h6>
                <ul class="d-flex flex-column gap-3 list-unstyled">
                    @foreach ($globalFooterData['quickLinks'] as $link)
                        <li>
                            <a href="{{ route($link['url']) }}">{{ $link['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-3">
                <h6>Contact</h6>
                @foreach ($globalFooterData['contact'] as $contact)
                    <p><i class="{{ $contact['icon'] }}"></i> {{ $contact['label'] }}</p>
                @endforeach
            </div>

            <div class="col d-flex justify-content-end">
                <div class="fs-2 fw-normal">
                    @foreach ($globalFooterData['social'] as $social)
                        <a href="{{ route($social['url']) }}" class="text-light me-3" title="{{ ucfirst($social['title']) }}">
                            <i class="{{ $social['icon'] }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center mt-5 small">
            {{ $globalFooterData['rights'] }}
        </div>
    </div>
</footer>
