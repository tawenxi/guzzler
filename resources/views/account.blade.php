<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/app.css">
</head>
<body>
	
<table class="table table-striped table-condensed">
	<caption>会计科目表</caption>
	<thead>
		 <tr id="tr_id_1" class="tr-class-1">
			<th>摘要</th>
		</tr>
	</thead>
	<tbody>
@foreach($es as $k=>$e)
		<tr class="info">
			  <td id="td_id_1" class="td-class-1">{{ $k }}</td>

 			@foreach($e as $p)
			  <td id="td_id_1" class="td-class-1">
			
			{{  $p }} 
			
			 </td>
			  @endforeach
		</tr>
@endforeach
	</tbody>
</table>


</body>
</html>