@if($enabled)
    <div
            id="{{ $nameFieldName }}_wrap"
            @if($withCsp) @cspNonce @endif
            style="display: none"
            aria-hidden="true"
    >
        <input
                id="{{ $nameFieldName }}"
                name="{{ $nameFieldName }}"
                type="text"
                value=""
                x-model="{{ !empty($scope)? ($scope . '.' . $nameFieldName) : $nameFieldName  }}"
                autocomplete="nope"
                tabindex="-1"
        >
        <input
                name="{{ $validFromFieldName }}"
                type="text"
                value="{{ $encryptedValidFrom }}"
                x-model="{{!empty($scope)? ($scope . '.' . $validFromFieldName) : $validFromFieldName }}"
                autocomplete="off"
                tabindex="-1"
        >
    </div>
@endif