@extends('layouts.admin')

@section('content')

<div class="admin-box">

    <h1>المنيو والأصناف</h1>

    <a href="{{ route('items.create') }}"
       class="btn-orange"
       style="display:inline-block;text-decoration:none;margin-bottom:20px;">
        + إضافة أكلة جديدة
    </a>

    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#081122;color:white;">
                <th style="padding:12px;">الصورة</th>
                <th style="padding:12px;">الأكلة</th>
                <th style="padding:12px;">القسم</th>
                <th style="padding:12px;">السعر</th>
                <th style="padding:12px;">التحكم</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:12px;text-align:center;">
                        @if($item->image)
                            <img src="{{ asset('uploads/items/' . $item->image) }}"
                                 style="width:90px;height:70px;object-fit:cover;border-radius:10px;">
                        @else
                            لا توجد صورة
                        @endif
                    </td>

                    <td style="padding:12px;">
                        {{ $item->name }}
                    </td>

                    <td style="padding:12px;">
                        {{ $item->category->name ?? '-' }}
                    </td>

                    <td style="padding:12px;">
                        {{ number_format($item->price) }} IQD
                    </td>

                    <td style="padding:12px;display:flex;gap:8px;justify-content:center;">
                        <a href="{{ route('items.edit', $item->id) }}"
                           class="btn-orange"
                           style="text-decoration:none;">
                            تعديل
                        </a>

                        <form method="POST"
                              action="{{ route('items.destroy', $item->id) }}"
                              onsubmit="return confirm('حذف الأكلة؟')">
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