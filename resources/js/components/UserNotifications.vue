<template>
<div>
    <a href="#">
        Notifications
        <sup > {{ notifications.length }} </sup>
    </a>
</div>
</template>
<script>
export default {
    data(){
        return {
            notifications: 0
        }
    },
    mounted(){
        axios
            .get(`profile/${window.App.user.name}/notification/`)
            .then( ({ data }) => this.notifications = data)
    }
}
</script>
