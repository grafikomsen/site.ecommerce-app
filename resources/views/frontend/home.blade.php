@extends('frontend.app.app')
@section('main')
    <main>
        <section class="hero font-poppins">
            <div style="background-image: url('{{ asset('frontend-assets/images/banner.jpg') }}'); background-position: center; height: 60vh" class="flex justify-center items-end">
                <div class="flex lg:flex-wrap justify-between items-center bg-white px-4 py-2 mb-5">
                    <div><p class="">You are on amazon.com. You can also shop on Amazon India for millions of products with fast local delivery.</p></div>
                    <div><a class="px-3 text-[#007185]" href="">Click here to go to amazon.in</a></div>
                </div>
            </div>
        </section>
        <section class="bg-gray-200 py-5 px-8 font-poppins">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 py-2">
                @if(getCategories()->isNotEmpty())
                    @foreach(getCategories() as $category)
                        <div class="bg-white p-4">
                            <a href="{{ route('shop',$category->slug) }}">
                                <h3 class="text-xl">{{ $category->name }}</h3>
                                @if($category->image != "")
                                    <img class="w-[300px]" src="{{ asset('uploads/categories/'.$category->image) }}" alt="">
                                @endif
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </main>
@endsection
