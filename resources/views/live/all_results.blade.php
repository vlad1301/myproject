<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All search results</title>

</head>
<body>

<div class="container">

    @yield('content')

    <h2>Basic HTML Table</h2>

    <table style="width:100%">

        <tr>
            <th>ID</th>
            <th>Data si ora interogare</th>
            <th>Keyword</th>
            <th>URL</th>
            <th>Locatia</th>
            <th>Motorul de cautare</th>

        </tr>

        @foreach ($all_results as $results)

            <tr>
                <td align="center">{{$results['id']}}</td>
                <td align="center">{{$results['data_interogare']}}</td>
                <td align="center">{{$results['keyword']}}</td>
                <td align="center">{{$results['URL']}}</td>
                <td align="center">{{$results['locatia']}}</td>
                <td align="center">{{$results['se_id']}}</td>


            </tr>

        @endforeach

    </table>

</div>

<div class="container">
    @yield('footer')

</div>
</body>
</html>
