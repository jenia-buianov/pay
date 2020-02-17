<template>
    <div class="">
        <table>

        </table>
    </div>
</template>

<script>
    import VueTagsInput from '@johmun/vue-tags-input';
    export default {
        components:[
            VueTagsInput
        ],
        data(){
            return {
                form: {
                    client: {
                        state: [],
                        city: [],
                    },
                    direction:{

                    },
                    passengers: []
                },
                tag: "",
                autocompleteItems:[],
                config: {
                    wrap: true,
                    altFormat: 'M j, Y',
                    altInput: true,
                    dateFormat: 'd.m.Y',
                },
                configDateTime: {
                    wrap: true,
                    altFormat: 'M j, Y H:i',
                    altInput: true,
                    dateFormat: 'd.m.Y, H:i',
                    time_24hr: true,
                    enableTime:true
                },
                isLoading: false,
                cities: [],
                inv: null,
                sent: false
            }
        },
        props:{
            offer_types: Array,
            phone_types: Array,
            links: Object,
        },
        created() {
            this.addPassenger(null);
        },
        computed:{
        },
        watch: {
            'tag': 'filteredItems',
        },
        methods:{
            filteredItems() {
                if (this.tag.length < 2) return;
                axios.get(this.links.cities+"?q="+this.tag).then(response=>{
                    this.autocompleteItems = response.data.results.map(a => {
                        return { text: a.translate };
                    });
                });

            },
            update(newTags) {
                this.autocompleteItems = [];
                this.tags = newTags;
            },
            findCity (query){
                this.isLoading = true;
                axios.get(this.links.cities+"?q="+query).then(response=>{
                    this.isLoading = false;
                    this.cities = response.data.results;
                });
            },
            addPassenger(e){
                if (e !== null){
                    e.preventDefault();
                }
                this.form.passengers.push({
                    first_name: '',
                    last_name: '',
                    offer_type: '',
                    price: '',
                    currency: ''
                });
            },
            generate(e){
                if (e !== null){
                    e.preventDefault();
                }
                axios.post(this.links.save,this.form).then(response=>{
                    if (response.data.status==true){
                        this.inv = response.data.invoice;
                    }
                });
            },
            sendNotification(e){
                if (e !== null){
                    e.preventDefault();
                }
                axios.post(this.links.send,{invoice:this.inv.id}).then(response=>{
                    this.sent = response.data.status;
                });
            }
        }
    }
</script>
