<!DOCTYPE html>
<html>
<head>
	<title>{{ $post->title }}</title>
</head>
<body>
<h1>{{ $post->title }}</h1>
@can('edit')
编辑文章
@endcan
</body>
</html>