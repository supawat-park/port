<template>
    <div class="row">
        <div class="col-md-6">
            <checkbox-card-component :datas="datas" ref="my-child"></checkbox-card-component>
        </div>
        <div class="col-md-6">
            <button class="btn btn-info" v-on:click="submitDataSelected">Next</button>
        </div>
    </div>
</template>

<script>
import CheckboxCardComponent from '../CheckboxCard.vue'
export default {
    name: 'SelectDatasource',
    props: ['routes','datas'],
    components:{
        CheckboxCardComponent: CheckboxCardComponent
    },
    data() {
        return{
            checkedNames: []
        }
    },
    methods: {
        submitDataSelected(){
            this.checkedNames = this.$refs['my-child'].checkedNames.map((data)=>{
                return data;
            })
        console.log(this.routes)
            axios.post(this.routes, {
                checkedNames: this.checkedNames
            }).then((res)=>{
                console.log(res)
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>

