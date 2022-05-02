@extends ('tvshop\layout')

@section('content')
<h1>Create form for new TV</h1>

<form action="/store" method="POST" enctype="multipart/form-data">
	@csrf
	<ul>Model: <input name="model"/></ul>
	<ul>Price: <input name="price"/></ul>
	<ul>Image: <input type="file" name="path"/></ul>
	<p>
		<button type="submit">Submit</button>
	</p>
</form>

@endsection
