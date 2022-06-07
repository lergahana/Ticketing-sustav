<x-jet-form-section-profile>
    <x-slot name="title">
        {{ __('Ažuriranje lozinke') }}
    </x-slot>

    <x-slot name="description">
    </x-slot>

    <x-slot name="form">
        <form method="POST" action="/user/password/update">
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
                    <th scope="row" style="width:20%;"><label for="old_pass">Trenutna lozinka: </label></th>
                    <td><input type="password" id="old_pass" name="old_pass" class="form-control" required></td>
                </tr>
                @if (Session::has('message'))
                    <div class="alert alert-danger" style="margin-top:5px;">{{ Session::get('message') }}</div>
                @endif
                <tr>
                    <th scope="row" style="width:20%;"><label>Nova lozinka: </label></th>
                    <td><input type="password" id="new_pass" name="new_pass" class="form-control" required> </td>
                </tr>

                <tr>
                    <th scope="row" style="width:20%;"><label>Potvrdi lozinku: </label></th>
                    <td><input type="password" id="confirm_pass" name="confirm_pass" class="form-control" required> </td>
                </tr>

                <tr>
                    <th></th>
                    <td><span id="check"> </span></td>
                </tr>

            </table>

            <div>
                <button type="submit" id="pass_btn" class="btn btn-pink-primary" style="width:100px; float:right; margin-bottom:10px;">
                    {{ __('Spremi') }}
                </button>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#new_pass").on('keyup', function() {
                        var new_pass = $("#new_pass").val();
                        if (new_pass.length < 8){
                            $("#check").html("Lozinka mora imati 8 znakova!").css("color", "red");
                            $("#confirm_pass").attr('disabled','disabled');
                            $("#pass_btn").attr('disabled','disabled');
                        } else {
                            $("#check").html("");
                            $("#confirm_pass").removeAttr('disabled');
                            $("#pass_btn").removeAttr('disabled');
                        }
                    });

                    $("#confirm_pass").on('keyup', function() {
                        var new_pass = $("#new_pass").val();
                        var confirm_pass = $("#confirm_pass").val();
                        if (new_pass != confirm_pass){
                            $("#check").html("Lozinke se ne podudaraju!").css("color", "red");
                            $("#pass_btn").attr('disabled','disabled');
                        } else {
                            $("#check").html("Lozinke se podudaraju!").css("color", "green");
                            $("#pass_btn").removeAttr('disabled');
                        }
                    });
                });
            </script>
        </form>
    </x-slot>
</x-jet-form-section-profile>