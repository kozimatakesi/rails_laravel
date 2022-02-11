<template>
    <div class="container">
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                 <th scope="col">Content</th>
                 <th scope="col">Person In Charge</th>
                 <th scope="col">Show</th>
                 <th scope="col">Edit</th>
                 <th scope="col">Delete</th>
             </tr>
             </thead>
             <tbody>
                <tr v-for="(task, index) in tasks" :key="index">
                    <th scope="row">{{ task.id }}</th>
                    <td>{{ task.title }}</td>
                    <td>{{ task.content }}</td>
                    <td>{{ task.person_in_change }}</td>
                    <td>
                        <router-link v-bind:to="{name: 'task.show', params: {taskId: task.id }}">
                            <button class="btn btn-primary">Show</button>
                        </router-link>
                    </td>
                    <td>
                        <router-link v-bind:to="{name: 'task.edit', params: {taskId: task.id }}">
                            <button class="btn btn-success">Edit</button>
                        </router-link>
                    </td>
                    <td>
                        <button class="btn btn-danger" v-on:click="deleteTask(task)">Delete</button>
                    </td>
                    <td v-if="adminCheck == 1">
                        <button class="btn btn-danger" v-on:click="cautionTask(task)">Caution</button>
                    </td>
                    <div v-if="task.caution == 2" class="bg-danger">
                        管理者から<br>
                        削除依頼が来ています
                    </div>
                </tr>
             </tbody>
         </table>
     </div>
 </template>

 <script>
    export default {
        data: function () {
            return {
                tasks: []
            }
        },
        computed: {
            adminCheck () {
            return this.$store.getters['auth/adminCheck']
            }
        },
        methods: {
            getTasks() {
                axios.get('/api/tasks')
                    .then((res) => {
                        this.tasks = res.data;
                    });
            },
            deleteTask(task) {
                if(!window.confirm('本当に削除しますか？')){
                    window.alert('キャンセルされました');
                    return false;
                } else {
                    axios.delete('/api/tasks/' + task.id, task )
                        .then((res) => {
                            console.log(res);
                            console.log(task);
                            axios.post('/api/notices/' + task.id, {
                                    headers: 'delete',
                                    data: task
                                })
                                .then((res) => {
                                    this.getTasks();
                                })
                    });

                    window.alert(`id:${task.id}を削除しました`);
                }
            },
            cautionTask(task) {
                window.alert('title: ' + task.title + 'の削除依頼を行いました');
                axios.put('/api/tasks/' + task.id + '/caution', task)
                    .then((res) => {
                        this.getTasks();
                    });
            },
        },
        mounted() {
            this.getTasks();
        }
    }
 </script>
