<!DOCTYPE html>
<html>
<head>
  <title>支出查询系统</title>
 
  <link rel="stylesheet" type="text/css" href="css/app.css">
<script src="js/vue.js"></script>
<script src="js/vueresource.js"></script>
<meta id='token' name="token" value="{{ csrf_token() }}">


</head>

<body>
<h1 align="middle">Accounts</h1>
<article>







  <div class="container" >
  <h1 v-if='payoutresult'>共@{{ payoutresult.length }}条数据</h1>
 <hr>


<form  class="form-group" @submit="searchPayout">
  <input type="text" class="form-control" name="" v-model='search_key'>
  时间查询：<input type="checkbox" id="checkbox" v-model="if_date">
  <button type="submit" class="btn btn-block btn-success">查询支出</button>
 </form>


	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>
		<thead>
			<tr class='success'>
				<th>时间</th><th>摘要</th><th>收款人</th><th>金额</th><th>科目</th><th>关键字</th><th>科目列表</th><th>更新</th>
			</tr>
		</thead>
		<tbody class='alert-info' v-if=vv>			
			<tr v-if=vv>

			

			</tr>	
				<td>			
				@{{ payout.created_at }}
				</td>
				<td>		
						@{{ payout.zhaiyao }}	
				</td>
				<td>
				@{{ payout.payee }}
					</td>
				<td>@{{ payout.amount }}</td>
				<td>@{{ payout.kemu }}</td>
				
			

		</tbody>
	</table>
			<hr>	
</article>


<template id='acc'>
	<td>
		<input type="text" 
			   class="form-control" 
			   name="" 
			   v-model='search_kemu_key'>
	</td>
	<td>
	    <select name="" id="input" class="form-control">
            <option  v-for="task in kemuss |orderBy 'id'" value="">-- @{{ task.account_name }} --</option>
        </select>
	</td>
	<td>
		dddddddddd
	</td>
</template>

<script>
Vue.http.headers.common['X-CSRF-TOKEN']=document.querySelector('#token').getAttribute('value');

Vue.component('acc-app',{
  template:'#acc',
  props:['kemu_key','search_kemu_key','kemus'],
  methods:{

  },
  computed:{
  kemuss:function(){
         if (this.search_kemu_key) {
          this.$http.post('api/account',{account_name:this.search_kemu_key},function(response){
          this.kemus = response.task;
          console.log(response.task);          
        });
         return this.kemus;
         }
      },
    },


});

var vm = new Vue({

    el: "body",
    data:{
        payoutresult:'',
        search_key:"",
        search_kemu_key:"",
        vv:1,
    },

    methods:{
    	searchPayout:function(e){
    		e.preventDefault();
      		this.$http.post('api/payout',{zhaiyao:this.search_key},function(response){
        console.log(response.task);
        this.payoutresult = response.task;
      }) ;
    	}
    },

    computed:{


    },

})
</script>



</body>
</html>