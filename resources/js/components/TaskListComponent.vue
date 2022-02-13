<template>
    <div class="container">
        <!-- 月別に表示を変更させるボタン -->
        <button v-for="(i, index) in 12" :key="index" v-on:click="mounthList(i)" class="btn btn-success mr-1">{{ i }}月</button>
        <button v-on:click="mounthList(null)" class="btn btn-success mr-1">ALL</button>
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
                 <th scope="col" v-if="adminCheck == 1">Caution</th>
             </tr>
             </thead>
             <tbody>
                <tr
                    v-for="(task, index) in tasks" :key="index"
                    v-bind:class="[task.caution == 2 ? 'bg-warning' : '']"
                    v-if="mounth == null || mounth == getMounth(task.created_at)"
                >
                    <th scope="row">{{ task.id }}</th>
                    <td>{{ task.title }}</td>
                    <td>{{ task.content }}</td>
                    <td>{{ task.person_in_change }}</td>
                    <td>{{ getMounth(task.created_at) }}</td>
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
                    <td v-if="task.caution == 2" class="bg-danger align-items-center w-5">
                        管理者から削除依頼が来ています
                    </td>
                </tr>
             </tbody>
         </table>
     </div>
 </template>

 <script>
    export default {
        data: function () {
            return {
                tasks: [],
                mounth: null
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
            mounthList(i) {
                this.mounth = i;
                console.log(this.mounth);
            },
            cautionTask(task) {
                window.alert('title: ' + task.title + 'の削除依頼を行いました');
                axios.put('/api/tasks/' + task.id + '/caution', task)
                    .then((res) => {
                        this.getTasks();
                    });
            },
            getMounth(created_at) {
                return created_at.substr(5,2);
            }
        },
        mounted() {
            this.getTasks();
        }
    }
 </script>
