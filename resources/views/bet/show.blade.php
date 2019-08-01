<div class="mdl-cell mdl-cell--12-col">
    <h1>Bets</h1>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th># ID</th>
            <th>Line</th>
            <th>Extra balls</th>
            <th>Extra games</th>
            <th>Ticket number</th>
            <th>Number shield</th>
            <th>Draw date</th>
            <th>Price</th>
            <th>Status</th>
            <th>Brand</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->bets as $bet)
            <tr>
                <td>{{ $bet->id }}</td>
                <td>{{ implode(',', $bet->line) }}</td>
                <td>{{ implode(',', $bet->extra_balls) }}</td>
                <td>{{ implode(',', $bet->extra_games) }}</td>
                <td>{{ $bet->ticket_number }}</td>
                <td>{{ $bet->number_shield == true ? 'Yes' : 'No' }}</td>
                <td>{{ $bet->draw_date->format('d-m-Y') }}</td>
                <td>{{ $bet->price }}</td>
                <td>{{ $bet->status }}</td>
                <td>{{ $bet->brand->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
