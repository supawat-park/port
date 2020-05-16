<!--template>
    <table class="table table-striped table-bordered">
        <thead>
            <draggable :list="headers" :options="{animation:200}" :element="'tr'" @change="getupdate">
                <th v-for="head in headers" v-bind:key="head.id">
                    {{ head }}
                </th>
            </draggable>
        </thead>
        <tbody>
            <tr v-for="data in datasNew" v-bind:key="data.name">
                <td v-for="header in headers" :key="header">{{ data[header] }}</td>
            </tr>
        </tbody>
    </table>
</template-->


<template>
    <div class="container">
        <nested-draggable :tasks="list" />
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import nestedDraggable from './Nested'
export default {
    name: 'PreviewComponent',
    props: ['datas'],
    components:{
        draggable: draggable,
        nestedDraggable: nestedDraggable
    },
    data(){
        return {
            headers: ['id', 'name', 'created_at'],
            datasNew: this.datas,
            list: [
                {
                    name: "task 1",
                    tasks: [
                        {
                            name: "task 2",
                            tasks: []
                        }
                    ]
                },
                {
                    name: "task 3",
                    tasks: [
                        {
                            name: "task 4",
                            tasks: []
                        }
                    ]
                },
                {
                    name: "task 5",
                    // tasks: []
                }
            ]
        }
    }, methods: {
        getupdate(){
            console.log("Update!");
            console.log(JSON.stringify(this.headers))
        }
    }
};
</script>