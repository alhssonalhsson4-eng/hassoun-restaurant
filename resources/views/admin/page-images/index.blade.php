<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>بطاقات النبذة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        body{
            background:#050816;
            color:white;
            font-family:Tahoma;
        }

        .box{
            background:#081122;
            border:1px solid rgba(255,255,255,.12);
            border-radius:18px;
            padding:30px;
            margin:30px;
        }

        h1{
            color:#ff9800;
            font-weight:bold;
            margin-bottom:25px;
        }

        label{
            margin-bottom:8px;
            display:block;
            font-weight:bold;
        }

        .form-control{
            background:#050816 !important;
            color:white !important;
            border:1px solid rgba(255,255,255,.2) !important;
            margin-bottom:18px;
            min-height:50px;
        }

        textarea.form-control{
            min-height:120px;
        }

        .btn-orange{
            background:#ff9800;
            color:white;
            border:none;
            padding:12px 25px;
            border-radius:10px;
            font-weight:bold;
        }

        .card-dark{
            background:#0b1425;
            border:1px solid rgba(255,255,255,.12);
            border-radius:16px;
            overflow:hidden;
            height:100%;
        }

        .card-dark img{
            width:100%;
            height:230px;
            object-fit:cover;
        }

        .card-body-custom{
            padding:20px;
        }

        .card-body-custom h3{
            color:#ff9800;
            font-weight:bold;
        }

        .card-body-custom p{
            color:#ddd;
            line-height:1.8;
        }

        .delete-btn{
            background:#c62828;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:8px;
            font-weight:bold;
        }

    </style>

</head>

<body>

<div class="box">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>

            بطاقات صفحة:
            {{ $page->title }}

        </h1>

        <a href="/pages"
           class="btn btn-secondary">

            رجوع

        </a>

    </div>

    <form method="POST"
          action="{{ route('pages.images.store', $page->id) }}"
          enctype="multipart/form-data">

        @csrf

        <label>
            عنوان البطاقة
        </label>

        <input type="text"
               name="title"
               class="form-control"
               placeholder="مثلاً: تاريخ الحسون">

        <label>
            وصف البطاقة
        </label>

        <textarea name="description"
                  class="form-control"
                  placeholder="اكتب وصف البطاقة هنا"></textarea>

        <label>
            صورة البطاقة
        </label>

        <input type="file"
               name="image"
               class="form-control">

        <button class="btn-orange">

            + إضافة بطاقة

        </button>

    </form>

</div>

<div class="box">

    <h1>
        البطاقات المضافة
    </h1>

    <div class="row">

        @foreach($images as $image)

            <div class="col-md-4 mb-4">

                <div class="card-dark">

                    <img src="{{ asset('uploads/page-images/' . $image->image) }}">

                    <div class="card-body-custom">

                        <h3>

                            {{ $image->title }}

                        </h3>

                        <p>

                            {{ $image->description }}

                        </p>

                        <form method="POST"
                              action="{{ route('page-images.destroy', $image->id) }}"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">

                            @csrf
                            @method('DELETE')

                            <button class="delete-btn">

                                حذف

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

</body>
</html>