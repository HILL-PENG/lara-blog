<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table,tr,td{
        border:1px solid black;
    }
</style>
<body>
    <table>
        <tr>
            <td>id</td>
            <td>username</td>
            <td>password</td>
            <td>operation</td>
        </tr>
@foreach($userInfo as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->password}}</td>
            <td><a href="/user/edit/{{$user->id}}">edit</a>&nbsp;<a href="">del</a></td>
        </tr>
@endforeach
    </table>
</body>
</html>