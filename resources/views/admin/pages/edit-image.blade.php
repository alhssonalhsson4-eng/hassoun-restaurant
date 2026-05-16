@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>تعديل البطاقة</h1>

    <form method="POST"
          action="{{ route('page-images.update', $image->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label>العنوان</label>

        <input type="text"
               name="title"
               class="form-control"
               value="{{ $image->title }}">

        <label>الوصف</label>

        <textarea name="description"
                  class="form-control">{{ $image->description }}</textarea>

        @if($image->image)

            <img src="{{ asset('uploads/page-images/' . $image->image) }}"
                 style="width:220px;height:160px;object-fit:cover;border-radius:20px;margin:20px 0;">

        @endif

        <label>تغيير الصورة</label>

        <input type="file"
               name="image"
               class="form-control">

        <button class="btn-orange">
            حفظ التعديل
        </button>

    </form>

</div>

@endsection