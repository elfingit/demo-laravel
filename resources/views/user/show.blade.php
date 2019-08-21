@extends('layouts.crm.dashboard')
@section('crm_content')
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    @if ($user->profile)
                    <h2 class="mdl-card__title-text">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</h2>
                        &nbsp;
                    @endif
                    <user-status user-id="{{ $user->id }}" status="{{ $user->status }}" :statuses="{{ json_encode(\User::getStatuses()) }}" />
                </div>
                <div class="mdl-card__supporting-text">
                    <div>
                        <a href="{{ route('dashboard.users.edit', ['user' => $user->id]) }}" id="edit"><i class="material-icons" role="presentation">edit</i></a>
                        <div class="mdl-tooltip" data-mdl-for="edit">
                            Edit user data
                        </div>
                    </div>
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
                                    <user-param-toggle
                                        :param-name="'authorized'"
                                        :status="{{ $user->is_authorized == true ? 1 : 0 }}"
                                        :user-id="{{ $user->id }}"
                                        :label="{checked: 'Authorized', unchecked: 'Not authorized'}"
                                    />
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
                            @endif
                            <tr>
                                <td>
                                    <span><b>{{ __('Email') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <show-button :url="'{{ route('dashboard.crm_api.users.show.field', ['user' => $user->id]) }}'" :param="'email'" />
                                </td>
                            </tr>
                            @if($user->profile)
                            <tr>
                                <td>
                                    <span><b>{{ __('Country') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">{{ $user->profile->country }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('Locale time') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">
                                        <user-local-time :time-zone="{{ $user->profile->time_zone }}" />
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('Phone') }}:</b></span>
                                </td>
                                <td>
                                    <show-button :url="'{{ route('dashboard.crm_api.users.show.field', ['user' => $user->id]) }}'" :param="'phone'" />
                                </td>
                                <td>
                                    <user-param-toggle
                                        :param-name="'phone_confirmed'"
                                        :status="{{ $user->phone_confirmed == true ? 1 : 0 }}"
                                        :user-id="{{ $user->id }}"
                                        :label="{checked: 'Confirmed', unchecked: 'Not confirm'}"
                                    />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('Registration Date') }}:</b></span>
                                </td>
                                <td colspan="2">
                                    <span class="item-text-body">{{ $user->created_at->format('d-m-Y H:i:s') }}</span>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                    <span><b>{{ __('Test') }}:</b></span>
                                </td>
                                <td></td>
                                <td>
                                    <user-param-toggle
                                        :param-name="'is_test_account'"
                                        :status="{{ $user->is_test_account == true ? 1 : 0 }}"
                                        :user-id="{{ $user->id }}"
                                        :label="{checked: 'Yes', unchecked: 'No'}"
                                    />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><b>{{ __('Fraud Suspected') }}:</b></span>
                                </td>
                                <td></td>
                                <td>
                                    <user-param-toggle
                                        :param-name="'is_fraud_suspected'"
                                        :status="{{ $user->is_fraud_suspected == true ? 1 : 0 }}"
                                        :user-id="{{ $user->id }}"
                                        :color="{checked: '#FF0000'}"
                                        :label="{checked: 'Yes', unchecked: 'No'}"
                                    />
                                </td>
                            </tr>
                            @if($user->available_balance)
                                <tr>
                                    <td>
                                        <span><b>{{ __('Current Balance') }}:</b></span>
                                    </td>
                                    <td colspan="2">&euro; {{ $user->available_balance->amount }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if($user->address)
        <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Address</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="crm-table">
                        <tbody>
                        <tr>
                            <td>
                                <span><b>{{ __('No') }}:</b></span>
                            </td>
                            <td colspan="2">
                                <span class="item-text-body">{{ $user->address->house_number}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>{{ __('Street') }}:</b></span>
                            </td>
                            <td colspan="2">
                                <span class="item-text-body">{{ $user->address->street}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>{{ __('Post Code') }}:</b></span>
                            </td>
                            <td colspan="2">
                                <span class="item-text-body">{{ $user->address->zip}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>{{ __('City') }}:</b></span>
                            </td>
                            <td colspan="2">
                                <span class="item-text-body">{{ $user->address->city}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>{{ __('County') }}:</b></span>
                            </td>
                            <td colspan="2">
                                <span class="item-text-body">{{ $user->address->region}}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        <div class="mdl-cell mdl-cell--12-col">
            <expandable-area title="Bets history">
                <template v-slot:content>
                    <user-bets user-id="{{ $user->id }}" />
                </template>
            </expandable-area>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <expandable-area title="User auth docs">
                <template v-slot:content>
                    <user-auth-docs user-id="{{ $user->id }}" />
                </template>
            </expandable-area>
        </div>
        <div class="mdl-cell mdl-cell--12-col">
            <expandable-area title="Bets pending">
                <template v-slot:content>
                    <user-bet-pending
                        url="{{ route('dashboard.crm_api.users.bets.pending', ['user' => $user->id]) }}" />
                </template>
            </expandable-area>
        </div>
    </div>
@endsection
