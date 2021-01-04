@extends('app')

@section('title', 'プラン一覧')

@section('content')
  @include('nav')
  <div class="container">
    @foreach($plans as $plan)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
          <div>
            <div class="font-weight-bold">
              {{ $plan->user->name }}
            </div> 
            <div class="font-weight-lighter">
              {{ $plan->created_at->format('Y/m/d H:i') }}
            </div>
          </div>
        </div>
        <div class="card-body pt-0 pb-2">
          <h3 class="h4 card-title">
            {{ $plan->title }}
          </h3>
          <div class="card-text">
            {!! nl2br(e( $plan->body )) !!}
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
