<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locations</title>

</head>
<body>

<div class="container">

    @yield('content')


    <h2>Basic HTML Table</h2>

    <table style="width:100%">


            <tr>
                <th>Id</th>
                <th>Location name</th>
                <th>Location Id</th>
            </tr>
        @foreach($locations as $location)
            <tr>
                <td align="center">{{$location->id}}</td>
                <td align="center">{{$location->name}}</td>
                <td align="center">{{$location->location_id}}</td>
            </tr>

            @endforeach

    </table>
{{--
        <tr>
            <th>{{}}</th>
            <th>Lastname</th>
            <th>Age</th>
        </tr>
        <tr>
            <td>Jill</td>
            <td>Smith</td>
            <td>50</td>
        </tr>
        <tr>
            <td>Eve</td>
            <td>Jackson</td>
            <td>94</td>
        </tr>
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td>80</td>
        </tr>--}}






</div>

<div class="container">
    @yield('footer')

</div>
</body>
</html>
