<template>
    <div class='row'>
        <h1>My Tasks</h1>
        <h4>New Task</h4>
        <form action="#" @submit.prevent="createTask()">
            <div class="input-group">
                <input v-model="task.body" type="text" name="body" class="form-control" autofocus>
             <!--    <input v-model="task_id"  type="hidden" name="task_id" value="" class="form-control" > -->
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">New Task</button>
                </span>
                <span class="input-group-btn">
                    <button v-if="update_action" @click="updateTask()" type="button" class="btn btn-primary">Update</button>
                </span>
            </div>
        </form>
        <h4>All Tasks</h4>
        <div class="row text-center" v-if="loading">
            <rotate-square2></rotate-square2>
        </div>

        <ul class="list-group" v-if="!loading">
            <li v-if='list.length === 0'>There are no tasks yet!</li>
            <li class="list-group-item" v-for="(task, index) in list" :key="index">

                {{ task.body }}
                
                <button @click="getTask(task.id)" class="btn btn-danger btn-xs pull-right" >Update</button>
                 <span style="float:right;"> | </span>
                <button @click="deleteTask(task.id)" class="mine btn btn-danger btn-xs pull-right " >Delete</button>
                

            </li>
        </ul>
    </div>
</template>

<script>
	import {RotateSquare2} from 'vue-loading-spinner';

	export default {
		components: {
			RotateSquare2
		},
        data() {
            return {
            	loading: true,
                task_id:0,
                update_action : false,
                list: [],
                task: {
                    id: '',
                    body: ''
                }
            };
        },
        
        created() {
            this.fetchTaskList();
        },
        mounted () {
            //alert("hi");
            //this.fetchTaskList();

        },
        
        methods: {
            fetchTaskList() {
                axios.get('api/tasks')
                    .then((res) => {
                       // alert("hi");
                            this.list = res.data;
                            this.loading = false;
                    })
			        .catch((err) => console.error(err));;
            },
 
            createTask() {
                axios.post('api/tasks', this.task)
                    .then((res) => {
                        this.task.body = '';
                        this.fetchTaskList();
                    })
                    .catch((err) => console.error(err));
            },
 
            deleteTask(id) {
                axios.delete('api/tasks/' + id)
                    .then((res) => {
                        this.task.body = "";
                        this.task.id = "";

                        this.fetchTaskList();

                    })
                    .catch((err) => console.error(err));
            },
            getTask(id) {
                //alert(id);
                axios.get('api/tasks/' + id)
                    .then((res) => {
                        //this.fetchTaskList()
                       // alert(res.data);
                        console.log(res.data);
                        this.task.body = res.data.body;
                        this.task.id = res.data.id;
                        //this.task_id = res.data.id;
                        this.update_action = true;

                    })
                    .catch((err) => console.error(err));
            },
            updateTask() {
                //alert(this.task_id);
                //this.task.id = this.task_id;
                axios.put('api/tasks/' + this.task.id, this.task)
                    .then((res) => {
                        
                        //alert(res.data);
                        //console.log(res.data);
                       
                        this.task.body = "";
                        this.task.id = "";
                        this.update_action = false;
                         this.fetchTaskList();
                    })
                    .catch((err) => console.error(err));
            },
        }
    }
</script>

