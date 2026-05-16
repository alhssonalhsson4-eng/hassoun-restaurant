@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>التقييمات</h1>

    <form method="POST" action="{{ route('ratings.category.store') }}">
        @csrf

        <label>اسم قسم التقييم</label>
        <input type="text" name="name" class="form-control" placeholder="مثلاً: الطعام">

        <label>الأيقونة</label>
        <input type="text" name="icon" class="form-control" placeholder="مثلاً: 🍽️">

        <button class="btn-orange mt-3">
            + إضافة قسم
        </button>
    </form>

</div>

@foreach($categories as $category)

    <div class="admin-box">

        <div class="d-flex justify-content-between align-items-center">

            <h3>
                {{ $category->icon }} {{ $category->name }}
            </h3>

            <form method="POST"
                  action="{{ route('ratings.category.delete', $category->id) }}"
                  onsubmit="return confirm('حذف القسم؟')">
                @csrf
                @method('DELETE')

                <button class="btn-red">
                    حذف القسم
                </button>
            </form>

        </div>

        <hr>

        <form method="POST" action="{{ route('ratings.option.store') }}">
            @csrf

            <input type="hidden"
                   name="rating_category_id"
                   value="{{ $category->id }}">

            <label>إضافة خيار تقييم</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="مثلاً: ممتاز">

            <button class="btn-orange">
                + إضافة تقييم
            </button>
        </form>

        <hr>

        @foreach($category->options as $option)

            <div class="d-flex justify-content-between align-items-center mb-2">

                <span>{{ $option->name }}</span>

                <form method="POST"
                      action="{{ route('ratings.option.delete', $option->id) }}"
                      onsubmit="return confirm('حذف التقييم؟')">
                    @csrf
                    @method('DELETE')

                    <button class="btn-red">
                        حذف
                    </button>
                </form>

            </div>

        @endforeach

    </div>

@endforeach

@endsection