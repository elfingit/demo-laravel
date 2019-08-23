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
                <span><b>{{ __('Superzahl') }}:</b></span>
            </span>
            <span class="mdl-list__item-secondary-content">
                <span class="mdl-list__item-text-body">{{ $result->results->extra_ball }}</span>
            </span>
        </div>
        <div class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <span><b>{{ __('Spiel 77') }}:</b></span>
            </span>
            <span class="mdl-list__item-secondary-content">
                <span class="mdl-list__item-text-body">{{ $result->results->additional_games->spiel77 }}</span>
            </span>
        </div>
        <div class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <span><b>{{ __('Super 6') }}:</b></span>
            </span>
            <span class="mdl-list__item-secondary-content">
                <span class="mdl-list__item-text-body">{{ $result->results->additional_games->super6 }}</span>
            </span>
        </div>
        <div class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
                <span><b>{{ __('Jackpot') }}:</b></span>
            </span>
            <span class="mdl-list__item-secondary-content">
                <span class="mdl-list__item-text-body">{{ number_format($result->jack_pot,2) }}</span>
            </span>
        </div>
    </div>
</div>
