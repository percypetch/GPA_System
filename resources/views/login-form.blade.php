<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title> Login </title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>
    </head>
    <body>
        <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <br>
            <h1 class="center"> Login Form </h1>
            
            @error('email')
                <div class="">{{ $message }}</div>
            @enderror

        <table class="tablecenter normal alignRight">
            <tr>
                <td>
                    <label>
                            E-mail <input type="text" name="email" require/>
                    </label><br />
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        Password <input type="password" name="password" require/>
                    </label><br />
                </td>
            </tr>
            <tr>
                <td>
                     <button type="submit">Login</button>
                </td>
            </tr>
        </table>

        </form>

        <form action="{{ route('authenticate') }}" method="post">
        @csrf
            <td>
                <input type="hidden"  name="email" value="guest@gpa.com" >
                <input type="hidden"  name="password" value="1234" >
                <button type="submit">Guest Login</button>
            </td>
        </form>
    </body>
</html>