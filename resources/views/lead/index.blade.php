@extends('layouts.crm.dashboard')
@section('crm_content')
    <h1>Leads</h1>
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th># ID</th>
            <th>Host</th>
            <th>Cart items count</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->id }}</td>
                <td>{{ $lead->host }}</td>
                <td>{{ is_array($lead->cart_items) ? count($lead->cart_items) : 0 }}</td>
                <td>{{ $lead->status }}</td>
                <td>{{ $lead->created_at }}</td>
                <td>{{ $lead->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
