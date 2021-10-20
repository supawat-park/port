<template>
  <div>
    <form method="POST" @submit.prevent="onSubmitForm">
      <div class="form-row">
        <div class="form-group col-md-6">
          <input type="number" class="form-control" v-model="inputModel" name="inputModel" placeholder="positive number"/>
        </div>
      <div class="form-group col-md-2">
           <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </div>
    </form>
    <br/>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Result</label>
        <h3>{{this.output}}</h3>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputModel: "",
      output: "",
    };
  },
  methods: {
    onSubmitForm: function () {
        let formdata = new FormData();
        formdata.append('inputModel',this.inputModel);

      axios
        .post("./factorial-input",formdata)

        .then((response) => {
          this.output = response.data;
        })
        .catch((error) => {
          console.log("Some thing went wrong => " + error);
        });
    },
  },
};
</script>