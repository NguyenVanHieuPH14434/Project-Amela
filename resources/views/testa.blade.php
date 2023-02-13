@foreach ($product->attributeProduct as $i)
    {{-- @foreach ($attr as $it) --}}
        @if($i->pivot->product_id == 21 && $i->pivot->color_id == 14 && $i->pivot->size_id == 11)
            {{ $i->pivot->price }}
        @endcan
    {{-- @endforeach --}}
@endforeach
