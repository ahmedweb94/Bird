<template>
    <div class="list row">
        <div v-if="message">
            <h4 class="alert alert-danger">{{message}}</h4>
        </div>
        <div class="col-md-8">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Github Username" v-model="title"/>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" @click="retrieveTutorials">Search</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Repos</h4>
            <table class="table">
                <thead class="colored">
                <tr>
                    <th>Type</th>
                    <th>Repository</th>
                    <th>Date</th>
                    <th>Point</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="repo in repos" :key="repo.type">
                    <td>{{repo.type}}</td>
                    <td>{{repo.repository}}</td>
                    <td>Created On {{new Date(repo.date).toLocaleString(undefined,options)}}</td>
                    <td>{{repo.points}}</td>
                </tr>
                </tbody>
            </table>
            <button class="btn btn-secondary btn-lg float-right">{{score}}</button>
        </div>
    </div>
</template>
<script>
    export default {
        name:"Repos",
        data(){
            return {
                repos:[],
                title:'',
                options :{  year: 'numeric', month: 'long', day: 'numeric' },
                score:'',
                message:'',
            };
        },
        // created() {
        //     this.axios
        //         .get(`http://localhost:8000/api/github/${this.title}`)
        //         .then((response) => {
        //             this.repos = response.data;
        //             console.log(response);
        //         }) .catch(e => {
        //         console.log(e);
        //     });
        // },
        methods: {
            retrieveTutorials() {
                this.message='';
                this.axios
                    .get(`http://localhost:8000/api/github/${this.title}`)
                    .then((response) => {
                        this.repos = response.data.data;
                        this.score = response.data.score;
                    }) .catch(e => {
                  this.message="Not Found";
                });
            },
        },
        mounted(){
            this.message='';
            // this.retrieveTutorials();
        }
    };
</script>
<style>
    .colored{
        color: #fff;
        background-color: #6c757d;
    }
</style>

<!--<template>-->
    <!--<h1>hello</h1>-->
<!--</template>-->
<!--<script>-->
    <!--export default {}-->
<!--</script>-->
