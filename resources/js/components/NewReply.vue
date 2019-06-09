<template>
    <div class="w-full p-5 bg-white mb-2 border rounded text-right">
            <textarea type="text" name="body" placeholder="New reply..." rows="3"
                class="w-full focus:border-none border rounded px-3 py-3" v-model="body"></textarea>

            <button class="px-12 py-2 bg-blue-500 rounded shadow text-white text-right mt-4"
                @click.prevent="store">Reply</button>
    </div>
</template>

<script>
    export default {
        props: ['endPoint'],
        data() {
            return {
                body: null,
            }
        },
        methods: {
            store() {
                axios
                    .post(this.endPoint, {'body' : this.body})
                    .then(({ data }) => {
                        this.body = null
                        this.$emit('created', data)
                    })
            }
        }

    }

</script>
