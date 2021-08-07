<template>
  <div id="right">
    <h1>Development Crm</h1>
    <div class="horizontal">
      <img src="../images/horizontal.png" />
    </div>

    <p>
      Lorem Ipsum is simply dummy text of the printing and typesetting industry.
      Lorem Ipsum has been the industry's standard dummy text ever since the
      1500s
    </p>

    <div class="users-icon"><img src="../images/users.png" /></div>

    <div class="tasks">
      <div class="add-tasks">
        <h2>Today's Task</h2>
        <div class="add-action"><img src="../images/add.png" /></div>
      </div>

      <ul class="tasks-list">
        <li v-for="task in todaytasks" v-bind:key="task.id">
          <div class="info">
            <div class="left">
              <label class="myCheckbox">
                <input
                  type="checkbox"
                  name="test"
                  :checked="task.completed"
                  @change="updateTodayTask(task.taskId)"
                />
                <span></span>
              </label>

              <h4>{{ task.title }}</h4>
            </div>
            <div class="right">
              <img src="../images/edit.png" />
              <img src="../images/del.png" @click="deleteTask(task.taskId)" />

              <button
                v-bind:class="{
                  inprogress: !task.approved,
                  approved: task.approved,
                }"
              >
                {{ task.approved ? "Approved" : "In progress" }}
              </button>
            </div>
          </div>
        </li>
      </ul>
    </div>

<div class="upcoming">
    <div class="add-tasks">
        <h2>Upcoming</h2>
        <div class="add-action">
            <img src="../images/add.png" alt="add image "/>
        </div>
    </div>
        <form action="" method="post" @submit="addUpcomingTask">
            <input type="text" name="" id="" v-model="newTask">
        </form>
        <ul class="tasks-list">
            <li v-for="upcomingtask in upcoming" v-bind:key="upcomingtask.id">
                <div class="info">
                    <div class="left">
                        <label for="" class="myCheckbox">
                            <input type="checkbox" name="test" :checked="upcomingtask.completed" @change="checkUpcoming(upcomingtask.taskId)">
                            <span></span>
                        </label>
                        <h4>{{upcomingtask.title}}</h4>
                    </div>
                    <div class="right">
                        <img src="../images/edit.png" alt="edit" >
                        <img src="../images/del.png" alt="delete"  @click="delUpcoming(upcomingtask.taskId)">
                    </div>
                </div>
            </li>
        </ul>
    
</div>


    

  </div>
</template>

<script>
export default {
  data() {
    return { 
        todaytasks:[],
        upcoming:[],
        newTask :"",
    };
  },
  created() { 
      this.fetchTodayTasks();
      this.fetchUpcoming();
  },

  methods: { 
      // add to upcoming task 
      addUpcomingTask(e){
         e.preventDefault(); 

         if(this.upcoming.length >4 ){
             alert('Please complete the upcoming task ');
         }
         else{
             const newTask ={
                 title:this.newTask,
                 waiting:true,
                 taskId:Math.random().toString(35).substring(7),
             };
             //post request 
             fetch('/api/upcoming',{
                 method: 'POST',
                 header:{
                     "content-type": "application/json",

                 },
                 body:JSON.stringify(newTask),
             }).then (()=>this.upcoming.push(newTask));
             //clear or reset newtsk
             this.newTask="";
         }
      },
      //delete upcoming task 
      delUpcoming(taskId){
          if(confirm('Are you sure?')){
              fetch(`/api/upcoming/${taskId}`,{
                  method: 'delete',
              }).then(res=>res.json()).then(()=>{
                  this.upcoming= this.upcoming.filter(({taskId:id})=>{
                      id!==taskId
                  })
              }).catch(err=>console.log(err));
          }
      },
      //check upcoming task 
      checkUpcoming(taskId){
          if(this.todaytasks.length > 4){
              alert("Sorry complete existing task ");
              window.location.href="/";
          }
          else{
              this.addDailyTask(taskId);
              fetch(`/api/upcoming/${taskId}`, {method:"delete"}).then(()=>{
                  this.upcoming=this.upcoming.filter(({taskId:id})=> id !==taskId);
              })

          }
      },
      // fetch todays tasks 
      fetchTodayTasks(){
          fetch("./api/dailytask").then(res=>res.json()).then(({data})=>this.todaytasks=data).catch(err=>{
              console.log(err)
          });
      },
      //add daily task 
      addDailyTask(taskId){
          // get task 
          const task = this.upcoming.filter(({taskId:id})=> id == taskId)[0];
        //post request 
        fetch("/api/dailytask",{
            method:"POST",
            headers:{
                'content-type': "application/json"
            },
            body:JSON.stringify(task),

        }).then(()=> this.todaytasks.unshift(task)).catch(err=>console.log(err));
      },
      //fetchupcoming tasks 
      fetchUpcoming(){
          fetch('/api/upcoming').
          then(res=>res.json()).
          then((data )=>{
              console.log(data);
                this.upcoming=data;
          })
          .catch(err=>{
                console.log(err);
          });

      },
      //delete from the 
      deleteTask(taskId){
       if(confirm("are you Sure ?")){
           fetch(`/api/dailytask/${taskId}`,
           {method: 'delete'}).then(res=>res.json()).then(
            ()=>{
                this.todaytasks= this.todaytasks.filter(({taskId:id})=>{
                    id !==taskId                                
                })
            }).catch(err=> console.log(err)) ;

       }
      },
      //
      updateTodayTask(taskId){
          if(confirm("Task Completed ?")){
             fetch(`/api/dailytask/${taskId}`,{
                 method:"delete"
             }).then(()=>{}).then(()=>{
                 this.todaytasks= this.todaytasks.filter(()=>id!==taskId);
             }).catch(err=>console.log(err));
          }
      },
     


  },
};
</script>

<style>
</style>