@extends('app')

@section('title', 'プラン編集')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('errors')
            <div class="card-text">
              <form method="POST" action="{{ route('plans.update', ['plan' => $plan]) }}">
                @method('PATCH')
                @include('plans.form')
                <button type="submit" class="btn btn-block" style="margin-top: 40px; background-color: rgb(	0,200,179); color: #fff;">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('footer')
@endsection
