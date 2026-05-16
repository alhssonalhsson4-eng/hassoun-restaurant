<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->restaurant_name_ar ?? 'مطعم الحسون' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{
            background:#050816;
            color:white;
            font-family:Tahoma;
            margin:0;
            overflow-x:hidden;
            padding-bottom:90px;
        }

        .top-navbar{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:70px;
            background:rgba(5,8,22,.92);
            backdrop-filter:blur(12px);
            display:flex;
            align-items:center;
            justify-content:center;
            z-index:999999;
            border-bottom:1px solid rgba(255,255,255,.08);
        }

        .top-logo{
            color:#ff9800;
            font-size:30px;
            font-weight:bold;
        }

        .hero-section{
            min-height:100vh;
            padding:110px 20px 120px;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            background:
                linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.78)),
                url('{{ $setting && $setting->hero_image ? asset('uploads/settings/' . $setting->hero_image) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1400' }}');
            background-size:cover;
            background-position:center;
        }

        .hero-title{
            font-size:54px;
            color:#ff9800;
            font-weight:bold;
            line-height:1.25;
            margin-bottom:18px;
        }

        .hero-subtitle{
            color:#eee;
            font-size:22px;
            line-height:1.8;
        }

        .hero-button{
            display:inline-block;
            margin-top:30px;
            background:#ff9800;
            color:white;
            text-decoration:none;
            padding:16px 45px;
            border-radius:18px;
            font-weight:bold;
            font-size:22px;
            box-shadow:0 12px 30px rgba(255,152,0,.35);
        }

        .floating-cart-home{
            position:fixed;
            left:18px;
            bottom:95px;
            width:62px;
            height:62px;
            background:#ff9800;
            color:white;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            text-decoration:none;
            z-index:999999;
            box-shadow:0 10px 25px rgba(0,0,0,.35);
        }

        .floating-ai{
            position:fixed;
            right:18px;
            bottom:95px;
            width:62px;
            height:62px;
            background:#00bcd4;
            color:white;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            z-index:999999;
            cursor:pointer;
            box-shadow:0 10px 25px rgba(0,0,0,.35);
        }

        .ai-chat-box{
            position:fixed;
            right:18px;
            bottom:165px;
            width:360px;
            background:#081122;
            border-radius:22px;
            overflow:hidden;
            display:none;
            z-index:999999;
            border:1px solid rgba(255,255,255,.08);
        }

        .ai-header{
            background:#00bcd4;
            color:white;
            padding:18px;
            font-weight:bold;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .ai-messages{
            padding:20px;
            height:350px;
            overflow-y:auto;
        }

        .ai-bot-message{
            background:#101b33;
            padding:14px;
            border-radius:14px;
            margin-bottom:15px;
            line-height:1.8;
        }

        .ai-user-message{
            background:#ff9800;
            padding:14px;
            border-radius:14px;
            margin-bottom:15px;
            line-height:1.8;
        }

        .ai-input-box{
            display:flex;
        }

        .ai-input-box input{
            flex:1;
            background:#050816;
            border:none;
            color:white;
            padding:16px;
        }

        .ai-input-box button{
            width:90px;
            background:#00bcd4;
            border:none;
            color:white;
            font-weight:bold;
        }

        .bottom-navbar{
            position:fixed;
            bottom:0;
            left:0;
            width:100%;
            height:78px;
            background:rgba(5,8,22,.95);
            backdrop-filter:blur(12px);
            display:flex;
            justify-content:space-around;
            align-items:center;
            z-index:999999;
            border-top:1px solid rgba(255,255,255,.08);
        }

        .bottom-navbar a{
            color:white;
            text-decoration:none;
            display:flex;
            flex-direction:column;
            align-items:center;
            font-size:13px;
            font-weight:bold;
        }

        .bottom-navbar a span{
            font-size:24px;
            margin-bottom:4px;
        }

        .bottom-navbar a.active{
            color:#ff9800;
        }

        @media(max-width:768px){
            .hero-title{
                font-size:42px;
            }

            .hero-subtitle{
                font-size:18px;
            }

            .hero-button{
                width:85%;
                padding:16px;
                font-size:22px;
            }

            .ai-chat-box{
                width:92%;
                right:4%;
                bottom:165px;
            }
        }
    </style>
</head>

<body>

<nav class="top-navbar">
    <div class="top-logo">
        الحسون
    </div>
</nav>

<div class="hero-section">

    <div>

        <h1 class="hero-title">
            {{ $setting->restaurant_name_ar ?? 'مطعم الحسون' }}
        </h1>

        <p class="hero-subtitle">
            {{ $setting->slogan_ar ?? 'أفضل الأكلات الشرقية والغربية والمشاوي' }}
        </p>

        <a href="/menu-page" class="hero-button">
            اطلب الآن
        </a>

    </div>

</div>

<a href="/menu-page" class="floating-cart-home">
    🛒
</a>

<div class="floating-ai" onclick="toggleAIChat()">
    🤖
</div>

<div class="ai-chat-box" id="aiChatBox">

    <div class="ai-header">
        مساعد الحسون الذكي 
        <span onclick="toggleAIChat()" style="cursor:pointer">✕</span>
    </div>

    <div class="ai-messages" id="aiMessages">
        <div class="ai-bot-message">
            مرحباً 👋 اسألني عن المنيو والأسعار والتوصيل.
        </div>
    </div>

    <div class="ai-input-box">
        <input type="text" id="aiInput" placeholder="اكتب سؤالك...">
        <button onclick="sendAIMessage()">إرسال</button>
    </div>

</div>

<div class="bottom-navbar">

    <a href="/" class="active">
        <span>🏠</span>
        الرئيسية
    </a>

    <a href="/about">
        <span>📖</span>
        النبذة
    </a>

    <a href="/ratings-page">
        <span>⭐</span>
        التقييم
    </a>

    <a href="/location-page">
        <span>📍</span>
        موقعنا
    </a>

    <a href="/menu-page">
        <span>🍔</span>
        الطلب
    </a>

</div>

<script>
function toggleAIChat()
{
    let box = document.getElementById('aiChatBox');
    box.style.display =
        box.style.display === 'block'
        ? 'none'
        : 'block';
}

async function sendAIMessage()
{
    let input = document.getElementById('aiInput');
    let msg = input.value.trim();

    if(!msg) return;

    let messages = document.getElementById('aiMessages');

    messages.innerHTML +=
    `<div class="ai-user-message">${msg}</div>`;

    input.value='';

    messages.innerHTML +=
    `<div class="ai-bot-message" id="loading">
        جاري البحث...
    </div>`;

    try{

        let response = await fetch(
            '/ai-search?message=' +
            encodeURIComponent(msg)
        );

        let data = await response.json();

        document.getElementById('loading')?.remove();

        messages.innerHTML +=
        `<div class="ai-bot-message">
            ${data.answer}
        </div>`;

    }catch(e){

        document.getElementById('loading')?.remove();

        messages.innerHTML +=
        `<div class="ai-bot-message">
            خطأ بالاتصال
        </div>`;
    }

    messages.scrollTop =
    messages.scrollHeight;
}

document
.getElementById('aiInput')
.addEventListener('keydown',function(e){

    if(e.key==='Enter'){
        sendAIMessage();
    }

});
</script>