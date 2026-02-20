@extends('frontend.app.app')
@section('main')
    <main>
        <section class="hero font-poppins">
            <div class="bg-[url("{{ asset('frontend-assets/images/banner.jpg') }}")] bg-cover h-100 flex justify-center items-end">
                <div class="flex lg:flex-wrap justify-between items-center bg-white px-4 py-2 mb-5">
                    <div><p class="">You are on amazon.com. You can also shop on Amazon India for millions of products with fast local delivery.</p></div>
                    <div><a class="px-3 text-[#007185]" href="">Click here to go to amazon.in</a></div>
                </div>
            </div>
        </section>
        <section class="bg-gray-200 py-5 px-8 font-poppins">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 py-2">
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Shop school essentials</h3>
                        <img src="{{ asset('frontend-assets/images/1.jpg') }}" alt="">
                    </a>
                </div>
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Home & Kitchen Under $30</h3>
                        <img src="{{ asset('frontend-assets/images/2.jpg') }}" alt="">
                    </a>
                </div>
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Beauty picks</h3>
                        <img src="{{ asset('frontend-assets/images/3.jpg') }}" alt="">
                    </a>
                </div>
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Electronics</h3>
                        <img src="{{ asset('frontend-assets/images/4.jpg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 py-2">
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Shop school essentials</h3>
                        <img src="{{ asset('frontend-assets/images/5.jpg') }}" alt="">
                    </a>
                </div>
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Shop school essentials</h3>
                        <img src="{{ asset('frontend-assets/images/6.jpg') }}" alt="">
                    </a>
                </div>
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Shop school essentials</h3>
                        <img src="{{ asset('frontend-assets/images/7.jpg') }}" alt="">
                    </a>
                </div>
                <div class="bg-white p-4">
                    <a href="">
                        <h3>Shop school essentials</h3>
                        <img src="{{ asset('frontend-assets/images/8.jpg') }}" alt="">
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection
