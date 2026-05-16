@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>الأقسام</h1>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <label>اسم القسم</label>
        <input type="text" name="name" class="form-control" required>

        <button class="btn-orange">
            + إضافة قسم
        </button>
    </form>

    <hr>

    <table>
        <thead>
            <tr>
                <th>اسم القسم</th>
                <th>التحكم</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>

                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}"
                           class="btn-orange"
                           style="text-decoration:none;">
                            تعديل
                        </a>

                        <form method="POST"
                              action="{{ route('categories.destroy', $category->id) }}"
                              style="display:inline-block;"
                              onsubmit="return confirm('حذف القسم؟')">
                            @csrf
                            @method('DELETE')

                            <button class="btn-red">
                                حذف
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection