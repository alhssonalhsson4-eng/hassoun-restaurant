<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>تعديل الصفحة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <h1 class="text-warning mb-4">
        تعديل الصفحة
    </h1>

    <form method="POST"
          action="{{ route('pages.update', $page->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label class="mb-2">
                عنوان الصفحة
            </label>

            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ $page->title }}">

        </div>

        <div class="mb-3">

            <label class="mb-2">
                الرابط المختصر
            </label>

            <input type="text"
                   name="slug"
                   class="form-control"
                   value="{{ $page->slug }}">

        </div>

        <div class="mb-3">

            <label class="mb-2">
                محتوى الصفحة
            </label>

            <textarea name="content"
                      rows="8"
                      class="form-control">{{ $page->content }}</textarea>

        </div>

        <div class="mb-3">

            <label class="mb-2">
                الصورة الحالية
            </label><br>

            @if($page->image)

                <img src="{{ asset('uploads/pages/' . $page->image) }}"
                     width="220"
                     style="height:150px; object-fit:cover; border-radius:10px;">

            @endif

        </div>

        <div class="mb-3">

            <label class="mb-2">
                تغيير الصورة
            </label>

            <input type="file"
                   name="image"
                   class="form-control">

        </div>

        <div class="form-check mb-4">

            <input type="checkbox"
                   name="is_active"
                   class="form-check-input"
                   {{ $page->is_active ? 'checked' : '' }}>

            <label class="form-check-label">

                تفعيل الصفحة

            </label>

        </div>

        <button class="btn btn-warning">

            حفظ التعديل

        </button>

        <a href="{{ route('pages.index') }}"
           class="btn btn-secondary">

            رجوع

        </a>

    </form>

</div>

</body>
</html>