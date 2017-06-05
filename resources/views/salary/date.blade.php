        @foreach ($dates as $date)

  <a href="/{{ Route::currentRouteName() }}/{{ (strlen($date)<5)?$date:str_replace('-','',substr($date, 0,-3)) }}" class="btn btn-success">{{ (strlen($date)<5)?$date:str_replace('-','',substr($date, 0,-3)) }}</a> 


@endforeach


