<template>
    <div class="container">
        Notice
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User_id</th>
                    <th scope="col">Content_id</th>
                    <th scope="col">Notice</th>
                    <th scope="col">Updated_at</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(notice, index) in notices" :key="index">
                    <th>{{ notice.id }}</th>
                    <td>{{ notice.user_id }}</td>
                    <td>{{ notice.content_id }}</td>
                    <td v-html="notice.notice"></td>
                    <td>{{ notice.updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        data: function() {
            return {
                notices: []
            }
        },
        methods: {
            getNotices() {
                axios.get('/api/notices')
                .then((res) => {
                    this.notices = res.data;
                });
            }
        },
        mounted() {
            this.getNotices();
        }
    }
</script>
