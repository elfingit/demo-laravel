<ul class="result de_lotto">
    @foreach($result->results->main_result as $ball)
        <li>{{ $ball }}</li>
    @endforeach
</ul>
<div style="clear: both"></div>
<div class="additional_game de_lotto">
    <div class="mdl-list">
        <div class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <span><b>{{ __('Lucky stars') }}:</b></span>
            </span>
            <span class="mdl-list__item-secondary-content">
                <span class="mdl-list__item-text-body">{{ implode(',' ,$result->results->extra_ball) }}</span>
            </span>
        </div>
    </div>
</div>
