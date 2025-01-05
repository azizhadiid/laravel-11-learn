<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLog Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="">
    <div class="container py-4">
        <h1 class="text-center mb-5">Blog List</h1>

        <!-- Top Section: Pagination and Search -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <div class="d-flex">
                    {{ $blogs->links() }}
                </div>
            </div>
            <div class="col-md-6">
                <form action="" method="GET" class="d-flex justify-content-end">
                    <input class="form-control me-2" type="search" placeholder="Cari blog..." aria-label="Cari"
                        name="title" value="{{ $title }}">
                    <button class="btn btn-success" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <!-- Alert for No Data -->
        @if ($blogs->count() === 0)
        <div class="alert alert-primary text-center" role="alert">
            Tidak ada data dari Kata <strong>{{ $title }}</strong>
        </div>
        @endif

        <!-- Blog Cards -->
        <div class="row g-4">
            @foreach ($blogs as $blog)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <h6 class="card-subtitle text-muted mb-3">{{ $blog->created_at}}</h6>
                        <p class="card-text flex-grow-1">{{ $blog->description }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-outline-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-outline-danger btn-sm">Hapus</a>
                        </div>
                    </div>
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
