<ul class="result">
    @foreach($result->results->main_result as $ball)
    <li>{{ $ball }}</li>
    @endforeach
</ul>
@if(is_array($result->results->extra_ball))
    @foreach($result->results->extra_ball as $ball)
        <span class="extra_ball">{{ $ball }}</span>
    @endforeach
@else
<span class="extra_ball">{{ $result->results->extra_ball }}</span>
@endif
<div class="additional_game">
    @if(is_object($result->results->additional_games) && isset($result->results->additional_games->megaplier))
    <span class="label">{{ __('Megaplier') }}:<i>{{ $result->results->additional_games->megaplier }}</i></span>
    @endif
</div>