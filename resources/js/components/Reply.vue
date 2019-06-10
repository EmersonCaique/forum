<template>
    <div class="w-full p-5 bg-white mb-2 rounded border" :id="getId">
        <div class="mb-2 border-b pb-2 flex justify-between items-center">
            <span>{{ reply.owner.name }} said <span v-text="ago"></span></span>
            <favorite :reply="reply"></favorite>
        </div>
        <div class="mb-3" v-if="!editing" v-text="body"></div>
        <div v-else class="text-right">

            <textarea class="w-full border rounded p-4" v-model="body"></textarea>

            <button
                class="p-1 text-xs border border-blue-400 text-blue-400 rounded mt-4" @click="editing = false">Cancel</button>
            <button class="p-1 text-xs bg-blue-400 text-white rounded mt-4 mr-2" @click="update">Update</button>

        </div>

        <div class="flex">
            <button class="p-1 text-xs bg-blue-400 text-white rounded mt-4 mr-2" @click="editing = true">Edit</button>
            <button class="p-1 text-xs bg-red-400 text-white rounded mt-4" @click="destroy">Delete</button>
        </div>
    </div>
</template>

<script>

    import Favorite from './Favorite'
    import  moment from 'moment'

    export default {
        components: { Favorite },
        props: ['data'],
        data() {
            return {
                editing: false,
                body: this.data.body,
                reply: this.data,
            }
        },
        computed: {
            getId(){
                return `reply-${this.reply.id}`
            },
            ago(){
                return moment(this.reply.created_at).fromNow()
            }
        },
        methods: {
            update() {
                axios.put(`/reply/${this.data.id}`, {
                    body: this.body
                }).then(res => {
                    this.editing = false
                    el.target.value = this.body
                })
            },
            destroy() {
                axios
                    .delete(`/reply/${this.data.id}`)
                    .then(res => {
                        // document
                        //     .getElementById(`reply-${this.data.id}`)
                        //     .style.display = 'none'
                        this.$emit('deleted', this.data.id)
                    });

            }
        }
    }

</script>
