@extends('layout')

@section('content')
	{{-- expr --}}
	<h1>{{ $article->title }}</h1>
	<hr>
	<article>
		<div class='body'>
			{{ $article->content}}
			
		</div>
			
	</article>
@stop