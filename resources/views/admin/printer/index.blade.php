@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>
        إعدادات الطابعة
    </h1>

    <form method="POST"
          action="{{ route('printer.update') }}">

        @csrf

        <label>
            IP الطابعة
        </label>

        <input type="text"
               name="printer_ip"
               class="form-control"
               value="{{ $setting->printer_ip }}"
               placeholder="مثال: 192.168.3.110">

        <label class="mt-3">
            Port الطابعة
        </label>

        <input type="text"
               name="printer_port"
               class="form-control"
               value="{{ $setting->printer_port ?? '9100' }}"
               placeholder="9100">

        <button class="btn-orange mt-4">
            حفظ إعدادات الطابعة
        </button>

    </form>

</div>

@endsection