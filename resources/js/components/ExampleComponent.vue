<template>
    <div class="container">
        <button type="button" class="btn btn-primary" @click="submit(postId)">good</button>
    </div>
</template>

<script>
    export default {
        props: ['postId'],
        
        methods: {
            submit(postId) {
                let url = '/api/posts/${postId}/good'
                
                axios.post(url)
                .then(response => {
                    
                })
                .catch(error => {
                    alert(error)
                });
            }
        }
    }
</script>
