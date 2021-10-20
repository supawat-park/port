<template>
    <div>
        <div class="shadow-non mb-4 bg-white">
            <div class="row mb-2">
                 <div class="col-12 tex-right pl-0">
                    <button
                        class="btn btn-primary float-right d-none d-sm-block"
                        style="color:#fff"
                        @click="resetLineForm()"
                    >
                        Add Item
                        <i class="fa fa-plus ml-2"></i>
                    </button>
                </div>
            </div>
            <div class="row" v-if="!hasData">
                <div class="col text-center">
                    <h5 style="color: rgb(160, 160, 160);">
                        No line data in table. Please click
                        <a
                        class="link-text"
                        >'Add Item'</a>
                        <span class="d-none d-sm-inline">button</span>.
                    </h5>
                </div>
            </div>
            <div
                class="card border-0 shadow"
                v-if="hasData"
                style="max-height: 500px;"
            >
                <div
                    class="card border-0 body"
                    style="overflow-x: scroll;max-height: 500px;"
                >
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:50px ;"></th>
                                <th >No.</th>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Quantity</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <template v-for="data in renderLineData">
                            <tr
                                class="subtable-row"
                                :id="`row[${data.lineRunning}]`"
                                :key="data.id"
                            >
                                <td
                                    class="action-column"
                                >
                                    <div class="btn-group action-btn">
                                        <a
                                            class="btn"
                                            id="editBtn"
                                            data-toggle="modal"
                                            href="#crudModal"
                                            v-on:click="selectItem"
                                        >
                                            <i
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Edit"
                                            >Edit
                                                <input
                                                    type="hidden"
                                                    :value="`${data.id}`"
                                                />
                                            </i>
                                        </a>
                                        <a
                                            class="btn"
                                            id="removeBtn"
                                            v-on:click="deleteItem"
                                            href ='#'
                                        >
                                            <i
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Remove"
                                                class="text-danger"
                                                
                                            >Remove
                                                <input
                                                    type="hidden"
                                                    :value="`${data.id}`"
                                                />
                                            </i>
                                        </a>
                                    </div>
                                </td>
                                <td
                                    class="align-middle text-primary font-weight-bold"
                                >
                                    {{ data.lineRunning + 1 }}
                                </td>
                                <td>
                                    <input
                                        class="form-control subtable-input text-center"
                                        :value="`${data.name}`"
                                        readonly
                                        tabindex="-1"
                                    />
                                </td>
                                <td>
                                    <input
                                        class="form-control subtable-input"
                                        :value="`${data.quantity}`"
                                        readonly
                                        tabindex="-1"
                                    />
                                </td>
                            </tr>
                        </template>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    components: {
        
    },
    created: function() {
        axios
            .post("./crud/manage-data", {
                requestType: "getLineData",
            })
            .then(response => {
                if (response.data.length > 0) {
                    this.hasData = true;
                    this.renderLineData = response.data;
                    for (var i = 0; i < this.renderLineData.length; i++) {
                        this.renderLineData[i].lineRunning = this.lineRunning;
                        this.lineRunning += 1;
                    }
                }
                $("body").loading("stop");
            })
            .catch(error => {
                console.log("Some thing went wrong => " + error);
            });
    },
    data() {
        return {
        renderLineData: [],
        hasData: false,
        lineRunning: 0,
        };
    },
    methods: {
        resetLineForm() {
                this.$root.$emit("resetLineForm");
        },
        selectItem: function(event) {
            var criteria = [];
            criteria.push({
                lineId: $(event.srcElement)
                    .find("input")
                    .val()
            });
            this.$root.$emit("selectItem", criteria);
        },
        deleteItem: function(event) {
            var isConfirm = confirm("Confirm remove this item?");
            if(isConfirm){
               var formData = new FormData();
                    formData.append("requestType", "delete");
                    formData.append(
                        "lineId",
                        $(event.srcElement)
                            .find("input")
                            .val()
                    );
                    axios
                        .post("./crud/manage-data", formData)
                        .then(response => {
                            this.$root.$emit("getLineData");
                            alert("Remove successfully.")
                        })
                        .catch(error => {
                            console.log("Some thing went wrong => " + error);
                        });
            }
        },
    },
    mounted: function() {
        this.$root.$on("getLineData", () => {
            axios
                .post("./crud/manage-data", {
                    requestType: "getLineData",
                })
                .then(response => {
                    if (response.data.length > 0) {
                        this.hasData = true;
                        this.lineRunning = 0;
                        this.renderLineData = response.data;
                        for (var i = 0; i < this.renderLineData.length; i++) {
                            this.renderLineData[
                                i
                            ].lineRunning = this.lineRunning;
                            this.lineRunning += 1;
                        }
                    }
                })
                .catch(error => {
                    console.log("Some thing went wrong => " + error);
                });
        });
    }
}
</script>