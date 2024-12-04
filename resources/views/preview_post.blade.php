<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="https://cdn2.iconfinder.com/data/icons/boxicons-solid-vol-2/24/bxs-note-256.png" type="image/png">
        <link 
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
            crossorigin="anonymous"
        >
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <title>Blog Posting</title>
    </head>
    <body>
        <div class="container">
            <div class="text-center mb-4 d-flex justify-content-between">
                <h1 class="display-3">Blog Posting</h1>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('loginPage') }}" target="_parent" class="btn align-self-center">Login</a>
                    <a href="{{ route('registerPage') }}" target="_parent" class="btn align-self-center">Register</a>
                </div>
            </div>
            <hr class="my-4">
            <h1>Post List</h1>
            <div id="postList">
                <!-- post list will appear here -->
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
            crossorigin="anonymous"
        ></script>
        <script src="https://res.cloudinary.com/dy0sbkf3u/raw/upload/Dialog.min.js"></script>
        <script src="{{ asset('js/blogpost_preview.js') }}"></script>
    </body>
</html>