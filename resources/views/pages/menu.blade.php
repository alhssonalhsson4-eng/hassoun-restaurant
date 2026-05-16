@extends('layouts.site')

@section('content')

<div class="menu-page">

    <div class="container">

        <div class="menu-header">
            <h1>منيو الحسون</h1>
            <p>اختر أكلاتك المفضلة وأضفها للسلة بسهولة</p>
        </div>

        <div class="category-tabs">
            @foreach($categories as $category)
                <a href="#cat-{{ $category->id }}" class="category-tab">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        @foreach($categories as $category)

            <section id="cat-{{ $category->id }}" class="category-section">

                <h2 class="category-title">
                    {{ $category->name }}
                </h2>

                <div class="menu-grid">

                    @foreach($category->items as $item)

                        <div class="food-card">

                            <div class="food-image-wrap">

                                @if($item->image)
                                    <img src="{{ asset('uploads/items/' . $item->image) }}"
                                         class="food-image"
                                         alt="{{ $item->name }}">
                                @else
                                    <div class="food-placeholder">
                                        🍽️
                                    </div>
                                @endif

                                <button type="button"
                                        class="quick-add"
                                        onclick="addToCart('{{ $item->id }}', '{{ $item->name }}', {{ $item->price }})">
                                    +
                                </button>

                            </div>

                            <div class="food-info">

                                <h3>{{ $item->name }}</h3>

                                <p>{{ $item->description }}</p>

                                <div class="food-bottom">

                                    <strong>
                                        {{ number_format($item->price) }} د.ع
                                    </strong>

                                    <div class="qty-control">

                                        <button type="button"
                                                onclick="decreaseItem('{{ $item->id }}')">
                                            -
                                        </button>

                                        <span id="qty-{{ $item->id }}">0</span>

                                        <button type="button"
                                                onclick="addToCart('{{ $item->id }}', '{{ $item->name }}', {{ $item->price }})">
                                            +
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>

        @endforeach

    </div>

</div>

<div class="confirm-order-box" id="confirmOrderBox">
    <button type="button" onclick="goToCart()">
        تأكيد الطلب 🛒
    </button>
</div>

<div id="cartPanel" class="cart-panel-custom">

    <div class="cart-header">
        <h3>سلة الطلبات</h3>

        <button type="button" onclick="toggleCartPanel()">
            ×
        </button>
    </div>

    <div id="cartItems"></div>

    <hr>

    <select id="deliveryArea" class="form-control mb-3" onchange="renderCart()">
        <option value="" data-price="0">اختر منطقة التوصيل</option>

        @foreach($deliveryAreas as $area)
            <option value="{{ $area->name }}" data-price="{{ $area->price }}">
                {{ $area->name }} - {{ number_format($area->price) }} د.ع
            </option>
        @endforeach
    </select>

    <div class="totals-box">
        <p>مجموع الطلب: <span id="itemsTotal">0</span> د.ع</p>
        <p>سعر التوصيل: <span id="deliveryPrice">0</span> د.ع</p>
        <h4>المجموع الكلي: <span id="total">0</span> د.ع</h4>
    </div>

    <hr>

    <input id="customerName" class="form-control mb-2" placeholder="اسم الزبون">

    <input id="customerPhone" class="form-control mb-2" placeholder="رقم الهاتف">

    <textarea id="customerAddress" class="form-control mb-2" placeholder="العنوان"></textarea>

    <textarea id="customerNotes" class="form-control mb-3" placeholder="ملاحظات"></textarea>

    <button type="button" class="send-order-btn" onclick="sendOrder()">
        إرسال الطلب واتساب
    </button>

</div>

