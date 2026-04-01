@extends('frontend.app.app')
@section('main')

<section class="py-10 mt-32">
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8">
        <div class=""></div>
        <div class="lg:col-span-3 px-12">
            <div class="flex flex-col items-start mb-4">
                <h6 class="font-semibold">Résultats</h6>
                <p class="text-sm">En apprendre plus sur ces résultats. Consultez la page de chaque produit pour connaître les autres options dachat.</p>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                @if($products->isNotEmpty())
                    @foreach($products as $product)
                        @php
                            $productImage = $product->product_images->first();
                        @endphp
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('product',$product->slug) }}">
                                @if (!empty($productImage->image_url))
                                    <img  class="h-64 w-full object-cover sm:h-30 lg:h-50" src="{{ $productImage->image_medium_url ?? $productImage->image_url }}" alt="{{ $product->title }}">
                                @else
                                    <img  class="h-64 w-full object-cover sm:h-30 lg:h-50" src="{{ asset('frontend-assets/images/Ficheproduite.commece.png') }}" alt="{{ $product->title }}">
                                @endif
                            </a>
                            <h3 class="mt-2 text-md text-gray-900 sm:text-md">{{ $product->title }}</h3>
                            <div class="flex flex-col items-start gap-0">
                                <h3 class=" text-lg font-bold text-gray-900 md:text-xl">{{ number_format($product->price, 0, '.', ' ') }} CFA</h3>
                                @if ($product->compare_price > 0)
                                    <span class="text-sm">{{ number_format($product->compare_price, 0, '.', ' ') }} CFA</span>
                                @endif
                            </div>
                            <a href="" class=" bg-orange-500 w-full text-center text-orange-50 py-2 px-3 rounded">Ajouter au panier</a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>


@endsection
