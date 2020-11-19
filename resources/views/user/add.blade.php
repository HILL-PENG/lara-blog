<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ url('user/store') }}" method="post">
{{ csrf_field() }}
    <table>
        <tr>
            <td>username:</td>
            <td><input type="text" name="username" autocomplete="off"></td>
        </tr>
        <tr>
            <td>password:</td>
            <td><input type="text" name="password" autocomplete="off"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="submit"></td>
        </tr>
    </table>
</form>
</body>
</html>