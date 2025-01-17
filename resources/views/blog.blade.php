<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLog Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="">
    <div class="container py-4">
        <h1 class="text-center mb-5">Blog List</h1>

        <!-- Top Section: Pagination and Search -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <a href="{{url('blog/add')}}" class="btn btn-primary">Tambah Blog</a>
            </div>
            <div class="col-md-6">
                <form action="" method="GET" class="d-flex justify-content-end">
                    <input class="form-control me-2" type="search" placeholder="Cari blog..." aria-label="Cari"
                        name="title" value="{{ $title }}">
                    <button class="btn btn-success" type="submit">Cari</button>
                </form>
            </div>
        </div>

        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

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
                        <!-- Judul Blog -->
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        
                        <!-- Gambar Blog -->
                        @if ($blog->image)
                            <img src="{{ $blog->image->url }}" class="img-fluid rounded mb-3" alt="{{ $blog->image->name }}">
                        @endif
                        
                        <!-- Rating -->
                        @if ($blog->ratings->count() < 1)
                            <h6 class="text-muted">Not rated yet</h6>
                        @else
                            @php
                                $averageRating = collect($blog->ratings->pluck('rating_value'))->avg();
                                $roundedRating = round($averageRating);
                            @endphp
                            <div class="mb-3">
                                <h6 class="card-title mb-1">
                                    <strong>{{ number_format($averageRating, 1) }}</strong> / 5
                                </h6>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $roundedRating)
                                            <i class="bi bi-star-fill text-warning"></i> <!-- Bintang penuh -->
                                        @else
                                            <i class="bi bi-star text-warning"></i> <!-- Bintang kosong -->
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @endif
                        
                        <!-- Tanggal Pembuatan -->
                        <h6 class="card-subtitle text-muted mb-3">{{ $blog->created_at}}</h6>
                        
                        <!-- Deskripsi -->
                        <p class="card-text flex-grow-1">{{ Str::limit($blog->description, 100, '...') }}</p>
                        
                        <!-- Tags -->
                        <div class="d-flex flex-wrap mb-3">
                            @if ($blog->tags->isEmpty())
                                <h5 class="me-2"><span class="badge text-bg-danger text-light">No Tag</span></h5>
                            @endif
                            @foreach ($blog->tags as $tag)
                                <h5 class="me-2"><span class="badge text-bg-info text-light">{{ $tag->name }}</span></h5>
                            @endforeach
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end mt-auto">
                            <a href="{{ url('blog/' . $blog->id . '/edit') }}" class="btn btn-outline-primary btn-sm mx-1">Edit</a>
                            <a href="{{ url('blog/' . $blog->id . '/detail') }}" class="btn btn-outline-success btn-sm mx-1">Detail</a>
                            <a href="{{ url('blog/' . $blog->id . '/delete') }}" class="btn btn-outline-danger btn-sm mx-1">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links() }}
            </div>
        </div>        
    </div>


    <!-- Bootstrap 5 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>


</html>
