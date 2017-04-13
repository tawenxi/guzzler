@extends('layout')
@section('content')
<h1>Articles</h1>

<article>
	
	<h2>

		@foreach ($articles as $article)
				<a href={{ action("ArticleController@show",[$article->id]) }} >
					{{$article->title}}
				</a>

			<hr>
		@endforeach
	</h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop