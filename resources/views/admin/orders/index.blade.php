@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>
        الطلبات
    </h1>

</div>

<div class="row">

    @foreach($orders as $order)

        <div class="col-md-6 mb-4">

            <div class="admin-box">

                <h3>
                    {{ $order->customer_name }}
                </h3>

                <p>
                    📞 {{ $order->phone }}
                </p>

                <p>
                    📍 {{ $order->address }}
                </p>

                <p>
                    🚚 {{ $order->delivery_area }}
                </p>

                <hr>

                <h4 style="color:#ff9800;">
                    الطلبات:
                </h4>

                <pre style="color:#ddd;white-space:pre-wrap;">{{ $order->items }}</pre>

                <hr>

                <p>
                    💰 مجموع الطلب:
                    {{ $order->items_total }} IQD
                </p>

                <p>
                    🚚 التوصيل:
                    {{ $order->delivery_price }} IQD
                </p>

                <h3 style="color:#ff9800;">
                    المجموع الكلي:
                    {{ $order->total_price }} IQD
                </h3>

                @if($order->notes)

                    <hr>

                    <p>
                        📝 {{ $order->notes }}
                    </p>

                @endif

                <form method="POST"
                      action="{{ route('orders.destroy', $order->id) }}"
                      onsubmit="return confirm('حذف الطلب؟')">

                    @csrf
                    @method('DELETE')

                    <button class="btn-red">
                        حذف الطلب
                    </button>

                </form>

            </div>

        </div>

    @endforeach

</div>

@endsection