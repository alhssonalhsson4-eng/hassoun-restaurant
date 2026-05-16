<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>إضافة قسم</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <h1 class="text-warning mb-4">
        إضافة قسم
    </h1>

    <form method="POST"
          action="{{ route('categories.store') }}"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">

            <label class="mb-2">
                اسم القسم
            </label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="اسم القسم">

        </div>

        <div class="mb-3">

            <label class="mb-2">
                صورة القسم
            </label>

            <input type="file"
                   name="image"
                   class="form-control">

        </div>

        <button class="btn btn-warning">
            حفظ
        </button>

        <a href="{{ route('categories.index') }}"
           class="btn btn-secondary">

            رجوع

        </a>

    </form>

</div>

</body>
</html>