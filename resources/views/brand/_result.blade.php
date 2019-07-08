<ul class="result">
    @foreach($result->results->main_result as $ball)
    <li>{{ $ball }}</li>
    @endforeach
</ul>
<span class="extra_ball">{{ $result->results->extra_ball }}</span>
<div class="additional_game">
    <span class="label">{{ __('Megaplier') }}:<i>{{ $result->results->additional_games->megaplier }}</i></span>
</div>