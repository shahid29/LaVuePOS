<template>

</template>

<script>
    export default {
        name: "logout",
        created(){
            User.logout()
            this.$router.push({name:'/'})
            Toast.fire({
                type: 'success',
                title: 'Logout successfully'
            })

            }
    }
</script>

<style scoped>

</style>
