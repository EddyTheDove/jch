@extends('front.templates.default')

@section('head')
    <title>{{ $page->title }}</title>
@endsection

@section('body')
    <div class="full-page page-white">
        <section class="checkout-page">
            <div class="container mb-40">
                <h3>{{ $page->title }}</h3>


                <div class="content">
                    {!! $page->content !!}
                </div>
            </div>
        </section>
    </div>

@endsection
