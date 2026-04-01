@extends('frontend.app.app')
@section('main')

    <section class="py-10 mx-10 mt-32">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
             <div class="rounded">
                @if($product->product_images)
                    @foreach($product->product_images as $key => $productImage)
                        <div class="{{ ($key == 0) ? 'active' : '' }}">
                            <img class="h-full w-full object-cover rounded border" src="{{ $productImage->image_large_url ?? $productImage->image_url }}" alt="{{ $productImage->title }}">
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <h2 class="text-2xl font-semibold">{{ $product->title }}</h2>
                        <p>{{ $product->short_description }}</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, labore! Labore, recusandae sequi! Laudantium laborum eos ut fugiat error ab cum similique culpa dolores accusantium, eum quasi omnis quas nobis!</p>
                    </div>
                    <div class="flex flex-col border p-4 rounded space-y-3">
                        <h2 class="text-2xl font-bold">{{ number_format($product->price, 0, '.', ' ') }} CFA</h2>
                        <label for="Headline">
                            <span class="text-sm font-medium text-gray-700"> En stock </span>
                            <select name="Headline" id="Headline" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm">
                                <option value="">Quantity</option>
                                <option value="JM">1</option>
                                <option value="SRV">2</option>
                                <option value="JH">3</option>
                            </select>
                        </label>
                        <a href="" class=" bg-orange-500 w-full text-center text-orange-50 py-2 px-3 rounded">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
