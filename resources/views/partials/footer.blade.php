<!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="scroll-to-top">
  ↑
</button>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('images/icons/footer-logo.svg') }}" alt="Logo" style="height: 55px;" />
                <p class="mt-3 footer-quote">Small Molecules.<br>Profound Science.<br>Real Impact.</p>
            </div>
            <div class="col-md-3">
                <h6>Quick Links</h6>
                <ul class="d-flex flex-column gap-3 list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.main') }}">Products</a></li>
                    <li><a href="{{ route('company') }}">Company</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Contact</h6>
                <p><i class="fa fa-phone me-2"></i>+358 46 5534360</p>
                <p><i class="fa fa-envelope me-2"></i>sales@swizchem.com</p>
                <p><i class="fa fa-location-dot me-2"></i>A326, A.I. Virtasen Aukio 1, 00560 Helsinki, Finland.</p>
            </div>
            <div class="col d-flex justify-content-end">
                <div>
                    <a href="#" class="text-light me-3"><i class="fab fa-instagram fs-2 fw-normal"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook fs-2 fw-normal"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-linkedin fs-2 fw-normal"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-5 small">©2018 - 2025, Swizchem Ltd. All Rights Reserved.</div>
    </div>
</footer>