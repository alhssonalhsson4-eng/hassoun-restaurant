@extends('layouts.site')

@section('content')

<div class="container py-5">

    <h1 class="section-title">
        التقييم
    </h1>

    <p class="text-center mb-4"
       style="color:#44556b;">
        اختر التقييم المناسب لكل قسم
    </p>

    <div class="row">

        @foreach($ratingCategories as $category)

            <div class="col-12 col-md-6 col-lg-3 mb-4">

                <div class="rating-card">

                    <div class="rating-icon">
                        {{ $category->icon }}
                    </div>

                    <h3>
                        {{ $category->name }}
                    </h3>

                    @foreach($category->options as $option)

                        <button type="button"
                                class="rating-option"
                                onclick="selectRating('{{ $category->name }}', '{{ $option->name }}', this)">

                            {{ $option->name }}

                        </button>

                    @endforeach

                </div>

            </div>

        @endforeach

    </div>

    <div class="row mt-4">

        <div class="col-md-6 mb-3">

            <input type="text"
                   id="ratingPhone"
                   class="form-control"
                   placeholder="رقم الهاتف">

        </div>

        <div class="col-md-6 mb-3">

            <input type="text"
                   id="ratingCustomer"
                   class="form-control"
                   placeholder="اسم الزبون">

        </div>

        <div class="col-12 mb-3">

            <textarea id="ratingNote"
                      class="form-control"
                      rows="5"
                      placeholder="اكتب ملاحظاتك هنا"></textarea>

        </div>

        <div class="col-12 text-end">

            <button class="send-rating-btn"
                    onclick="sendRatingWhatsApp()">

                إرسال التقييم واتساب

            </button>

        </div>

    </div>

</div>

<style>

    body{
        background:#eef5fb !important;
        color:#06162d !important;
    }

    .rating-card{

        background:white;

        border:1px solid #d8e1ec;

        border-radius:14px;

        padding:28px 24px;

        text-align:center;

        height:100%;
    }

    .rating-icon{

        font-size:48px;

        margin-bottom:14px;
    }

    .rating-card h3{

        color:#06162d;

        font-weight:bold;

        margin-bottom:20px;
    }

    .rating-option{

        width:100%;

        background:white;

        border:1px solid #d6d6d6;

        border-radius:10px;

        padding:13px;

        margin-bottom:12px;

        font-weight:bold;

        color:#000;

        transition:.2s;
    }

    .rating-option:hover{

        background:#fff3df;
    }

    .rating-option.active{

        background:#ff9800;

        color:white;

        border-color:#ff9800;
    }

    .send-rating-btn{

        background:#f28c00;

        color:white;

        border:none;

        padding:14px 35px;

        border-radius:10px;

        font-weight:bold;

        box-shadow:0 10px 25px rgba(0,0,0,.20);
    }

    .form-control{

        background:#ffffff !important;

        color:#000000 !important;

        border:1px solid #cfd8e3 !important;

        font-weight:bold !important;

        min-height:55px;

        border-radius:10px;

        padding:15px;
    }

    textarea.form-control{

        min-height:140px;
    }

    .form-control::placeholder{

        color:#555555 !important;

        opacity:1 !important;
    }

    @media(max-width:768px){

        .rating-card{

            margin-bottom:10px;
        }

        .send-rating-btn{

            width:100%;
        }

    }

</style>

<script>

    let selectedRatings = {};

    function selectRating(category, option, btn)
    {
        selectedRatings[category] = option;

        let parent = btn.parentElement;

        parent.querySelectorAll('.rating-option').forEach(el => {

            el.classList.remove('active');

        });

        btn.classList.add('active');
    }

    function sendRatingWhatsApp()
    {
        let customer =
            document.getElementById('ratingCustomer').value;

        let phone =
            document.getElementById('ratingPhone').value;

        let note =
            document.getElementById('ratingNote').value;

        let message =
            `تقييم جديد من الموقع%0A%0A`;

        if(customer){

            message += `الاسم: ${customer}%0A`;

        }

        if(phone){

            message += `الهاتف: ${phone}%0A`;

        }

        Object.entries(selectedRatings).forEach(([category, value]) => {

            message += `${category}: ${value}%0A`;

        });

        if(note){

            message += `%0Aالملاحظات:%0A${note}`;

        }

        let whatsappNumber =
            '{{ $setting->rating_whatsapp ?? $setting->order_whatsapp ?? "9647700000000" }}';

        window.open(
            `https://wa.me/${whatsappNumber}?text=${message}`,
            '_blank'
        );
    }

</script>

@endsection