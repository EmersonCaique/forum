<template>
    <div>
        <button
            type="submit"
            class="py-1 px-2    rounded text-xs flex"
            :class="classes"
            @click="toggle">
                <span>{{ this.favoritesCount }}</span>
            </button>
    </div>
</template>

<script>
    export default {
        props: ['reply'],
        data(){
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited,
            }
        },
        computed: {
            classes(){
                return [this.isFavorited ? 'text-white bg-blue-400'  : 'text-blue-400 border-blue-400 border  '];
            }
        },
        methods: {
            toggle() {
                if (this.isFavorited) {
                    axios
                        .delete(`/reply/${this.reply.id}/favorites`)
                        .then(res => {
                            this.isFavorited = false
                            this.favoritesCount--   ;
                        })
                } else {
                    axios
                        .post(`/reply/${this.reply.id}/favorites`)
                        .then(res => {
                            this.isFavorited = true
                            this.favoritesCount++;

                        })
                }

            }
        }

    }

</script>
