<script>
    import Replies from '../components/Replies'

    export default {
        props: ['initialRepiesCount'],
        components: {
        Replies
        },
        data() {
            return {
                repliesCount: this.initialRepiesCount
            }
        }
    }

</script>
