@inject('constanst', 'App\Constant\Constanst')
<div style="width: 900px; margin: 0 auto">

    <h2>Xin chào {{$mailData['customer']}}</h2>
    {{-- <h4>Đơn hàng của bạn đã được giao {{$format_date}}</h4> --}}
    
    <h2 style="text-align: center">Thông tin nhận hàng</h2>
    <h4>Mã đơn hàng: {{$mailData['code_order']}}</h4>
    
        <p><b>Họ và tên:</b> {{$mailData['customer']}}</p>
        <p><b>Email:</b> {{$mailData['email']}}</p>
        <p><b>SĐT:</b> {{$mailData['phone']}}</p>
        <p><b>Địa chỉ:</b> {{$mailData['address']}}</p>
        <p><b>Tổng tiền: <span>{{number_format($mailData['total_price'])}} Vnđ</span> </b> </p>
    
    <h2 style="text-align: center">Danh sách sản phẩm</h2>
    
    <table border="1" style="border-collapse: collapse">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Màu sắc</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                {{-- <th></th> --}}
            </tr>
        </thead>
    
        <tbody>
    
    
            @foreach ($mailData['items'] as $item)
    
    
            <tr id="dataCart">
                <td>{{ $item['getProduct']['product_name'] }}</td>
                <td><img src="{{ $constanst::BASE_URL.'/'.$item['getProduct']['product_image'] }}" alt=""></td>
                <td>{{ $item['getAttrColor']['attr_name'] }}</td>
                <td>{{ $item['getAttrSize']['attr_name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ $item['price'] }}</td>
                <td>{{ $item['price'] * $item['quantity'] }}</td>
                {{-- <td class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img src="{{ asset($item->product->image)}}" width="100px" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <h6>{{ $item->product->name}}</h6>
                        <h5>{{ number_format($item->product->price)}}</h5>
                    </div>
                </td>
                <td class="quantity__item">
                    <div class="quantity">
                        <div class="pro-qty-2">
                          <span>{{ $item->quantity}}</span>
                        </div>
                    </div>
                </td>
                <td class="cart__price">{{ number_format($item->quantity *  $item->product->price) }}</td> --}}
    
            </tr>
            @endforeach
    
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Tổng tiền</th>
                <th colspan="2">{{number_format($mailData['total_price'])}} Vnđ</th>
            </tr>
        </tfoot>
    </table>
    
    </div>