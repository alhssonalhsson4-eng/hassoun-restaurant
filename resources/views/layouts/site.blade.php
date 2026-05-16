<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->restaurant_name_ar ?? 'مطعم الحسون' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body{background:#050816;color:white;font-family:Tahoma;margin:0;overflow-x:hidden;padding-bottom:95px;}
        .top-navbar{position:sticky;top:0;width:100%;height:68px;background:rgba(5,8,22,.95);display:flex;align-items:center;justify-content:center;z-index:99999;border-bottom:1px solid rgba(255,255,255,.08);}
        .top-logo{color:#ff9800;font-size:28px;font-weight:bold;}
        .floating-cart{position:fixed;left:18px;bottom:95px;width:62px;height:62px;background:#ff9800;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;text-decoration:none;z-index:999999;box-shadow:0 10px 25px rgba(0,0,0,.35);}
        .floating-ai{position:fixed;right:18px;bottom:95px;width:62px;height:62px;background:#00bcd4;color:white;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;z-index:999999;cursor:pointer;box-shadow:0 10px 25px rgba(0,0,0,.35);}
        .ai-chat-box{position:fixed;right:18px;bottom:165px;width:360px;background:#081122;border-radius:22px;overflow:hidden;display:none;z-index:999999;border:1px solid rgba(255,255,255,.08);}
        .ai-header{background:#00bcd4;color:white;padding:18px;font-weight:bold;display:flex;justify-content:space-between;align-items:center;}
        .ai-messages{padding:20px;height:350px;overflow-y:auto;}
        .ai-bot-message{background:#101b33;padding:14px;border-radius:14px;margin-bottom:15px;line-height:1.9;}
        .ai-user-message{background:#ff9800;padding:14px;border-radius:14px;margin-bottom:15px;line-height:1.9;}
        .ai-input-box{display:flex;}
        .ai-input-box input{flex:1;background:#050816;border:none;color:white;padding:16px;outline:none;}
        .ai-input-box button{width:90px;background:#00bcd4;border:none;color:white;font-weight:bold;}
        .bottom-navbar{position:fixed;bottom:0;left:0;width:100%;height:78px;background:rgba(5,8,22,.96);display:flex;justify-content:space-around;align-items:center;z-index:999999;border-top:1px solid rgba(255,255,255,.08);}
        .bottom-navbar a{color:white;text-decoration:none;display:flex;flex-direction:column;align-items:center;font-size:13px;font-weight:bold;}
        .bottom-navbar a span{font-size:24px;margin-bottom:4px;}
        .bottom-navbar a.active{color:#ff9800;}
        @media(max-width:768px){.ai-chat-box{width:92%;right:4%;bottom:165px;}}
    </style>
</head>

<body>

<nav class="top-navbar">
    <div class="top-logo">{{ $setting->restaurant_name_ar ?? 'الحسون' }}</div>
</nav>

@yield('content')

<a href="/menu-page" class="floating-cart">🛒</a>

<div class="floating-ai" onclick="toggleAIChat()">🤖</div>

<div class="ai-chat-box" id="aiChatBox">
    <div class="ai-header">
        مساعد الحسون الذكي 
        <span onclick="toggleAIChat()" style="cursor:pointer;">✕</span>
    </div>

    <div class="ai-messages" id="aiMessages">
        <div class="ai-bot-message">
            مرحباً 👋<br>
            اسألني عن قوزي، سعر أكلة، التوصيل، الموقع أو أي شيء بالمطعم.
        </div>
    </div>

    <div class="ai-input-box">
        <input type="text" id="aiInput" placeholder="اكتب سؤالك...">
        <button type="button" id="aiSendBtn">إرسال</button>
    </div>
</div>

<div class="bottom-navbar">
    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><span>🏠</span>الرئيسية</a>
    <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}"><span>📖</span>النبذة</a>
    <a href="/ratings-page" class="{{ request()->is('ratings-page') ? 'active' : '' }}"><span>⭐</span>التقييم</a>
    <a href="/location-page" class="{{ request()->is('location-page') ? 'active' : '' }}"><span>📍</span>موقعنا</a>
    <a href="/menu-page" class="{{ request()->is('menu-page') ? 'active' : '' }}"><span>🍔</span>الطلب</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('aiSendBtn').addEventListener('click', sendAIMessage);

    document.getElementById('aiInput').addEventListener('keydown', function(e){
        if(e.key === 'Enter'){
            e.preventDefault();
            sendAIMessage();
        }
    });
});

function toggleAIChat()
{
    let box = document.getElementById('aiChatBox');
    box.style.display = box.style.display === 'block' ? 'none' : 'block';
}

async function sendAIMessage()
{
    let input = document.getElementById('aiInput');
    let msg = input.value.trim();

    if (!msg) return;

    let messages = document.getElementById('aiMessages');

    messages.insertAdjacentHTML('beforeend', `
        <div class="ai-user-message">${escapeHtml(msg)}</div>
    `);

    input.value = '';

    messages.insertAdjacentHTML('beforeend', `
        <div class="ai-bot-message" id="typingMessage">جاري البحث...</div>
    `);

    messages.scrollTop = messages.scrollHeight;

    try {
        let url = "{{ route('ai.search') }}" + "?message=" + encodeURIComponent(msg) + "&t=" + Date.now();

        let response = await fetch(url, {
            method: "GET",
            headers: {
                "Accept": "application/json"
            },
            cache: "no-store"
        });

        let data = await response.json();

        document.getElementById('typingMessage')?.remove();

        messages.insertAdjacentHTML('beforeend', `
            <div class="ai-bot-message">${data.answer || 'لا توجد نتيجة'}</div>
        `);

    } catch (e) {
        document.getElementById('typingMessage')?.remove();

        messages.insertAdjacentHTML('beforeend', `
            <div class="ai-bot-message">حدث خطأ أثناء الاتصال بالمساعد.</div>
        `);
    }

    messages.scrollTop = messages.scrollHeight;
}

function escapeHtml(text)
{
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
</script>

</body>

<div style="
<nav class="top-navbar">
</html>