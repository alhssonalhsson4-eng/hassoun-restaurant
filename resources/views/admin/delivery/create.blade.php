<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <h1 class="mb-4 text-warning">
        إضافة منطقة توصيل
    </h1>

    <form method="POST" action="{{ route('delivery-areas.store') }}">

        @csrf

        <input type="text"
               name="name"
               class="form-control mb-3"
               placeholder="اسم المنطقة">

        <input type="number"
               name="price"
               class="form-control mb-3"
               placeholder="سعر التوصيل">

        <button class="btn btn-warning">
            حفظ
        </button>

    </form>

</div>

</body>
</html>