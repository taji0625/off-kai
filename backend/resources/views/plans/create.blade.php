@extends('app')

@section('title', 'オフ会プラン投稿')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-12 col-md-12 col-lg-10 col-xl-9">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('errors')
            <div class="card-text">
              <form method="POST" action="{{ route('plans.store') }}">
                @include('plans.form')
                <button type="submit" class="btn btn-block" style="margin-top: 40px; background-color: rgb(	0,200,179); color: #fff;">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
@endsection
