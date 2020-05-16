<template>
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            Choose table
        </div>
        <ul class="list-group list-group-flush">
            <li v-for="(data, index) in datas" v-bind:key="index" class="list-group-item">
                <input type="checkbox" :id="index" :value="data.TABLE_NAME" v-model="checkedNames" @change="checkedData">
                <label :for="index">{{data.TABLE_NAME}}</label>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'CheckboxCardComponent',
    props: ['datas'],
    data(){
        return{
            checkedNames: []
        }
    },
    methods:{
        checkedData() {
            console.log(JSON.stringify(this.checkedNames));
        }
    }
}
</script>
