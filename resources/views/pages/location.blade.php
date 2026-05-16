@extends('layouts.site')

@section('content')

<div class="location-page">

    <div class="container">

        <div class="location-header">

            <h1>موقعنا</h1>

            <p>
                يمكنك الوصول إلينا بسهولة عبر خرائط Google
            </p>

        </div>

        <div class="location-card">

            <div class="location-info">

                <h2>العنوان</h2>

                <p>
                    {{ $setting->address ?? 'لم يتم إضافة العنوان بعد' }}
                </p>

                @if(!empty($setting->map_url))

                    <a href="{{ $setting->map_url }}"
                       target="_blank"
                       class="open-map-btn">

                        فتح الموقع على الخريطة 📍

                    </a>

                @endif

            </div>

            @if(!empty($setting->map_embed))

                <div class="map-frame">

                    {!! $setting->map_embed !!}

                </div>

            @else

                <div class="empty-map">

                    <h3>
                        لم يتم إضافة كود الخريطة بعد
                    </h3>

                    <p>
                        ضع Embed Code من Google Maps داخل لوحة التحكم
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

<style>

.location-page{
    background:#050816;
    min-height:100vh;
    padding:50px 0 120px;
    color:white;
}

.location-header{
    text-align:center;
    margin-bottom:35px;
}

.location-header h1{
    color:#ff9800;
    font-size:50px;
    font-weight:900;
    margin-bottom:10px;
}

.location-header p{
    color:#d7d7d7;
    font-size:18px;
}

.location-card{
    background:#081122;
    border-radius:28px;
    padding:28px;
    border:1px solid rgba(255,255,255,.12);
    box-shadow:0 18px 45px rgba(0,0,0,.35);
}

.location-info{
    margin-bottom:25px;
}

.location-info h2{
    color:#ff9800;
    font-size:34px;
    font-weight:bold;
    margin-bottom:12px;
}

.location-info p{
    color:white;
    font-size:22px;
    line-height:1.8;
}

.open-map-btn{
    display:inline-block;
    margin-top:15px;
    background:#ff9800;
    color:white;
    padding:16px 28px;
    border-radius:18px;
    text-decoration:none;
    font-weight:bold;
    font-size:18px;
    transition:.2s;
}

.open-map-btn:hover{
    background:#e68900;
    color:white;
}

.map-frame{
    overflow:hidden;
    border-radius:22px;
    margin-top:20px;
}

.map-frame iframe{
    width:100% !important;
    height:520px !important;
    border:none !important;
    border-radius:22px;
}

.empty-map{
    background:#101b33;
    border-radius:22px;
    padding:60px 20px;
    text-align:center;
}

.empty-map h3{
    color:#ff9800;
    margin-bottom:12px;
    font-weight:bold;
}

.empty-map p{
    color:#d6d6d6;
}

@media(max-width:768px){

    .location-page{
        padding:30px 0 120px;
    }

    .location-header h1{
        font-size:38px;
    }

    .location-info h2{
        font-size:28px;
    }

    .location-info p{
        font-size:18px;
    }

    .map-frame iframe{
        height:380px !important;
    }

    .open-map-btn{
        width:100%;
        text-align:center;
    }
}

</style>

@endsection