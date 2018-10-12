<template>
    <div class="jumbotron">
        <div class="container">
            <h1>Hello, {{ auth.name }}</h1>
            <p>Your email is {{ auth.email }}</p>
            <p>
                <a class="btn btn-primary btn-lg">Learn more</a>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            auth: {
                name: '',
                email: ''
            }
        }
    },
    mounted() {
        this.getAuth()
    },
    methods: {
        getAuth() {
            axios.get('/auth')
            .then(response => {
                console.log(response)
                this.auth.name = response.data.auth.name,
                this.auth.email = response.data.auth.email
            });
        }
    }
}
</script>   