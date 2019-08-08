@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--4-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    @if ($user->profile)
                    <h2 class="mdl-card__title-text">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</h2>
                        &nbsp;
                    @endif
                    <user-status user-id="{{ $user->id }}" status="{{ $user->status }}" :statuses="{{ json_encode(\User::getStatuses()) }}" />
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="crm-table">
                        <tbody>
                            <tr>
                                <td>
                                    <span><b>{{ __('User ID') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">{{ $user->id }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('User role') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">{{ $user->role->name }}</span>
                                </td>
                            </tr>
                            @if($user->profile)
                            <tr>
                                <td>
                                    <span><b>{{ __('Site') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">{{ $user->profile->host }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('First name') }}:</b></span>
                                </td>
                                <td>
                                    <span class="item-text-body">{{ $user->profile->honorific }} {{ $user->profile->first_name }}</span>
                                </td>
                                <td>
                                    <user-authorized-toggle :status="{{ $user->is_authorized == true ? 1 : 0 }}" :user-id="{{ $user->id }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('Last name') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">{{ $user->profile->last_name }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('Birthday') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">
                                        @if ($user->profile->date_of_birth)
                                            {{ $user->profile->date_of_birth->format('m-d-Y') }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('Country') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">{{ $user->profile->country }}</span>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                    <span><b>{{ __('Email') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <show-button :url="'{{ route('dashboard.crm_api.users.show.field', ['user' => $user->id]) }}'" :param="'email'" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
