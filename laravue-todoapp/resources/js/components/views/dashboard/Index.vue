<template>
	<div class="container">
		<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default my-5">
                    <div class="card-header">User Dashboard</div>
                    <div class="card-body">
                        <p class="text-center">You are logged in!</p>
                        <p><strong>Name:</strong> {{user.name}}</p>
                        <p><strong>Email:</strong> {{user.email}}</p>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
    export default{
        created(){
            this.getUser()
        },
        data(){
            return {
                user:{
                    name: '',
                    email: ''
                }
            }
        },
        methods:{
            //get current authenticated user
            getUser(){
                axios
                    .get('/api/user')
                    .then(res => {
                        this.user = res.data.user
                    })
                    .catch(err => {
                        console.log(err)
                        if(err.response.status == 404){
                            this.flashError('User not found!')
                        }
                    })
            }
        }
    }
</script>