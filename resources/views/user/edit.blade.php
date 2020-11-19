<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ url('user/update') }}" method="post">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{$userInfo->id}}">
    <table>
        <tr>
            <td>username:</td>
            <td><input type="text" name="username" value="{{$userInfo->username}}" autocomplete="off"></td>
        </tr>
        <tr>
            <td>password:</td>
            <td><input type="text" name="password" value="{{$userInfo->password}}" autocomplete="off"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="submit"></td>
        </tr>
    </table>
</form>
</body>
</html>