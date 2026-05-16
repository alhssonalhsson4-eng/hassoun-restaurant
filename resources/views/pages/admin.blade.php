<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{
            background:#050816;
            color:white;
            font-family:Tahoma;
            margin:0;
        }

        .admin-sidebar{
            position:fixed;
            right:0;
            top:0;
            width:260px;
            height:100vh;
            background:#081122;
            padding:20px;
            border-left:1px solid rgba(255,255,255,.08);
            overflow-y:auto;
        }

        .admin-logo{
            color:#ff9800;
            font-size:34px;
            font-weight:bold;
            text-align:center;
            margin-bottom:25px;
        }

        .admin-menu a{
            display:block;
            background:#101b33;
            color:white;
            text-decoration:none;
            padding:15px;
            border-radius:10px;
            margin-bottom:10px;
            font-weight:bold;
            text-align:center;
        }

        .admin-menu a:hover,
        .admin-menu a.active{
            background:#ff9800;
            color:white;
        }

        .logout-btn{
            background:#b71c1c !important;
        }

        .admin-content{
            margin-right:280px;
            padding:25px;
        }

        .admin-box{
            background:#081122;
            border:1px solid rgba(255,255,255,.08);
            border-radius:18px;
            padding:25px;
            margin-bottom:25px;
        }

        .form-control{
            background:#050816 !important;
            color:white !important;
            border:1px solid rgba(255,255,255,.2) !important;
            min-height:50px;
        }

        label{
            margin-top:15px;
            margin-bottom:8px;
            font-weight:bold;
        }

        .btn-orange{
            background:#ff9800;
            color:white;
            border:none;
            padding:12px 30px;
            border-radius:10px;
            font-weight:bold;
        }

        @media(max-width:768px){
            .admin-sidebar{
                position:relative;
                width:100%;
                height:auto;
            }

            .admin-content{
                margin-right:0;
            }
        }
    </style>
</head>

<body>

<div class="admin-sidebar">

    <div class="admin-logo">
        الحسون
    </div>

    <div class="admin-menu">

        <a href="/dashboard">الرئيسية 📊</a>
        <a href="/settings">إعدادات الموقع ⚙️</a>
        <a href="/pages">الصفحات 🖼️</a>
        <a href="/categories">الأقسام</a>
        <a href="/items">المنيو والأصناف 🍽️</a>
        <a href="/ai-assistant">مساعد الحسون AI 🤖</a>
        <a href="/orders">الطلبات 🧾</a>
        <a href="/ratings">التقييمات ⭐</a>
        <a href="/location">موقعنا 🌐</a>
        <a href="/">فتح الموقع 🌍</a>
        <a href="/logout" class="logout-btn">خروج</a>

    </div>

</div>

<div class="admin-content">
    @yield('content')
</div>

</body>
</html>