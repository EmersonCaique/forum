<script>
    import Replies from '../components/Replies'
    import SubscribeButton from '../components/SubscribeButton'


    export default {
        props: ['initialRepiesCount'],
        components: {
            Replies,
            SubscribeButton
        },
        data() {
            return {
                repliesCount: this.initialRepiesCount
            }
        }
    }

</script>
