@forelse ($blogPosts as $blogPost)
    <div class="blog-container">
        <div class="d-flex justify-content-between">
            <h4>{{ $blogPost->title }}</h4>
            <p class="time-elapsed" data-created-at="{{ $blogPost->created_at }}"></p>
        </div>
        <div>
            <p>{{ $blogPost->content }}</p>
            <small>By: {{ $blogPost->user->name }}</small>
        </div>
    </div>
@empty
    <div class="blog-container" id="emptyPostLabel">No post uploaded yet</div>
@endforelse