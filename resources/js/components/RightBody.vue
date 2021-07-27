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
        <form action="" method="post" @submit="addUpcomingTask">
            <input type="text" name="" id="" v-model="newTask">
        </form>
        <ul class="tasks-list">
            <li v-for="upcomingtask in upcoming" v-bind:key="upcomingtask.id">

            </li>
        </ul>
    </div>
</div>


    

  </div>
</template>

<script>
export default {
  data() {
    return { 
        todayTask:[],
        upcoming:[],
        newTask :"",
    };
  },
  created() { 
      this.fetchTodayTasks();
      this.fetchUpcoming();
  },

  methods: { 
      // fetch todays tasks 
      fetchTodayTasks(){

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

      }

  },
};
</script>

<style>
</style>