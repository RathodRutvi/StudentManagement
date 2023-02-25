<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <td>Name</td>
            <td>English</td>
            <td>Hindi</td>
            <td>Gujarati</td>
        </tr>
        @foreach($marks as $mark)
        <tr>
        <td> {{$mark->name}}</td>
        <td> {{$mark->english}}</td>
        <td> {{$mark->hindi}}</td>
        <td> {{$mark->gujarati}}</td>
        </tr>
       
        @endforeach

    </table>
</body>

</html>