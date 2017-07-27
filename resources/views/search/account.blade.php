<!DOCTYPE html>
<html>
<head>
  <title>VueJs</title>
 
  <link rel="stylesheet" type="text/css" href="css/app.css">
<script src="js/vue.js"></script>
<script src="js/vueresource.js"></script>
<meta id='token' name="token" value="{{ csrf_token() }}">


</head>

<body>
<h1 align="middle">Accounts</h1>
<center>

  <button type="button" 
  @click="todo_payout"
   class="btn btn-success">支出查询</button>



<button type="button" 
@click="todo_addacc" class="btn btn-success">增加科目</button>

<button type="button" 
@click="todo_searchacc" class="btn btn-success">科目查询</button>
</center>


<task-app :if_payout="if_payout" :if_addacc="if_addacc" :if_searchacc="if_searchacc">

</task-app>

<template id="tasks-template" >



  <div class="container" >
  <h1 v-if='computres.length'>共@{{ computres.length }}条数据</h1>
 <hr>

<form v-if=if_payout class="form-group" @submit="searchPayout">
  <input type="text" class="form-control" name="" v-model='payoutKey'>
  时间查询：<input type="checkbox" id="checkbox" v-model="if_date">
  <button type="submit" class="btn btn-block btn-success">查询支出</button>
  </form>

  <hr>
  <form v-if=if_addacc class="form-group" @submit="createTask">
  <input type="text" class="form-control" name="" v-model='account_number'>
  <span style='color: red'>@{{responseResult}}</span>
  <input type="text" class="form-control" name="" v-model='account_name'>
  <button type="submit" class="btn btn-block btn-success">增加科目</button>
  </form>

  <form v-if=if_searchacc class="form-group" @submit="search">
  <span>  search_key:@{{ search_key }}</span>
  <input type="text" class="form-control" name="" v-model='search_key'>
  即可：<input type="checkbox" id="checkbox" v-model="checked">
  <button type="submit" class="btn btn-block btn-success">查询科目</button>
    
    
  </form>
 
    <ul class="list-group">
      <li class="list-group-item" v-for= "task in computres |orderBy 'id'">
      <strong @click="deleteTask(task)">X</strong>
      @{{ task.account_number?task.account_number:task.amount }}------@{{ task.account_name?task.account_name:task.zhaiyao}}---@{{ task.payee?task.payee:' ' }}
      ---@{{ task.created_at }} <strong @click="deleteTask(task)">X</strong></li>
    </ul>




    <select name="" id="input" class="form-control">
      <option  v-for="task in computres |orderBy 'id'" value="">-- @{{ task.account_number?task.account_number:task.amount }}------@{{ task.account_name?task.account_name:task.zhaiyao}}---@{{ task.payee?task.payee:' ' }} --</option>
    </select>



</div>
</template>





<script>
Vue.http.headers.common['X-CSRF-TOKEN']=document.querySelector('#token').getAttribute('value');
Vue.component('task-app',{
  template:'#tasks-template',
 props:['list','search_key','notes','result','data',
        'checked','account_number','account_name','responseResult','payoutKey','if_payout','if_addacc','if_searchacc','if_date'],
  created:function(){

  },

  computed:{
      computres:function(){
         if(this.checked){
          this.$http.post('api/account',{account_name:this.search_key},function(response){
          this.data = response.task;
          console.log(response.task);          
        });
         return this.data;
       }else {

        return this.data;

       };
      },

  },

  methods:{
    deleteTask:function(task){
      this.list.$remove(task);
    },
    search:function(e){
      e.preventDefault();
      this.$http.post('api/account',{account_name:this.search_key},function(response){
        console.log(response.task);
        this.data = response.task;
      }) ;
      this.search_key = '';
      return this.data;
      },


    searchPayout:function(e){
      e.preventDefault();
      if (this.if_date) {
      this.$http.post('api/payout_with_date',{zhaiyao:this.payoutKey},function(response){
        console.log(response.task);
        this.data = response.task;
      });
      } else {
        this.$http.post('api/payout',{zhaiyao:this.payoutKey},function(response){
        console.log(response.task);
        this.data = response.task;
      });

      }

      this.search_key = '';
      return this.data;
      },

    createTask:function(e){
      e.preventDefault();
      this.$http.post('api/addaccount',{account_name:this.account_name,
        account_number:this.account_number},function(response){
        console.log(response);
        this.responseResult=response.status;
      }.bind(this)) ;
      this.notes = '';

    },

  },
});

  vm = new Vue({
  
    el: "body",
    data: {
      if_payout:false,
      if_addacc:false,
      if_searchacc:false,
    },
    methods:{
      todo_payout:function(){
        this.if_payout=true;
        this.if_addacc=false;
        this.if_searchacc=false;
      },
      todo_searchacc:function(){
        this.if_payout=false;
        this.if_addacc=false;
        this.if_searchacc=true;

      },
      todo_addacc:function(){
        this.if_payout=false;
        this.if_addacc=true;
        this.if_searchacc=false;

      },
    }
  
  })
</script>

</body>
</html>