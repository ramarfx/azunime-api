<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>judul</th>
            <th>deskripsi</th>
            <th>episode</th>
        </tr>
        @foreach ($animes as $anime)
            <tr>
                <td>{{ $anime['title'] }}</td>
                <td>{{ $anime['description'] }}</td>
                <td>{{ $anime['episode'] }}</td>
                <td><img src="{{ $anime['image'] }}" alt=""></td>
            </tr>
        @endforeach
    </table>
</body>

</html>
