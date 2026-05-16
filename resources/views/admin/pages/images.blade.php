@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>
        بطاقات {{ $page->title }}
    </h1>

    <form method="POST"
          action="{{ route('pages.images.store', $page->id) }}"
          enctype="multipart/form-data">

        @csrf

        <label>العنوان</label>
        <input type="text" name="title" class="form-control">

        <label>الوصف</label>
        <textarea name="description" class="form-control"></textarea>

        <label>الصورة</label>
        <input type="file" name="image" class="form-control">

        <button class="btn-orange">
            + إضافة بطاقة
        </button>

    </form>

</div>

<div class="row mt-4">

    @foreach($images as $image)

        <div class="col-md-4 mb-4">

            <div class="admin-box">

                @if($image->image)

                    <img src="{{ asset('uploads/page-images/' . $image->image) }}"
                         style="width:100%;height:240px;object-fit:cover;border-radius:20px;">

                @endif

                <h3 class="mt-3">
                    {{ $image->title }}
                </h3>

                <p>
                    {{ $image->description }}
                </p>

                <a href="{{ route('page-images.edit', $image->id) }}"
                   class="btn-orange"
                   style="text-decoration:none;">
                    تعديل البطاقة
                </a>

                <form method="POST"
                      action="{{ route('page-images.destroy', $image->id) }}"
                      onsubmit="return confirm('حذف البطاقة؟')"
                      style="margin-top:15px;">

                    @csrf
                    @method('DELETE')

                    <button class="btn-red">
                        حذف البطاقة
                    </button>

                </form>

            </div>

        </div>

    @endforeach

</div>

@endsection