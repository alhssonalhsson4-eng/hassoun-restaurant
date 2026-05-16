@extends('layouts.admin')

@section('content')

<div class="row">

    <div class="col-md-4 mb-4">
        <a href="/settings" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">⚙️ إعدادات الموقع</h2>
                <p>تعديل اسم المطعم، الصور، الألوان، أرقام الواتساب.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/location" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">🌐 موقعنا</h2>
                <p>تعديل العنوان ورابط Google Maps.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/ai-assistant" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">🤖 مساعد الحسون AI</h2>
                <p>إضافة معلومات الأكلات والأسعار حتى يجاوب المساعد.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/printer-settings" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">🖨️ إعدادات الطابعة</h2>
                <p>تعديل IP الطابعة وبورت الطباعة التلقائية.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/categories" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">📂 الأقسام</h2>
                <p>إضافة وتعديل أقسام المنيو.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/items" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">🍔 المنيو والأصناف</h2>
                <p>إضافة الأكلات والأسعار والصور.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/orders" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">🧾 الطلبات</h2>
                <p>مشاهدة طلبات الزبائن وإدارتها.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/ratings" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">⭐ التقييمات</h2>
                <p>إدارة أقسام وخيارات التقييم.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/pages" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">📖 النبذة / الصفحات</h2>
                <p>إضافة بطاقات النبذة والصور والوصف.</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="/delivery-areas" style="text-decoration:none;">
            <div class="admin-box">
                <h2 style="color:#ff9800;">🚚 مناطق التوصيل</h2>
                <p>إضافة مناطق التوصيل وأسعارها.</p>
            </div>
        </a>
    </div>

</div>

@endsection