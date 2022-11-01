{{--{{dd($search)}}--}}
<x-layout>
    @include('partials._hero')
    @include('partials._search')

    @if(isset($search))
        <div class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <p class="text-center">You search for: <b>{{$search}}</b></p>
        </div>
    @endif
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(count($listings) > 0)
            @foreach($listings as $listing)
                <x-listing-card :listing="$listing"></x-listing-card>
            @endforeach
        @else
            <div class="px-4 py-8">
                <p class="">No Listing Available</b></p>
            </div>
        @endif
    </div>
    {{--  Pagination  --}}
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
</x-layout>