<style>
    .menu-page{
        background:#050816;
        min-height:100vh;
        padding:40px 0 140px;
        color:white;
    }

    .menu-header{
        text-align:center;
        margin-bottom:25px;
    }

    .menu-header h1{
        color:#ff9800;
        font-weight:900;
        font-size:42px;
    }

    .menu-header p{
        color:#cfd8e3;
        font-size:18px;
    }

    .category-tabs{
        display:flex;
        gap:12px;
        overflow-x:auto;
        padding:15px 5px 25px;
        position:sticky;
        top:0;
        z-index:50;
        background:#050816;
    }

    .category-tabs::-webkit-scrollbar{
        height:6px;
    }

    .category-tab{
        min-width:max-content;
        background:#101b33;
        color:white;
        border:1px solid rgba(255,255,255,.12);
        padding:14px 24px;
        border-radius:16px;
        text-decoration:none;
        font-weight:bold;
        transition:.2s;
    }

    .category-tab:hover{
        background:#ff9800;
        color:white;
    }

    .category-section{
        padding-top:25px;
        margin-bottom:45px;
    }

    .category-title{
        color:#ff9800;
        font-weight:900;
        margin-bottom:22px;
        font-size:34px;
        border-right:5px solid #ff9800;
        padding-right:14px;
    }

    .menu-grid{
        display:grid;
        grid-template-columns:repeat(4, 1fr);
        gap:24px;
    }

    .food-card{
        background:#0b1324;
        border:1px solid rgba(255,255,255,.13);
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 18px 40px rgba(0,0,0,.35);
        transition:.25s;
    }

    .food-card:hover{
        transform:translateY(-5px);
        border-color:#ff9800;
    }

    .food-image-wrap{
        position:relative;
        height:190px;
        background:#101b33;
        overflow:hidden;
    }

    .food-image{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }

    .food-placeholder{
        width:100%;
        height:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:60px;
        background:linear-gradient(135deg,#121d35,#050816);
    }

    .quick-add{
        position:absolute;
        left:14px;
        bottom:14px;
        width:48px;
        height:48px;
        border-radius:50%;
        border:none;
        background:#ff9800;
        color:white;
        font-size:30px;
        font-weight:bold;
        box-shadow:0 10px 25px rgba(0,0,0,.35);
    }

    .food-info{
        padding:18px;
    }

    .food-info h3{
        color:white;
        font-size:22px;
        font-weight:900;
        margin-bottom:8px;
        min-height:56px;
    }

    .food-info p{
        color:#cfd8e3;
        font-size:15px;
        min-height:44px;
        margin-bottom:15px;
    }

    .food-bottom{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
    }

    .food-bottom strong{
        color:#ff9800;
        font-size:21px;
        font-weight:900;
        white-space:nowrap;
    }

    .qty-control{
        display:flex;
        align-items:center;
        gap:8px;
        background:#050816;
        padding:6px;
        border-radius:14px;
    }

    .qty-control button{
        width:34px;
        height:34px;
        border:none;
        border-radius:10px;
        background:#ff9800;
        color:white;
        font-size:22px;
        font-weight:bold;
        line-height:1;
    }

    .qty-control span{
        min-width:26px;
        text-align:center;
        font-size:18px;
        font-weight:bold;
    }

    .confirm-order-box{
        position:fixed;
        left:50%;
        transform:translateX(-50%);
        bottom:95px;
        width:90%;
        max-width:420px;
        z-index:999999;
        display:none;
    }

    .confirm-order-box button{
        width:100%;
        background:#198754;
        color:white;
        border:none;
        padding:16px;
        border-radius:18px;
        font-weight:bold;
        font-size:18px;
        box-shadow:0 10px 25px rgba(0,0,0,.35);
    }

    .cart-panel-custom{
        position:fixed;
        left:18px;
        bottom:165px;
        width:430px;
        max-height:75vh;
        overflow-y:auto;
        background:#081122;
        border-radius:24px;
        padding:22px;
        display:none;
        z-index:999999;
        border:1px solid rgba(255,255,255,.15);
        box-shadow:0 20px 45px rgba(0,0,0,.50);
        color:white;
    }

    .cart-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:15px;
    }

    .cart-header h3{
        color:#ff9800;
        font-weight:bold;
        margin:0;
    }

    .cart-header button{
        background:#c62828;
        color:white;
        border:none;
        width:42px;
        height:42px;
        border-radius:12px;
        font-size:26px;
        font-weight:bold;
    }

    .cart-row{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:10px;
        border-bottom:1px solid rgba(255,255,255,.15);
        padding:12px 0;
    }

    .cart-row strong{
        color:white;
        font-size:17px;
    }

    .cart-row small{
        color:#ddd;
    }

    .cart-remove{
        background:#c62828;
        color:white;
        border:none;
        padding:8px 14px;
        border-radius:10px;
        font-weight:bold;
    }

    .totals-box{
        background:#050816;
        border:1px solid rgba(255,255,255,.12);
        border-radius:16px;
        padding:15px;
        margin-top:12px;
    }

    .totals-box p{
        margin:6px 0;
        font-size:18px;
        color:white;
    }

    .totals-box h4{
        margin-top:10px;
        color:#ff9800;
        font-weight:bold;
    }

    .cart-panel-custom .form-control{
        background:#ffffff !important;
        color:#000000 !important;
        border:1px solid #ff9800 !important;
        font-weight:bold !important;
        min-height:55px;
        border-radius:12px;
        padding:15px;
    }

    .cart-panel-custom textarea.form-control{
        min-height:120px;
    }

    .cart-panel-custom .form-control::placeholder{
        color:#555555 !important;
        opacity:1 !important;
    }

    .send-order-btn{
        width:100%;
        background:#ff9800;
        color:white;
        border:none;
        padding:16px;
        border-radius:16px;
        font-weight:bold;
        font-size:18px;
    }

    @media(max-width:1200px){
        .menu-grid{
            grid-template-columns:repeat(3, 1fr);
        }
    }

    @media(max-width:768px){
        .menu-page{
            padding-top:25px;
        }

        .menu-header h1{
            font-size:32px;
        }

        .menu-grid{
            grid-template-columns:1fr;
            gap:18px;
        }

        .food-card{
            display:flex;
            min-height:150px;
        }

        .food-image-wrap{
            width:38%;
            height:auto;
            min-height:160px;
            flex-shrink:0;
        }

        .food-info{
            flex:1;
            padding:14px;
        }

        .food-info h3{
            font-size:19px;
            min-height:auto;
        }

        .food-info p{
            font-size:14px;
            min-height:auto;
        }

        .food-bottom{
            align-items:flex-start;
            flex-direction:column;
        }

        .cart-panel-custom{
            width:92%;
            left:4%;
            bottom:145px;
            max-height:72vh;
        }

        .confirm-order-box{
            bottom:82px;
        }
    }
