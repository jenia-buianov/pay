<template>
    <div class="">
        <table>

        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                page: 1,
                invoices: []
            }
        },
        props:{
            inv: Array,
            ppage: Number,
            pages: Number
        },
        mounted() {
        },
        created() {
            this.invoices = this.inv;
        }
    }
</script>
