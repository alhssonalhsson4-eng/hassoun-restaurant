@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>تعديل الأكلة</h1>

    <form method="POST"
          action="{{ route('items.update', $item->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label>القسم</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $item->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label>اسم الأكلة</label>
        <input type="text"
               name="name"
               class="form-control"
               value="{{ $item->name }}"
               required>

        <label>الوصف</label>
        <textarea name="description"
                  class="form-control">{{ $item->description }}</textarea>

        <label>السعر</label>
        <input type="number"
               name="price"
               class="form-control"
               value="{{ $item->price }}"
               required>

        <label>الصورة الحالية</label>

        @if($item->image)
            <div style="margin:15px 0;">
                <img src="{{ asset('uploads/items/' . $item->image) }}"
                     style="width:180px;height:130px;object-fit:cover;border-radius:15px;">
            </div>
        @else
            <p>لا توجد صورة</p>
        @endif

        <label>تغيير الصورة</label>
        <input type="file"
               name="image"
               class="form-control"
               accept="image/*">

        <button class="btn-orange mt-4">
            حفظ التعديل
        </button>

        <a href="{{ route('items.index') }}"
           style="margin-right:15px;text-decoration:none;">
            رجوع
        </a>

    </form>

</div>

@endsection