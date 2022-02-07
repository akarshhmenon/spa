<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addproductLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_product_modal"
        @click="clearFormData()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>
    <form
      class="form-horizontal"
      method="POST"
      enctype="multipart/form-data"
      @submit.prevent="addProduct()"
    >
      <div class="modal-body">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="productName" class="required"> Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  placeholder="Enter product Name"
                  v-model="product.name"
                  :disabled="edit"
                />
                <small class="text-danger" v-if="errors.name">{{
                  errors.name[0]
                }}</small>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="description" class="">description</label>
                <input
                  type="textarea"
                  class="form-control"
                  name="description"
                  placeholder="Enter description "
                  v-model="product.description"
                />
                <small class="text-danger" v-if="errors.description">{{
                  errors.description[0]
                }}</small>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label class="">MRP</label>
                <input
                  type="number"
                  class="form-control"
                  name="mrp"
                  placeholder="Enter mrp "
                  v-model="product.mrp"
                />
                <small class="text-danger" v-if="errors.mrp">{{
                  errors.mrp[0]
                }}</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="">Batch No</label>
                <input
                  type="text"
                  class="form-control"
                  name="batch_no"
                  placeholder="Enter batch no "
                  v-model="product.batch_no"
                />
                <small class="text-danger" v-if="errors.batch_no">{{
                  errors.batch_no[0]
                }}</small>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label class="">HSN Code</label>
                <input
                  type="text"
                  class="form-control"
                  name="hsn_code"
                  placeholder="Enter HSN Code "
                  v-model="product.hsn_code"
                />
                <small class="text-danger" v-if="errors.hsn_code">{{
                  errors.hsn_code[0]
                }}</small>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label class="">Rack No</label>
                <input
                  type="text"
                  class="form-control"
                  name="rack_no"
                  placeholder="Enter rack no "
                  v-model="product.rack_no"
                />
                <small class="text-danger" v-if="errors.rack_no">{{
                  errors.rack_no[0]
                }}</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>MFG Date</label>
                <input
                  type="date"
                  class="form-control"
                  name="mfg_date"
                  v-model="product.mfg_date"
                />
                <small class="text-danger" v-if="errors.mfg_date">{{
                  errors.mfg_date[0]
                }}</small>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>EXP Date</label>
                <input
                  type="date"
                  class="form-control"
                  name="exp_date"
                  v-model="product.exp_date"
                />
                <small class="text-danger" v-if="errors.exp_date">{{
                  errors.exp_date[0]
                }}</small>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label>GST</label>
                <select class="form-control" name="gst" v-model="product.gst">
                  <option value="">Select GST Slab</option>
                  <option value="0">0%</option>
                  <option value="5">5%</option>
                  <option value="12">12%</option>
                  <option value="18">18%</option>
                  <option value="28">28%</option>
                </select>
                <small class="text-danger" v-if="errors.gst">{{
                  errors.gst[0]
                }}</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Product Category</label>
                <select
                  class="form-control"
                  name="category_id"
                  v-model="product.category_id"
                >
                  <option value="">Select Category</option>
                  <option
                    v-for="category in category"
                    :key="category.id"
                    v-bind:value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <small class="text-danger" v-if="errors.category_id">{{
                  errors.category_id[0]
                }}</small>
              </div>
            </div>


     <div class="col">
              <div class="form-group">
                <label>Quantity In Stock</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter Quantity"
                  name="opening_quantity"
                  v-model="product.opening_quantity"
                />
                <small class="text-danger" v-if="errors.opening_quantity">{{
                  errors.opening_quantity[0]
                }}</small>
              </div>
            </div>







            <div class="col" v-if="!this.edit">
              <div class="form-group">
                <label>Image</label>
                <input
                  type="file"
                  class="form-control-file"
                  placeholder="image"
                  name="image"
                  @change="chooseProduct($event)"
                />
                <small class="text-danger">{{ image_error }}</small>
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
      image_error: "",
      title: "Add product",
      toastTitle: "product added successfully",
      errors: {},

      loading: false,
      category: {},

      product: {
        id: "",
        name: "",
        type: "product",
        description: "",
        category_id: "",
        batch_no: "",
        hsn_code: "",
        mfg_date: "",
        exp_date: "",
        mrp: "",
        rack_no: "",
        gst: "",
        image: "",
        opening_quantity:'',
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
    this.getCategory();

    if (this.edit) {
      var _this = this;
      _this.title = "Edit product";
      _this.toastTitle = "product data Updated successfully";
      bus.$on("edit-product", function (product) {
        _this.clearFormData();

        _this.product.category_id = product.category.id;
        _this.product.id = product.id;
        _this.product.name = product.name;
        _this.product.description = product.description;
        _this.product.batch_no = product.batch_no;
        _this.product.hsn_code = product.hsn_code;
        _this.product.mfg_date = product.mfg_date;

        _this.product.exp_date = product.exp_date;
        _this.product.mrp = product.mrp;
        _this.product.rack_no = product.rack_no;
        _this.product.gst = product.gst;
_this.product.opening_quantity = product.opening_quantity;
      });
    }
  },

  methods: {
    //image
    chooseProduct(e) {
      console.log(e);
      var vm = this;

      vm.image_error = "";
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        vm.image_error = "Size must not exceed 200 kb.";

        return false;
      }

      reader.onload = function (ev) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = ev.target.result;

        //Validate the File Height and Width.
        image.onload = function () {
          var height = this.height;
          var width = this.width;
          if (height < 320 || (height > 350 && width < 520) || width > 550) {
            vm.image_error = "Image has invalid image dimension";

            return false;
          } else {
            vm.product.image = e.target.files[0];
          }
        };
      };
    },

    //image ends

    getCategory() {
      axios
        .get("get-categories")
        .then((response) => {
          this.category = response.data;
        })
        .catch((err) => {});
    },

    addProduct() {
      let upload = new FormData();
      if (this.edit) {
        upload.append("id", this.service.id);
      }
      upload.append("name", this.product.name);
      upload.append("description", this.product.description);
      upload.append("batch_no", this.product.batch_no);
      upload.append("hsn_code", this.product.hsn_code);
      upload.append("mfg_date", this.product.mfg_date);
      upload.append("exp_date", this.product.exp_date);
      upload.append("mrp", this.product.mrp);
      upload.append("rack_no", this.product.rack_no);
      upload.append("gst", this.product.gst);
      upload.append("category_id", this.product.category_id);
      upload.append("type", this.product.type);
       upload.append("opening_quantity", this.product.opening_quantity);
      upload.append("image", this.product.image);
      if (this.product.image == "" && !this.edit) {
        this.image_error = "this field required";
        return false;
      }
      this.loading = true;
      console.log(upload);
      axios
        .post("add-product", upload)
        .then((response) => {
          this.loading = false;
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });
            bus.$emit("product-added");
            this.$refs.close_product_modal.click();
            this.clearFormData();
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });

            bus.$emit("product-added");
            this.$refs.close_product_modal.click();
            this.clearFormData();
          }
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      for (let err in this.errors) {
        this.errors[err] = "";
      }

      for (let item in this.product) {
        this.product[item] = "";
      }
      this.product.type = "product";
      this.image_error = "";
    },
  },
};
</script>

<style scoped>
</style>