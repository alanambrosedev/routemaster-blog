<h1>Create a New Post</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <label>Title:</label>
    <input type="text" name="title" required>
    <br><br>

    <label>Body:</label>
    <textarea name="body" required></textarea>
    <br><br>

    <button type="submit">Submit</button>
</form>
