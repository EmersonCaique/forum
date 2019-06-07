<template></template>
<script>
    export default {

        props: ['message'],
        created() {
            if (this.message) {
                this.flash(this.message)
            }

        },
        methods: {
            flash(message) {
                this.$toasted.show(`Success! ${this.message}`, {
                    'position': 'bottom-right',
                    'duration': 3000,
                    'className': 'bg-green-300',
                    'type': 'success',
                });
            }
        }
    }

</script>
