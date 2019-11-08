
<!DOCTYPE html>
<html>
<head>
    <title>Setare proiect</title>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;

        }
    </style>
</head>
<body>
<br />
<form method="post" action="/projects" autocomplete="off">
    {{ csrf_field() }}
    <h3 align="center">Setare proiect</h3><br />
    <div class="container box">
       {{-- <div class="form-group">
            <input type="text" name="cuvant_cheie" id="keyword" class="form-control input-lg" placeholder="Cuvant cheie" />
            <div id="cuvant_cheie">
            </div>
        </div>--}}
        <div class="form-group">
            <textarea rows="2" cols="50"  name="cuvant_cheie" id="keyword" class="form-control input-lg" placeholder="Cuvant cheie" /></textarea>
            <div id="cuvant_cheie">
            </div>

        </div>

    </div>

    <div class="container box">
    <div class="form-group">
        <input type="text" name="url_proiect" id="url_proiect" class="form-control input-lg" placeholder="URL proiect" />
    </div>
    </div>

    <div class="container box">
        <div class="form-group">
            <input type="text" name="se_name" id="se_name" class="form-control input-lg" placeholder="Enter search engine" />
            <div id="search_engine">
            </div>
        </div>
    </div>

    <div class="container box">
        <div class="form-group">
            <input type="select" name="se_language" id="se_language" class="form-control input-lg" placeholder="Enter search language" />
            <div id="search_language">
            </div>
        </div>
    </div>

    <div class="container box">
        <div class="form-group">
            <input type="text" name="se_location" id="se_location" class="form-control input-lg" placeholder="Enter location" />
            <div id="search_location">
            </div>
        </div>
    </div>

    <div class="container box">
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Cauta">
        </div>
    </div>

</form>
</body>
</html>

<script>
    $(document).ready(function(){

        $('#se_name').keyup(function(){

            var query = $(this).val();

            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('search.engine') }}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#search_engine').fadeIn();
                        $('#search_engine').html(data);
                        /*return  $('#search_engine').html(data);*/

                    }
                });
            }

            $('#search_engine').on('click', 'li', function(){
                $('#se_name').val($(this).text());
                $('#search_engine').fadeOut();

            });
        });

        $('#se_name').change(function(){
            var se_engine = $('#se_name').val();
            console.log(se_engine);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('search.language') }}",
                method:"POST",
                data:{query:se_engine, _token:_token},
                success:function(data){
                    $('#search_language').fadeIn();
                    $('#search_language').html(data);
                }
            });
        });

        $('#se_language').keyup(function(){
            var query = $(this).val();
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('search.language') }}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#search_language').fadeIn();
                        $('#search_language').html(data);
                    }
                });
            }
        });

        $('#search_language').on('click', 'li', function(){

            $('#se_language').val($(this).text());
            $('#search_language').fadeOut();
        });

        $('#se_location').keyup(function(){
            var query = $(this).val();
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('search.location') }}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#search_location').fadeIn();
                        $('#search_location').html(data);
                    }
                });
            }
        });

        $('#search_location').on('click', 'li', function(){

            $('#se_location').val($(this).text());
            $('#search_location').fadeOut();

        });
    });
</script>








































{{--@extends('layouts.app')

@section('content')

    <form method="post" action="/results">

        <input type="text" name="cuvant_cheie" placeholder="Cuvant cheie">

        <select name="motor_cautare">
            <option value="google.com">google.com</option>
            <option value="google.co.uk">google.co.uk</option>
            <option value="google.ro">google.ro</option>
            <option value="google.com.af">google.com.af</option>--}}{{--
        </select>

        <select name="limba">
            <option value="English" >English</option>
            <option value="Romanian">Romana</option>

        </select>

        <input type="submit" name="submit" value="Cauta">
        {{csrf_field()}}
    </form>


@stop

@section('footer')



@stop--}}
