<!DOCTYPE html>
<html>
<head>
	<title>form</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>

<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
    {!! Form::label('date', 'Input label') !!}
    {!! Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('date') }}</small>
</div>
</body>
</html>