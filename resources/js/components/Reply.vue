<script>
export default {
    props: ['attributes'],
    data(){
        return {
            editing : false,
            body: this.attributes.body
        }
    },
    methods: {
        update(){
            axios.put(`/reply/${this.attributes.id}`, {
                body : this.body
            }).then( res => {
                this.editing = false
                el.target.value = this.body
            })
        },
        destroy(){
            axios
                .delete(`/reply/${this.attributes.id}`)
                .then(res => {
                    document
                        .getElementById(`reply-${this.attributes.id}`)
                        .style.display = 'none'
                });

        }
    }
}
</script>
