<template>
    <div class="col-6">
        <input id="items" name="items" type="hidden" v-model="items" @change="change($event)" class="column-items-field">
        <div class="well">
            <div id="column-items" class="dd"></div>
        </div> 
    </div>
    
</template>

<script>
    import { VueNestable, VueNestableHandle } from 'vue-nestable'
    export default {
        name: 'DynamicColumnComponent',
        props: ['datas'],
        created: function() {
            console.log("Init DynamicColumnComponent");
            this.$root.$emit('ItemInit',JSON.stringify(this.datas));
        },
        data(){
            return {
                items: JSON.stringify(this.datas)
            }
        },
        methods:{
            change(e){
                // console.log("Change!!!!",e.target.value);
                this.$root.$emit('ItemChange',e.target.value);
            }
        }
    };
</script>