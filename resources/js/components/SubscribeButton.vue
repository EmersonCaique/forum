<template>

    <main class="w-full text-center mt-4">

        <button
            class="p-2  rounded-sm  text-right"
            :class="status ? 'bg-blue-600 text-white ' : 'border border-blue-600 text-blue-600' "
            v-text="status ? 'Unsubscribe' : 'Subscribe'"
            @click="subscribe"></button>
    </main>
</template>
<script>
    export default {
        props: ['active'],
        data(){
            return {
                status: this.active
            }
        },
        methods: {
            subscribe() {
                if (this.status) {

                    axios.delete(`${location.pathname}/subscriptions`)
                        .then(res => this.status = false)
                } else {
                    axios.post(`${location.pathname}/subscriptions`)
                        .then(res => this.status = true)
                }
            }
        }
    }

</script>
