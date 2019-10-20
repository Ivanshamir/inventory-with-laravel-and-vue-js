<template>
    <div></div>
</template>

<script>
    export default {
        created(){
            User.loggedOut();
            Toast.fire({
                type: 'success',
                title: 'Successfully logged out'
            })
            this.$router.push({name: '/' })
        }
    }
</script>
