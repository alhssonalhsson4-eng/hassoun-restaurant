@extends('layouts.site')

@section('content')

<div class="container py-5">

    <h1 class="section-title">
        النبذة
    </h1>

    <div class="row">

        @foreach($aboutPages as $page)

            @foreach($page->images as $img)

                <div class="col-md-4 mb-4">

                    <div class="menu-card">

                        <img src="{{ asset('uploads/page-images/' . $img->image) }}"
                             class="menu-image">

                        <div class="menu-content">

                            <h3 class="menu-title">
                                {{ $img->title }}
                            </h3>

                            <p class="menu-description">
                                {{ $img->description }}
                            </p>

                        </div>

                    </div>

                </div>

            @endforeach

        @endforeach

    </div>

</div>

@endsection