<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مناطق التوصيل</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dark text-white">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="text-warning">مناطق التوصيل</h1>

        <a href="{{ route('delivery-areas.create') }}" class="btn btn-warning">
            إضافة منطقة
        </a>

    </div>

    @foreach($areas as $area)

        <div class="card bg-black border-warning mb-3">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h4>{{ $area->name }}</h4>

                    <h5 class="text-warning">
                        {{ $area->price }} IQD
                    </h5>
                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('delivery-areas.edit', $area->id) }}"
                       class="btn btn-sm btn-warning">
                        تعديل
                    </a>

                    <form method="POST"
                          action="{{ route('delivery-areas.destroy', $area->id) }}"
                          onsubmit="return confirm('هل أنت متأكد من حذف المنطقة؟')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">
                            حذف
                        </button>

                    </form>

                </div>

            </div>

        </div>

    @endforeach

</div>

</body>
</html>