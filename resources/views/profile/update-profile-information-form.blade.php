<x-jet-form-section-profile>
    <x-slot name="title">
        {{ __('Osobni podaci') }}
    </x-slot>

    <x-slot name="description">
    </x-slot>

    <x-slot name="form">
        <form method="POST" action="/profile/update">
            @csrf

            <link rel="stylesheet" href="{{ URL::asset('css/table.css') }}">
            <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
            <link rel="stylesheet" href="{{ URL::asset('css/toggle.css') }}">
            <style>
                tr {
                    border-style: hidden;
                }
            </style>

            <table class="table table-hover" style="margin-top:20px;">
                <tr>
                    <th scope="row" style="width:20%;"><label for="naziv">Ime: </label></th>
                    <td><input type="text" id="naziv" name="name" class="form-control" value="{{ $user->name }}"></td>
                </tr>
                <tr>
                    <th scope="row" style="width:20%;"><label for="email">E-mail: </label></th>
                    <td><input type="text"  name="email" class="form-control" value="{{ $user->email }}"> </td>
                </tr>

                @if($role == 'technician')
                <tr>
                    <th scope="row" style="width:20%;"><label for="notifikacije">Email notifikacije: </label></th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="notifikacije" {{ $no }}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>  
                @endif

                
            </table>

            <div>
                <button type="submit" class="btn btn-pink-primary" style="width:100px; float:right; margin-bottom:10px;">
                    {{ __('Spremi') }}
                </button>
            </div>
        </form>
    </x-slot>
</x-jet-form-section-profile>
