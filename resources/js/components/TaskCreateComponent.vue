 <template>
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-sm-6">
                 <form v-on:submit.prevent="submit">
                     <div class="form-group row">
                         <label for="title" class="col-sm-3 col-form-label">Title</label>
                         <input type="text" class="col-sm-9 form-control" id="title" v-model="task.title">
                     </div>
                     <div class="form-group row">
                         <label for="content" class="col-sm-3 col-form-label">Content</label>
                         <input type="text" class="col-sm-9 form-control" id="content" v-model="task.content">
                     </div>
                     <div class="form-group row">
                         <label for="person-in-change" class="col-sm-3 col-form-label">Person In Charge</label>
                         <input type="text" class="col-sm-9 form-control" id="person-in-change" v-model="task.person_in_change">
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                 </form>
                 <ul v-if="errors" class="error">
                     <li v-for="(error, index) in errors" :key="index">{{ error[0] }}</li>
                 </ul>
             </div>
         </div>
     </div>
 </template>

 <script>
    export default {
        data: function () {
            return {
                task: {},
                errors: null
            }
        },
        methods: {
            submit() {
                axios.post('/api/tasks', this.task)
                    .then((res) => {
                        this.$router.push({name: 'task.list'});
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
 </script>
