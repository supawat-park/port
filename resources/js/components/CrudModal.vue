<template>
    <div>
        <template>
            <form method="POST" @submit.prevent="onSubmitForm">
                <div  class="modal fade bd-example-modal-lg" id="crudModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">CRUD Item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="id">ID</label>
                                        <input
                                            class="form-control"
                                            id="idModel"
                                            name="idModel"
                                            v-model="idModel"
                                            readonly
                                        />
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="itemName">Item Name</label>
                                        <i class="text-danger">*</i>
                                        <input
                                            class="form-control"
                                            id="nameModel"
                                            name="nameModel"
                                            v-model="nameModel"
                                        />
                                    </div>
                                     <div class="form-group col-md-5">
                                        <label for="itemQuantity">Quantity</label>
                                        <i class="text-danger">*</i>
                                        <input
                                            class="form-control"
                                            id="quantityModel"
                                            name="quantityModel"
                                            v-model="quantityModel"
                                            type="number"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <div class="form-group col-md-2" id="editItem" v-if="isShowEditBtn">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block"
                                        >
                                        Save
                                    </button>
                                </div>
                                <div class="form-group col-md-2" id="addItem" v-if="isShowAddBtn">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block"
                                        >
                                        Add
                                    </button>
                                </div>
                                <div class="form-group col-md-2">
                                     <button type='button'
                                        class="btn btn-light btn-block"
                                        @click="closeModal()"
                                        >
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="requestType" v-model="requestType" type="hidden" />
                <!-- <input type="hidden" class="form-control" name="lineNo" v-model="lineNo" /> -->
            </form>
        </template>
    </div>
</template>
<script>
export default {
    created: function() {

    },
    data() {
        return {
        idModel: "",
        nameModel: "",
        quantityModel: "",
        disabledBtnFlag: false,
        lineNo:"",
        requestType: "insert",
        isShowAddBtn: false,
        isShowEditBtn: false,
        };
    },
    methods: {
        closeModal(){
            $("#crudModal").modal("toggle");
        },
        onSubmitForm: function(submitEvent) {
            let formdata = new FormData();
            let validation = {
                nameModel: false,
                quantityModel: false,
                requestType: false,
            };
            for (let item in submitEvent.target) {
                if (submitEvent.target.hasOwnProperty(item)) {
                    const record = submitEvent.target[item];
                    // console.log(record.type, ":", record.value,":",record.name);
                    switch (record.type) {
                        case "select-one":
                        case "tel":
                        case "text":
                        case "number":
                        case "textarea":
                        case "radio":
                        case "checkbox":
                        case "hidden":
                            formdata.append(record.name, record.value);
                            if (validation[record.name] != undefined) {
                                record.value != ""
                                    ? (validation[record.name] = true)
                                    : (validation[record.name] = false);
                            }
                            break;
                    }
                }
            }
            if (Object.keys(validation).every(name => validation[name])) {

                axios
                    .post("./crud/manage-data", formdata)

                    .then(response => {
                        this.$root.$emit("getLineData");
                        if(this.requestType == 'insert'){
                            alert("Insert successfully.")
                        }else{
                            alert("Update successfully.")
                        }
                        $("#crudModal").modal("hide");
                    })
                    .catch(error => {
                        console.log("Some thing went wrong => " + error);
                    });
            } else {
                alert('Please fill all required fields.');
            }
        }
        
    },
    mounted: function() {
        this.$root.$on("resetLineForm", () => {
            // this.lineNo = 0;
            this.idModel="";
            this.nameModel="";
            this.quantityModel="";
            this.requestType = "insert";
            this.isShowAddBtn = true;
            this.isShowEditBtn = false;
        $("#crudModal").modal("show");
        });
        this.$root.$on("selectItem", criteria => {
            this.requestType = "update";
            this.isShowAddBtn = false;
            this.isShowEditBtn = true;
            axios
                .post("./crud/manage-data", {
                    requestType: "selectLineData",
                    lineId: criteria[0].lineId
                })
                .then(response => {
                    if (response.data) {
                        this.idModel = response.data.id;
                        this.nameModel = response.data.name;
                        this.quantityModel = response.data.quantity;
                    }
                    $("#crudModal").modal("show");
                })
                .catch(error => {
                    console.log("Some thing went wrong => " + error);
                });
        });
    },
}
</script>