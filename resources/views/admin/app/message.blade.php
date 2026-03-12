@if (Session::has('error'))
    <div role="alert" class="border-2 bg-red-100 p-4 my-8 text-red-900 shadow-sm">
        <div class="flex items-start gap-3">
            <i class="fa fa-check-circle text-green-500"></i>

            <strong class="block flex-1 leading-tight font-semibold">
                <strong>ERROR!</strong> {{ Session::get('error') }}.
            </strong>
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div role="alert" class="border-2 bg-green-100 p-4 my-8 text-green-900 shadow-sm">
        <div class="flex items-start gap-3">
            <i class="fa fa-check-circle text-green-500"></i>

            <strong class="block flex-1 leading-tight font-semibold">
            {{ Session::get('success') }}.
            </strong>
        </div>
    </div>
@endif
