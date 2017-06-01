        @foreach ($dates as $date)
  <a href="?date={{ str_replace('-','',substr($date, 0,-3)) }}" class="btn btn-success">{{ str_replace('-','',substr($date, 0,-3)) }}</a> 
@endforeach