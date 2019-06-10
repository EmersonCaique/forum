<template>
    <div class="w-full">
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)" ></reply>
        </div>

        <new-reply :end-point="url" @created="add"></new-reply>

    </div>

</template>
<script>

import Reply from './Reply.vue'
import NewReply from './NewReply'

export default {
    components: { Reply, NewReply },
    data(){
        return {
            items: [],
            url: `${location.pathname}/replies`
        }
    },
    created(){

    },
    methods: {
        fecth(){

        },
        remove(index){
            this.items.splice(index, 1)
            this.$emit('removed')

        },
        add(reply) {
            this.items.push(reply)
        }
    }
}
</script>

