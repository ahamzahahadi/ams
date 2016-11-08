<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
    <body>
    <div class="container">
        {{--Header Started--}}

        <div class="btn btn-block"><a href="{{ route('book.create')  }}"><h2>Add New Book</h2></a></div>
        <table class="table table-striped">
            <tr>
                <td> Title </td>
                <td> Description </td>
                <td> Author </td>
            </tr>

        @foreach( $allBooks as $book )
            <tr>
                <td>{{$book->title}}</td>
                <td>{{$book->description}}</td>
                <td>{{$book->author}}</td>
            </tr>

        @endforeach
        </table>
        {{--Footer Finished--}}
    </div>
    </body>
</html>