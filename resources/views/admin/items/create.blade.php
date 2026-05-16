<!DOCTYPE html>
<html lang="en">
<head>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-dark text-white">

<div class="container py-5">

    <h1 class="mb-4">Add Item</h1>

    <form method="POST"
          action="{{ route('items.store') }}"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">

            <label>Category</label>

            <select name="category_id" class="form-control">

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Name</label>

            <input type="text"
                   name="name"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Description</label>

            <textarea name="description"
                      class="form-control"></textarea>

        </div>

        <div class="mb-3">

            <label>Price</label>

            <input type="number"
                   name="price"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Image</label>

            <input type="file"
                   name="image"
                   class="form-control">

        </div>

        <button class="btn btn-warning">
            Save
        </button>

    </form>

</div>

</body>
</html>