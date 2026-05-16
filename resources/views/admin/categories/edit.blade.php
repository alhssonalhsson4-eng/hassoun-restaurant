@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>تعديل القسم</h1>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <label>اسم القسم</label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ $category->name }}"
               required>

        <button class="btn-orange">
            حفظ التعديل
        </button>

        <a href="{{ route('categories.index') }}"
           style="color:white;margin-right:15px;">
            رجوع
        </a>
    </form>

</div>

@endsection