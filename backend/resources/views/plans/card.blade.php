<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <a href="{{ route('users.show', ['name' => $plan->user->name]) }}" class="text-dark">
      @if($plan->user->profile_img)
        <img src="{{ $plan->user->profile_img }}" alt="プロフィール画像" style="width: 50px; height: 50px; border-radius: 30px;">
      @else
        <i class="fas fa-user-circle fa-3x"></i>
      @endif
    </a>
    <div class="ml-3">
      <div class="font-weight-bold">
        <a href="{{ route('users.show', ['name' => $plan->user->name]) }}" class="text-dark">
          {{ $plan->user->name }}</div>
        </a>
      <div class="font-weight-lighter"style="font-size: 13px;">
        {{ $plan->created_at->format('Y-m-d H:i') }}
      </div>
    </div>

    @if( Auth::id() === $plan->user_id )
      <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('plans.edit', ['plan' => $plan]) }}">
              <i class="fas fa-pen mr-1"></i>プランを編集する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-plan{{ $plan->id }}">
              <i class="fas fa-trash-alt mr-1"></i>プランを削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-plan{{ $plan->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('plans.destroy', ['plan' => $plan]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $plan->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
    @endif
  </div>
  <hr class="mt-0">
  <div class="card-body pt-0">
    <h3 class="card-title mt-3">
      {{ $plan->title }}
    </h3>
    <h4 class="my-4">
      {{ $plan->meeting_date_time->format('Y年n月j日' . "($week[$w])" . 'G:i') }}〜
    </h4>
    <div class="my-4 d-flex">
      @if( $today < $meeting_date_time )
        @if( $plan->participations->count() < $plan->capacity )
          @if($plan->is_participationed_by_auth_user())
            <a href="{{ route('plan.unparticipation', ['id' => $plan->id]) }}" class="unparticipation-btn btn btn-sm font-weight-bold" onclick="return confirm('このオフ会をキャンセルしますか？')">参加予約済</a>
          @else
            <a href="{{ route('plan.participation', ['id' => $plan->id]) }}" onclick="return confirm('このオフ会に参加しますか？')" class="participation-btn btn btn-sm font-weight-bold">参加する</a>
          @endif
        @else
          <div class="text-center rception_closed">
            定員に達したため<br>
            参加受付を終了しました
          </div>
        @endif
      @else
        <div class="text-center rception_closed">
          このオフ会は<br>
          終了しました
        </div>
      @endif
      <div class="number_of_participants py-2" >
        参加人数 
        <span class="font-weight-bold" style="color: rgb(255, 98, 0); font-size: 23px;">
          {{ $plan->participations->count() }}
        </span>
        @empty($plan->capacity)
          {{ null }}
        @else
          / {{ $plan->capacity }}人
        @endempty
      </div>
    </div>

    @if($plan->img)
      <img class="plan-img" src="{{ $plan->img }}" alt="プラン画像" style="width: 100%;" class="mb-3">
    @endif
    <div class="table-responsive mt-3">
      <table class="table table-striped table-bordered" width="100%">
        <tbody>
          <tr>
            <th scorp="row" class="font-weight-bold p-2 pl-3" width="25%">会場</th>
            <td width="75%" class="p-2 pl-3">{{ $plan->venue }}</td>
          </tr>
          <tr>
            <th scorp="row" class="font-weight-bold p-2 pl-3" width="25%">都道府県</th>
            <td width="75%" class="p-2 pl-3">{{ $plan->prefecture }}</td>
          </tr>
          <tr>
            <th scorp="row" class="font-weight-bold p-2 pl-3" width="25%">住所</th>
            <td width="75%" class="p-2 pl-3">{{ $plan->address }}</td>
          </tr>
          <tr>
            <th scorp="row" class="font-weight-bold p-2 pl-3" width="25%">年齢制限</th>
            <td width="75%" class="p-2 pl-3">{{ $plan->age }}</td>
          </tr>
          <tr>
            <th scorp="row" class="font-weight-bold p-2 pl-3" width="25%">会費</th>
            <td width="75%" class="p-2 pl-3">{{ $plan->membership_fee }}</td>
          </tr>
          <tr>
            <th scorp="row" class="font-weight-bold p-2 pl-3" width="25%">定員</th>
            <td width="75%" class="p-2 pl-3">{{ $plan->capacity }}人</td>
          </tr>
          <tr>
            <th scorp="row" class="font-weight-bold p-3" width="25%">タグ</th>
            <td width="75%" class="p-3">
              @foreach($plan->tags as $tag)
                <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="tag">
                  {{ $tag->name }}
                </a>
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-text mt-4" style="color: black;">
      {!! nl2br(e( $plan->body )) !!}
    </div>
  </div>
  <div class="card-body pt-0 pb-2 pl-3">
    <div class="card-text">
      <interest
      :initial-is-interested-by='@json($plan->isInterestedBy(Auth::user()))'
      :initial-count-interests='@json($plan->count_interests)'
      :authorized='@json(Auth::check())'
        endpoint="{{ route('plans.interest', ['plan' => $plan]) }}"
      >
      </interest>
    </div>
  </div>
  @if( $plan->address )
    <div class="mx-3">
      <iframe id="map" src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google-map.apikey') }}&q={{ $plan->address }}" width="100%" height="300" frameborder="0"></iframe>
    </div>
  @endif
</div>