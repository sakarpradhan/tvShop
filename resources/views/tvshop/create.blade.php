@extends ('tvshop\layout')

@section('content')
<h1>Create form for new TV</h1>

<form action="/store" method="POST" enctype="multipart/form-data">
	@csrf
	<ul>Model: <input name="model"/></ul>
    @error('model')
    <ul>{{ $message }}</ul>
    @enderror

	<ul>Price: <input name="price"/></ul>
    @error('price')
    <ul>{{ $message }}</ul>
    @enderror

	<ul>Image: <input type="file" name="path"/></ul>
    @error('path')
    <ul>{{ $message }}</ul>
    @enderror

	<p>
		<button type="submit">Submit</button>
	</p>
</form>

@endsection
