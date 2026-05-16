<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الحسون</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body{margin:0;background:#050816;color:white;font-family:Tahoma;}
        .sidebar{position:fixed;right:0;top:0;width:260px;height:100vh;background:#081122;overflow-y:auto;padding:20px;border-left:1px solid rgba(255,255,255,.1);}
        .sidebar h2{color:#ff9800;text-align:center;margin-bottom:25px;font-weight:bold;}
        .sidebar a{display:block;background:#101b33;color:white;text-decoration:none;padding:14px;border-radius:14px;margin-bottom:12px;font-weight:bold;}
        .sidebar a:hover{background:#ff9800;color:white;}
        .content{margin-right:280px;padding:25px;}
        .admin-box{background:#081122;border-radius:22px;padding:22px;border:1px solid rgba(255,255,255,.1);box-shadow:0 15px 35px rgba(0,0,0,.35);}
        .admin-box h1,.admin-box h2,.admin-box h3{color:#ff9800;font-weight:bold;}
        .form-control{background:#fff !important;color:#000 !important;border-radius:14px;min-height:52px;margin-bottom:15px;}
        textarea.form-control{min-height:120px;}
        .btn-orange{background:#ff9800;color:white;border:none;padding:12px 22px;border-radius:14px;font-weight:bold;}
        .btn-red{background:#c62828;color:white;border:none;padding:10px 18px;border-radius:12px;font-weight:bold;}
        table{width:100%;}
        table th{background:#101b33;color:white;}
        table th,table td{padding:12px;border-bottom:1px solid rgba(255,255,255,.1);color:white;}

        @media(max-width:991px){
            .sidebar{width:100%;height:auto;position:relative;border:none;}
            .content{margin-right:0;padding:15px;}
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>🍴 الحسون</h2>

    <a href="/dashboard">🏠 الرئيسية</a>
    <a href="/items">🍔 المنيو والأصناف</a>
    <a href="/categories">📂 الأقسام</a>
    <a href="/orders">🧾 الطلبات</a>
    <a href="/delivery-areas">🚚 مناطق التوصيل</a>
    <a href="/ratings">⭐ التقييمات</a>
    <a href="/pages">📖 النبذة / الصفحات</a>
    <a href="/location">🌐 موقعنا</a>
    <a href="/ai-assistant">🤖 مساعد الحسون AI</a>
    <a href="/printer-settings">🖨️ إعدادات الطابعة</a>
    <a href="/settings">⚙️ إعدادات الموقع</a>
    <a href="/">🌍 فتح الموقع</a>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:20px;">
        @csrf
        <button type="submit" class="btn-red" style="width:100%;">
            تسجيل الخروج
        </button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>