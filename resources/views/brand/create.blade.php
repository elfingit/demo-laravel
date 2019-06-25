@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid form-panel">
        <div class="mdl-cell mdl-cell--8-col mdl-cell--6-col-tablet mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ __('Add new brand') }}</h2>
            </div>
            <form method="post" action="{{ route('dashboard.brands.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="mdl-card__supporting-text">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('name') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="name" type="text" id="name" value="{{ old('name') }}">
                        <label class="mdl-textfield__label" for="name">{{ __('Brand name') }}</label>
                        @error('name')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @error('code') is-invalid @enderror">
                        <input class="mdl-textfield__input" name="code" type="text" id="code" value="{{ old('code') }}">
                        <label class="mdl-textfield__label" for="code">{{ __('Brand code') }}</label>
                        @error('code')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file @error('logo') is-invalid @enderror">
                        <input class="mdl-textfield__input" placeholder="{{ __('Logo') }}" type="text" id="uploadFile" readonly/>
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                            <i class="material-icons">attach_file</i><input type="file" name="logo" id="uploadBtn">
                        </div>
                        @error('logo')
                        <span class="mdl-textfield__error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--colored">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection