<template>
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th v-for="item in items" v-bind:key="item.id" :rowspan="item.rowspan" :colspan="item.colspan" v-bind:style="[{fontWeight: item.header_bold},{textAlign: item.header_align_horizontal},{verticalAlign: item.header_align_vertical}]">
                        {{ item.alias ? item.alias : item.name  }}
                        <!-- {{ item.name }} / row :{{item.rowspan}} / col :{{item.colspan}} -->
                    </th>
                </tr>
                <tr>
                    <template v-for="item in items">
                        <template v-if="item.children">
                             <th v-for="item in item.children" v-bind:key="item.id" :colspan="item.colspan" :rowspan="item.rowspan" v-bind:style="[{fontWeight: item.header_bold},{textAlign: item.header_align_horizontal},{verticalAlign: item.header_align_vertical}]">
                                {{ item.alias ? item.alias : item.name  }}
                                <!-- {{ item.name }} / row :{{item.rowspan}} / col :{{item.colspan}} -->
                            </th> 
                        </template>
                    </template>
                </tr>
                <tr>
                    <template v-for="item in items">
                        <template v-if="item.children">
                            <template v-for="item in item.children">
                                <template v-if="item.children">
                                     <th v-for="item in item.children" v-bind:key="item.id" v-bind:style="[{fontWeight: item.header_bold},{textAlign: item.header_align_horizontal},{verticalAlign: item.header_align_vertical}]">
                                         {{ item.alias ? item.alias : item.name  }}
                                        <!-- {{ item.name }} / row :{{item.rowspan}} / col :{{item.colspan}} -->
                                    </th> 
                                </template>
                            </template>
                        </template>
                    </template>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td v-for="i in sizes" :key="i">data {{ i }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import nestedDraggable from './Nested'
    import Vuetable from "vuetable-2"
    import VuetableRowHeader from 'vuetable-2/src/components/VuetableRowHeader.vue'

    export default {
        name: 'DynamicTableComponent',
        components:{
            Vuetable,
            VuetableRowHeader,
            draggable,
            nestedDraggable
        },
        props: ['datas'],
        created: function() {
            console.log("Init DynamicTableComponent")
            this.$root.$on('ItemInit',(items)=>{
                this.items = JSON.parse(items);
                this.sizes = JSON.parse(items).length
            })
        },
        data(){
            return {
                items: [],
                sizes: 0,
                fields: [],
                count_item:[],
                count_rowspan:1
            }
        },
        methods:{
      
        },
        mounted:function(){
            this.$root.$on('ItemChange',(items)=>{
                this.items = JSON.parse(items);
            })
        }
    };
</script>