</style>

<script>
    let cart = [];

    function toggleCartPanel()
    {
        let panel = document.getElementById('cartPanel');

        panel.style.display =
            panel.style.display === 'block' ? 'none' : 'block';

        renderCart();
    }

    document.querySelector('.floating-cart')?.addEventListener('click', function(e){
        e.preventDefault();
        toggleCartPanel();
    });

    function showConfirmButton()
    {
        let box = document.getElementById('confirmOrderBox');

        box.style.display = cart.length > 0 ? 'block' : 'none';
    }

    function goToCart()
    {
        let panel = document.getElementById('cartPanel');

        panel.style.display = 'block';

        renderCart();
    }

    function addToCart(id, name, price)
    {
        let item = cart.find(i => i.id == id);

        if (item) {
            item.qty++;
        } else {
            cart.push({
                id: id,
                name: name,
                price: price,
                qty: 1
            });
        }

        renderCart();
        showConfirmButton();
    }

    function decreaseItem(id)
    {
        let item = cart.find(i => i.id == id);

        if (!item) return;

        item.qty--;

        if (item.qty <= 0) {
            cart = cart.filter(i => i.id != id);
        }

        renderCart();
        showConfirmButton();
    }

    function removeFromCart(id)
    {
        cart = cart.filter(i => i.id != id);

        renderCart();
        showConfirmButton();
    }

    function getDeliveryPrice()
    {
        let select = document.getElementById('deliveryArea');
        let selectedOption = select.options[select.selectedIndex];

        return Number(selectedOption.getAttribute('data-price')) || 0;
    }

    function getDeliveryName()
    {
        return document.getElementById('deliveryArea').value;
    }

    function renderCart()
    {
        let cartBox = document.getElementById('cartItems');
        let itemsTotal = 0;

        cartBox.innerHTML = '';

        document.querySelectorAll('[id^="qty-"]').forEach(el => {
            el.innerText = 0;
        });

        cart.forEach(item => {

            let itemTotal = item.price * item.qty;

            itemsTotal += itemTotal;

            let qtyBox = document.getElementById('qty-' + item.id);

            if (qtyBox) {
                qtyBox.innerText = item.qty;
            }

            cartBox.innerHTML += `
                <div class="cart-row">
                    <div>
                        <strong>${item.name}</strong><br>
                        <small>${item.qty} × ${item.price} = ${itemTotal} د.ع</small>
                    </div>

                    <button type="button"
                            class="cart-remove"
                            onclick="removeFromCart('${item.id}')">
                        حذف
                    </button>
                </div>
            `;
        });

        let deliveryPrice = getDeliveryPrice();
        let finalTotal = itemsTotal + deliveryPrice;

        document.getElementById('itemsTotal').innerText = itemsTotal;
        document.getElementById('deliveryPrice').innerText = deliveryPrice;
        document.getElementById('total').innerText = finalTotal;
    }

    async function sendOrder()
    {
        let name = document.getElementById('customerName').value.trim();
        let phone = document.getElementById('customerPhone').value.trim();
        let address = document.getElementById('customerAddress').value.trim();
        let notes = document.getElementById('customerNotes').value.trim();

        let deliveryName = getDeliveryName();
        let deliveryPrice = getDeliveryPrice();

        let itemsTotal = document.getElementById('itemsTotal').innerText;
        let total = document.getElementById('total').innerText;

        if(cart.length===0){
            alert('السلة فارغة');
            return;
        }

        if(!deliveryName){
            alert('اختر منطقة التوصيل');
            return;
        }

        if(!name || !phone || !address){
            alert('اكتب الاسم ورقم الهاتف والعنوان');
            return;
        }

        let message = `طلب جديد من مطعم الحسون\n\n`;

        message += `الاسم: ${name}\n`;
        message += `الهاتف: ${phone}\n`;
        message += `العنوان: ${address}\n`;
        message += `منطقة التوصيل: ${deliveryName}\n`;
        message += `الملاحظات: ${notes}\n\n`;
        message += `الطلبات:\n`;

        cart.forEach(item=>{
            message += `- ${item.name} × ${item.qty} = ${item.price * item.qty} د.ع\n`;
        });

        message += `\nمجموع الطلب: ${itemsTotal} د.ع`;
        message += `\nسعر التوصيل: ${deliveryPrice} د.ع`;
        message += `\nالمجموع الكلي: ${total} د.ع`;

        try{
            await fetch('/save-order',{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                },
                body:JSON.stringify({
                    customer_name:name,
                    phone:phone,
                    address:address,
                    notes:notes,
                    total_price:total
                })
            });
        }catch(e){
            console.log('save failed');
        }

        let whatsappNumber = '{{ $setting->order_whatsapp ?? "9647700000000" }}';

        window.location.href =
        `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
    }
</script>

@endsection