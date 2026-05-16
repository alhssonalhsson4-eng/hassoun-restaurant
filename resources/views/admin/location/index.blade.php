@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>إعدادات موقعنا</h1>

    <form method="POST" action="{{ route('location.update') }}">

        @csrf

        <div class="mb-4">

            <label class="form-label">
                العنوان
            </label>

            <input type="text"
                   name="address"
                   class="form-control"
                   value="{{ $setting->address ?? '' }}">

        </div>

        <div class="mb-4">

            <label class="form-label">
                رابط Google Maps
            </label>

            <input type="text"
                   name="map_url"
                   class="form-control"
                   value="{{ $setting->map_url ?? '' }}">

        </div>

        <div class="mb-4">

            <label class="form-label">
                معاينة الخريطة (Embed iframe)
            </label>

            <textarea
                name="map_embed"
                class="form-control"
                rows="10"
                style="direction:ltr;">{{ $setting->map_embed ?? '' }}</textarea>

        </div>

        <button class="btn-orange">
            حفظ الموقع
        </button>

    </form>

</div>

@if(!empty($setting->map_embed))

    <div class="admin-box mt-4">

        <h2>معاينة الخريطة</h2>

        <div style="overflow:hidden;border-radius:20px;margin-top:20px;">

            {!! $setting->map_embed !!}

        </div>

    </div>

@endif

@endsection