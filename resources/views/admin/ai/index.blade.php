@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>🤖 مساعد الحسون AI</h1>

    <p style="color:#aaa;">
        اكتب هنا وصف الأكلات، الأسعار، العروض، التوصيل، النبذة، ومعلومات الموقع.
    </p>

    <form method="POST" action="{{ route('ai.assistant.update') }}">
        @csrf

        <label>معلومات المساعد</label>

        <textarea name="ai_context"
                  class="form-control"
                  style="min-height:300px;"
                  placeholder="مثال:
مطعم الحسون يقدم أكلات شرقية وغربية ومشاوي.
الكباب بسعر 8000 دينار.
التوصيل حسب المنطقة.">{{ $setting->ai_context }}</textarea>

        <button class="btn-orange mt-3">
            حفظ معلومات الذكاء
        </button>
    </form>

</div>

@endsection