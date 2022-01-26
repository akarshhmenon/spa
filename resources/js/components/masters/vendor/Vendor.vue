<template>

    <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addVendorLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_vendor_modal"
        @click="clearFormData()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>
    <form
      class="form-horizontal"
      method="POST"
      enctype="multipart/form-data"
      @submit.prevent="addVendor()"
    >
      <div class="modal-body">
        <div class="card-body">

<div class="row">
<div class="col">
      <div class="form-group">
            <label for="vendorName" class="required">Vendor Name</label>
            <input
              type="text"
              class="form-control"
              name="name"
              placeholder="Enter Vendor Name"
              v-model="vendor.name"
              :disabled="edit"
            />
            <small class="text-danger" v-if="errors.name">{{
              errors.name[0]
            }}</small>
          </div>
</div>
<div class="col">
      <div class="form-group">
            <label for="mobile" class="">Mobile</label>
            <input
              type="number "
              class="form-control"
              name="mobile"
              placeholder="Enter Mobile "
              v-model="vendor.mobile"
            />
            <small class="text-danger" v-if="errors.mobile">{{
              errors.mobile[0]
            }}</small>
          </div>
          </div>

 </div> 


        <div class="row">


            <div class="col">
            <div class="form-group">
            <label for="location" class="">Location</label>
            <input
              type="text"
              class="form-control"
              name="location"
              placeholder="Enter Location"
              v-model="vendor.location"
            />
            <small class="text-danger" v-if="errors.location">{{
              errors.location[0]
            }}</small>
          </div>
            </div>


            <!-- <div class="col"> -->

          
            <div class="col">
           <div class="form-group">
            <label for="gstno" class="">GSTNo</label>
            <input
              type="text"
              class="form-control"
              name="gstno"
              placeholder="Enter GST Number"
              v-model="vendor.gstno"
            />
            <small class="text-danger" v-if="errors.gstno">{{
              errors.gstno[0]
            }}</small>
          </div>
            </div>

        </div>

        
<div class="row">
    
     <div class="col">
          <div class="form-group">
            <label >Address 1</label>
            <input
              type="text"
              class="form-control"
          
              placeholder="Enter Address 1"
              name="address_1"
              v-model="vendor.address_1"
            />
                  <small class="text-danger" v-if="errors.address_1">{{
              errors.address_1[0]
            }}</small>
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label >Address 2</label>
            <input
              type="text"
              class="form-control"
           
              placeholder="Enter Address 2"
              name="address_2"
              v-model="vendor.address_2"
            />
                  <small class="text-danger" v-if="errors.address_2">{{
              errors.address_2[0]
            }}</small>
          </div>
        </div>

</div>

<div class="row">


     <div class="col">
          <div class="form-group">
            <label >State</label>
            <input
              type="text"
              class="form-control"
          
              placeholder="Enter State"
              name="state"
              v-model="vendor.state"
            />
                  <small class="text-danger" v-if="errors.state">{{
              errors.state[0]
            }}</small>
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label >Pincode</label>
            <input
              type="number"
              class="form-control"
           
              placeholder="Enter pincode"
              name="pincode"
              v-model="vendor.pincode"
            />
                  <small class="text-danger" v-if="errors.pincode">{{
              errors.pincode[0]
            }}</small>
          </div>
        </div>

</div>


        </div>
      </div>



      <div class="modal-footer">
        <button
          type="submit"
          class="btn btn-primary rounded-pill"
          :disabled="loading"
        >
          {{ button_title }}
          <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
        </button>
      </div>
    </form>
  </div>







</template>


<script>
import { ModelListSelect } from "vue-search-select";
export default {
  components: {
    ModelListSelect,
  },
  props: ["edit"],

  data() {
    return {
      title: "Add Vendor",
      toastTitle: "Vendor added successfully",
      errors: {},

      loading: false,
      

      vendor: {
        id: "",
        name: "",
        mobile: "",
        location: "",
        gstno:'',
        address_1:'',
        address_2:'',
        state:"",
        pincode:"",
      },
    };
  },

  computed: {
    button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Save Changes";
      }
    },
  },
  created() {
    

    if (this.edit) {
      var _this = this;
      _this.title = "Edit Vendor";
      _this.toastTitle = "Vendor data Updated successfully";
      
      bus.$on("edit-vendor", function (vendor) {
        _this.clearFormData();
        console.log(vendor);
        _this.vendor.id = vendor.id;
        _this.vendor.name = vendor.name;
        _this.vendor.mobile = vendor.mobile;
        _this.vendor.state = vendor.state; 
        _this.vendor.address_1 = vendor.address_1;
         _this.vendor.address_2 = vendor.address_2;
        _this.vendor.location = vendor.location;
        _this.vendor.pincode = vendor.pincode;
        _this.vendor.gstno = vendor.gstno;
      });
    }
  },

  methods: {
    // getDesignation() {
    //   axios
    //     .get("get-designations")
    //     .then((response) => {
    //       this.designations = response.data;
    //     })
    //     .catch((err) => {});
    // },

    addVendor() {
      if (this.edit) {
        this.vendor.id = this.vendor.id;
      }
      this.loading = true;
      axios
        .post("add-vendor", this.vendor)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });
            bus.$emit("vendor-added");
            this.$refs.close_vendor_modal.click();
            this.clearFormData();
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });

            bus.$emit("vendor-added");
            this.$refs.close_vendor_modal.click();
            this.clearFormData();
          }

          this.loading = false;
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      this.vendor.name = "";
      this.vendor.mobile = "";
      this.vendor.location = "";
      this.vendor.state = "";
      this.vendor.pincode = "";
      this.vendor.address_1 = "";
      this.vendor.address_2 = "";
      this.errors = {};
    },
  },
};
</script>


<style scoped>




</style>