@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>إعدادات الموقع</h1>

    <form method="POST"
          action="{{ route('settings.update') }}"
          enctype="multipart/form-data">

        @csrf

        <label>اسم المطعم عربي</label>
        <input type="text"
               name="restaurant_name_ar"
               class="form-control"
               value="{{ $setting->restaurant_name_ar }}">

        <label>اسم المطعم إنكليزي</label>
        <input type="text"
               name="restaurant_name_en"
               class="form-control"
               value="{{ $setting->restaurant_name_en }}">

        <label>الشعار / الوصف عربي</label>
        <textarea name="slogan_ar"
                  class="form-control">{{ $setting->slogan_ar }}</textarea>

        <label>الشعار / الوصف إنكليزي</label>
        <textarea name="slogan_en"
                  class="form-control">{{ $setting->slogan_en }}</textarea>

        <label>رقم واتساب الطلبات — بدون + وبدون صفر</label>
        <input type="text"
               name="order_whatsapp"
               class="form-control"
               value="{{ $setting->order_whatsapp }}">

        <label>رقم واتساب التقييم — بدون + وبدون صفر</label>
        <input type="text"
               name="rating_whatsapp"
               class="form-control"
               value="{{ $setting->rating_whatsapp }}">

        <label>العنوان</label>
        <textarea name="address"
                  class="form-control">{{ $setting->address }}</textarea>

        <label>رابط الخريطة</label>
        <input type="text"
               name="map_url"
               class="form-control"
               value="{{ $setting->map_url }}">

        <label>صورة الواجهة</label>
        <input type="file"
               name="hero_image"
               class="form-control">

        <label>لون الثيم الرئيسي</label>
        <input type="color"
               name="theme_color"
               class="form-control"
               value="{{ $setting->theme_color ?? '#ff9800' }}">

        <label>لون الأزرار</label>
        <input type="color"
               name="button_color"
               class="form-control"
               value="{{ $setting->button_color ?? '#ff9800' }}">

        <label>لون الخلفية</label>
        <input type="color"
               name="background_color"
               class="form-control"
               value="{{ $setting->background_color ?? '#050816' }}">

        <label>لون النصوص</label>
        <input type="color"
               name="text_color"
               class="form-control"
               value="{{ $setting->text_color ?? '#ffffff' }}">

        <button class="btn-orange mt-4">
            حفظ الإعدادات
        </button>

    </form>

</div>

@endsection