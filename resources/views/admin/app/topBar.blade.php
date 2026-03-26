<div class="overflow-x-auto bg-gray-100 p-4 m-4 rounded-sm shadow-md">
    <nav aria-label="Breadcrumb">
        <div class="flex items-center md:flex-row md:justify-between gap-1 text-sm text-gray-700">
           <div>
                <form method="GET">
                    <div class="flex lg:flex-row">
                        <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="py-2 border-none rounded-l-sm w-[400px]" placeholder="Cherchez ici...">
                    </div>
                </form>
            </div>
            <div>
                <a href="#" class="flex items-center gap-2">
                    <img alt="" src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?auto=format&amp;fit=crop&amp;q=80&amp;w=1160" class="object-cover rounded-full size-10">

                    <div>
                        <p class="text-xs">
                            <strong class="block font-medium">Eric Frusciante</strong>
                            <span> eric@frusciante.com </span>
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </nav>
</div>

