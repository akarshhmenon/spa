<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addcustomerLabel">{{ title }}</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_customer_modal"
        @click="clear_form_data()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <div class="card-body">
          <div class="col">
            <div class="form-group">
              <label for="customerName" class="required">Name</label>
              <input
                type="text"
                class="form-control"
                id="customerName"
                placeholder="Enter Name"
                name="name"
                v-model="customer.name"
              />
            </div>

            <small class="text-danger" v-if="errors.name">
              {{ errors.name[0] }}</small
            >
          </div>

          <div class="col">
            <div class="form-group">
              <label for="customerMobile" class="required">Mobile</label>
              <input
                type="number"
                class="form-control"
                id="customerMobile"
                placeholder="Enter Mobile"
                name="mobile"
                v-model="customer.mobile"
                :max="10"
              />
            </div>

            <small class="text-danger" v-if="errors.mobile">
              {{ errors.mobile[0] }}</small
            >
  
        </div>
        <div class="col">
            <div class="form-group">
              <label for="customerEmail" class="">Email</label>
              <input
                type="email"
                class="form-control"
                id="customerEmail"
                placeholder="Enter email"
                name="email"
                v-model="customer.email"
               
              />
            </div>


</div>


      </div>
    </div>
    <div class="modal-footer">
      <button
        type="button"
        @click="addCustomer()"
        class="btn btn-primary rounded-pill"
            :disabled=loading
      >
       {{button_title }}<i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["edit"],
  data() {
    return {
  loading: false,
      
      title: "Add Customer",
      toastTitle: "Customer added successfully",
      customer: {
        id: "",
        name: "",
        mobile: "",
        email:"",
      },

      errors: [],
    };
  },

  created() {
    if (this.edit) {
      var _this = this;

      _this.title = "Edit Customer";
      _this.toastTitle = "Customer updated successfully";
      bus.$on("edit-customer", function (customer) {
        _this.clear_form_data();
        _this.customer.id = customer.id;
        _this.customer.name = customer.name;
        _this.customer.mobile = customer.mobile;
        _this.customer.email = customer.email;
      });
    }
  },
 computed: {
    button_title () {
      if (this.loading == true) {
        return 'Saving  ';
      }else{
 return 'Save Changes';
      }
    },
  },

  methods: {
    addCustomer() {

this.loading=true;
      axios
        .post("add-customer", this.customer)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });

            this.$refs.close_customer_modal.click();
            this.clear_form_data();
            bus.$emit("customer-added");
          }
this.loading=false;
        })
        .catch((err) => {
this.loading=false;
          this.errors = err.response.data.errors;
        });
    },

    clear_form_data() {
      for (let data in this.customer) {
        this.customer[data] = "";
      }
      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },
  },
};
</script>
