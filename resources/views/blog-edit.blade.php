<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="">
    <div class="container">
        <div class="mt-5">
            <h2 class="">Edit Blog : {{$blog->title}}</h2>
            @if ($errors->any())
            <div class="alert alert-danger col-md-6">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="" action="{{url('/blog/'.$blog->id.'/update')}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="col-md-6">
                    <label for="title" class="form-label">Title :</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$blog->title}}"
                        placeholder="Tuliskan Judul">
                </div>

                <div class="col-md-6 mt-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" placeholder="Tuliskan Deskripsi" id="description"
                        style="height: 100px; resize: none; " name="description" rows="5">{{$blog->title}}</textarea>
                </div>

                <div class="col-md-6 mt-4">
                    <button type="submit" class="btn btn-success form-control">Edit</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Bootstrap 5 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>


</html>
