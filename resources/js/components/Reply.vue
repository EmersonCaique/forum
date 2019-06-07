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
        update(el){
            axios.put(`/reply/${this.attributes.id}`, {
                body : this.body
            }).then( res => {
                this.editing = false
                el.target.value = this.body
            })
        }
    }
}
</script>
