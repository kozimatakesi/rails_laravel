 <template>
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-sm-6">
                 <form v-on:submit.prevent="submit">
                     <div class="form-group row">
                         <label for="id" class="col-sm-3 col-form-label">ID</label>
                         <input type="text" class="col-sm-9 form-control-plaintext" readonly id="id" v-model="task.id">
                     </div>
                     <div class="form-group row">
                         <label for="title" class="col-sm-3 col-form-label">Current Title</label>
                         <input type="text" class="col-sm-9 form-control-plaintext" readonly id="title" :value="oldTaskTitle">
                         <label for="title" class="col-sm-3 col-form-label">Update title</label>
                         <input type="text" class="col-sm-9 form-control" id="title" v-model="task.title">
                     </div>
                     <div class="form-group row">
                         <label for="content" class="col-sm-3 col-form-label">Current Content</label>
                         <input type="text" class="col-sm-9 form-control-plaintext" readonly id="content" :value="oldTaskContent">
                         <label for="title" class="col-sm-3 col-form-label">Update content</label>
                         <input type="text" class="col-sm-9 form-control" id="content" v-model="task.content">
                     </div>
                     <div class="form-group row">
                         <label for="person-in-change" class="col-sm-3 col-form-label">Current Person In Charge</label>
                         <input type="text" class="col-sm-9 form-control-plaintext" readonly id="person-in-change" :value="oldTaskPersonInChange">
                         <label for="title" class="col-sm-3 col-form-label">Update person_in_change</label>
                         <input type="text" class="col-sm-9 form-control" id="person-in-change" v-model="task.person_in_change">
                     </div>
                     <button
                        type="submit" class="btn btn-primary">更新</button>
                 </form>
             </div>
         </div>
     </div>
 </template>

 <script>
     export default {
         props: {
             taskId: Number,
         },
        data () {
            return {
                task: {},
                oldTaskTitle: '',
                oldTaskContent: '',
                oldTaskPersonInChange: '',
            }
        },
        methods: {
            getTask() {
                axios.get('/api/tasks/' + this.taskId)
                    .then((res) => {
                        this.task = res.data;
                        this.oldTaskTitle = res.data.title;
                        this.oldTaskContent = res.data.content;
                        this.oldTaskPersonInChange = res.data.person_in_change;
                    });
            },
            submit() {
                axios.put('/api/tasks/' + this.taskId, this.task)
                    .then((res) => {
                        axios.post('/api/notices/' + this.taskId, {
                                    headers: {
                                        title: this.oldTaskTitle,
                                        content: this.oldTaskContent,
                                        person_in_change: this.oldTaskPersonInChange
                                    },
                                    data: this.task
                                })
                                .then((res) => {
                                    this.$router.push({name: 'task.list'})
                                })
                    });
            }
        },
        mounted() {
            this.getTask();
        }
     }
 </script>
