@extends('layouts.main.mainLayout')

@section('title', 'Chat | Swizchem')
@section('robots', 'noindex, nofollow')

@section('vite')
    @vite(['resources/js/pages/chat.js', 'resources/css/pages/chat.css'])
@endsection


@section('content')

<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Chat Section -->
            <div class="col-lg-8 mb-4">
                <div class="chat-box">
                    <div class="chat-messages d-flex flex-column">
                        <div class="chat-time text-center" id="chatTime">03:01PM</div>
                        <div class="chat-bubble-left mb-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="chat-bubble-right">
                        Lorem Ipsum is simply dummy text of the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </div>
                    </div>
                    <!-- Input area -->
                    <div class="chat-input d-flex align-items-center">
                        <input type="text" class="form-control me-2" placeholder="Send a message">
                        <button class="btn btn-link text-muted me-2"><img src="{{ asset('images/icons/attachment.svg') }}"" ></button>
                        <button class="send-btn text-white"><img src="{{ asset('images/icons/send.svg') }}"" ></button>
                    </div>
                </div>
            </div>
            <!-- Added Products Sidebar -->
            <div class="col-lg-4">
                <div class="card added-products border-0">
                    <div class="card-header">Added Products</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Candesartan Methylester</li>
                        <li class="list-group-item">Candisartan Tetrazole Methyl Ester</li>
                        <li class="list-group-item">2-Butyl-1, 3-diazasp…</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection