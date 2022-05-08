@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Images</h1>

    <form action="{{ route('upload-image') }}" method="post" enctype="multipart/form-data" id="submit_image">
        @csrf
        <label>Upload an Image</label>
        <small class="avatar-upload-criteria">Picture must be a jpg or png no bigger than 2mb.</small>
        <label for="image" class="btn btn-primary">Upload Image</label>
        <input type="file" name="upload_image" id="image" onchange="this.form.submit()" hidden>
    </form>
</div>

<div class="container image-container">
    <hr />
    <h2>Image Library</h2>
    <p>Copy the image filename below and paste into the image field when creating/editing a post.</p>

    <div class="row">
        <?php $images_path = array_diff(File::allFiles(public_path("storage/images/posts"), array('.', '..'))); ?>
        @foreach($images_path as $image)
        @php $image_name = basename($image); @endphp
        <div class="col">
            <img src='{{ asset("storage/images/posts/$image_name") }}' class="img-thumbnail">
            <p>{{ $image_name }}</p>
            <form action="{{ route('delete-image') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $image_name }}">
                <input type="submit" value="Delete Image" class="btn btn-sm btn-danger inline-block">
            </form>
        </div>
        @endforeach
    </div>
</div>

@endsection
