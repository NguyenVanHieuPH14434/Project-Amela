@foreach ($product->attributeProduct as $key => $it)
    {{-- @if($it->attr_name == $it->attr_name) --}}
    @if($product->sizeProduct[$key]->pivot->id == $it->pivot->id)
         {{ $it->pivot->stock }}
    @endif
@endforeach

{{-- {{ $product->attributeProduct->pivot->id }} --}}