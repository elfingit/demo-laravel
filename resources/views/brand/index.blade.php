@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <a href="{{ route('dashboard.brands.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">{{ __('Add new brand') }}</a>
    </div>

    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th># ID</th>
            <th>Logo</th>
            <th>Name</th>
            <th>Country</th>
            <th>State</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td><img class="brand-logo" src="{{ asset('/images/logos/'.$brand->logo) }}" /></td>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->country }}</td>
            <td>{{ $brand->state }}</td>
            <td>@brand_status($brand->status)</td>
            <td>{{ $brand->created_at }}</td>
            <td>{{ $brand->updated_at }}</td>
            <td>
                <a href="" id="edit"><i class="material-icons" role="presentation">edit</i></a>
                <div class="mdl-tooltip" data-mdl-for="edit">
                    Edit brand data
                </div>
                <a href="" id="autorenew"><i class="material-icons" role="presentation">autorenew</i></a>
                <div class="mdl-tooltip" data-mdl-for="autorenew">
                    Refresh draw master data
                </div>
                <a href="{{ route('dashboard.brands.show', ['brand' => $brand->id]) }}" id="visibility"><i class="material-icons" role="presentation">visibility</i></a>
                <div class="mdl-tooltip" data-mdl-for="visibility">
                    View brand data
                </div>
                <a href="" id="delete"><i class="material-icons" role="presentation">delete</i></a>
                <div class="mdl-tooltip" data-mdl-for="delete">
                    Disable brand
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection