<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل منطقة التوصيل</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <h1 class="text-warning mb-4">تعديل منطقة التوصيل</h1>

    <form method="POST"
          action="{{ route('delivery-areas.update', $delivery_area->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="mb-2">اسم المنطقة</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ $delivery_area->name }}">
        </div>

        <div class="mb-3">
            <label class="mb-2">سعر التوصيل</label>

            <input type="number"
                   name="price"
                   class="form-control"
                   value="{{ $delivery_area->price }}">
        </div>

        <button class="btn btn-warning">
            حفظ التعديل
        </button>

        <a href="{{ route('delivery-areas.index') }}"
           class="btn btn-secondary">
            رجوع
        </a>

    </form>

</div>

</body>
</html>