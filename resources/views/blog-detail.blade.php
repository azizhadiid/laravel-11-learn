<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Blog Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="">
    <div class="container">
        <div class="mt-5">
            <h2 class="text-center">{{$blog->title}}</h2>
            <div class="body-blog">
                <p class="mt-4">
                    {{$blog->description}}
                </p>

                <div class="d-flex flex-wrap">
                    @if ($blog->tags->isEmpty())
                    <h5 class="me-2"><span class="badge text-bg-info text-light">No Tag</span></h5>
                    @endif
                    @foreach ($blog->tags as $tag)
                    <h5 class="me-2"><span class="badge text-bg-info text-light">{{$tag->name}}</span></h5>
                    @endforeach
                </div>

                <div>
                    <div class="d-flex flex-column align-items-end">{{$blog->created_at}}</div>
                    <div class="d-flex flex-column align-items-end">By  {{$blog->author ? $blog->author->name : "admin wak"}}</div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            @if ($errors->any())
            <div class="alert alert-danger col-md-6 form-control">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            <label for="comment">Comments :</label>
            <form action="{{url('comment/'.$blog->id) }}" method="POST">
                @csrf
                {{-- <input type="hidden" name="blog_id" value="{{$blog->id}}"> --}}
                <textarea name="comment_text" id="comment" rows="5" class="form-control"
                    style="resize: none"></textarea>
                <button class="btn btn-primary mt-3" type="submit">Submit</button>
            </form>
        </div>

        <hr class="mt-5">

        <div class="mt-5">
            <div class="alert alert-warning {{ $blog->comments->count() === 0 ? 'd-block' : 'd-none' }}" role="alert">
                {{ $blog->comments->count() === 0 ? 'Tidak Ada Komen!' : '' }}
            </div>
            @foreach ($blog->comments as $comment)
            <div class="card mb-3">
                <h5 class="card-header">Featured</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">{{$comment->comment_text}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <!-- Bootstrap 5 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>


</html>
