<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }

            <v-pagination :data="" v-on:pagination-change-page=""></v-pagination>
            
            getClients() {
                const uri = 'http://127.0.0.1:8000/admin/clients/list';
                this.axios.get(uri).then((response) => {
                  this.clients = response.data;
                });
            },

            current_page: clients.current_page,
            from: clients.from,
            last_page: clients.last_page,
            next_page_url: clients.next_page_url,
            per_page: clients.per_page,
            prev_page_url: clients.prev_page_url,
            to: clients.to,
            total: clients.total

            getClients(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }

            const uri = 'http://127.0.0.1:8000/admin/clients/list?page=';
            this.$http.get(uri + page)
                .then(response => {

                    this.clients = response.data
                });
            }
</script>
