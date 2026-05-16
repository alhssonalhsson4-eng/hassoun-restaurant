<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>إضافة صفحة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <h1 class="text-warning mb-4">
        إضافة صفحة
    </h1>

    <form method="POST"
          action="{{ route('pages.store') }}"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">

            <label class="mb-2">
                عنوان الصفحة
            </label>

            <input type="text"
                   name="title"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label class="mb-2">
                الرابط المختصر
            </label>

            <input type="text"
                   name="slug"
                   class="form-control"
                   placeholder="about-us">

        </div>

        <div class="mb-3">

            <label class="mb-2">
                محتوى الصفحة
            </label>

            <textarea name="content"
                      rows="8"
                      class="form-control"></textarea>

        </div>

        <div class="mb-3">

            <label class="mb-2">
                صورة الصفحة
            </label>

            <input type="file"
                   name="image"
                   class="form-control">

        </div>

        <div class="form-check mb-4">

            <input type="checkbox"
                   name="is_active"
                   class="form-check-input"
                   checked>

            <label class="form-check-label">

                تفعيل الصفحة

            </label>

        </div>

        <button class="btn btn-warning">

            حفظ

        </button>

    </form>

</div>

</body>
</html>