@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>النبذة والصفحات</h1>

    <a href="{{ route('pages.create') }}"
       class="btn-orange"
       style="text-decoration:none;">
        + إضافة صفحة
    </a>

    <hr>

    <div class="row">

        @foreach($pages as $page)

            <div class="col-md-4 mb-4">

                <div class="admin-box">

                    <h3>{{ $page->title }}</h3>

                    <p>{{ $page->description }}</p>

                    <a href="{{ route('pages.edit', $page->id) }}"
                       class="btn-orange"
                       style="text-decoration:none;">
                        تعديل الصفحة
                    </a>

                    <a href="{{ route('pages.images', $page->id) }}"
                       class="btn-orange"
                       style="text-decoration:none;">
                        إدارة البطاقات
                    </a>

                    <form method="POST"
                          action="{{ route('pages.destroy', $page->id) }}"
                          onsubmit="return confirm('حذف الصفحة؟')"
                          style="margin-top:15px;">
                        @csrf
                        @method('DELETE')

                        <button class="btn-red">
                            حذف الصفحة
                        </button>
                    </form>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection