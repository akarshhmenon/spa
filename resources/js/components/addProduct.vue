<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addProductLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_product_modal"
        @click="clearData()"
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
          <div class="">
            <div class="form-group">
              <label for="category" class="required">Select Category</label>
              <select
                class="form-control"
                id="product_category_id"
                name="product_category"
                v-model="products.product_category"
                :disabled="edit"
              >
                <option value="">Select Category</option>
                <option
                  v-for="category in productCategories"
                  :key="category.id"
                  v-bind:value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>
              <small class="text-danger" v-if="errors.product_category">{{
                errors.product_category[0]
              }}</small>
            </div>

            <div class="form-group" v-if="products.product_category">
              <label for="productName" class="required">Product Name</label>
              <input
                type="text"
                class="form-control"
                id="productName"
                placeholder="Enter Product Name"
                v-model="products.name"
                required
              />
              <small class="text-danger" v-if="errors.name">
                {{ errors.name[0] }}</small
              >
            </div>

            <div
              class="form-group"
              v-if="
                products.product_category === 1 ||
                products.product_category === 2
              "
            >
              <label for="openingQuantity">Opening Quantity</label>
              <input
                type="number"
                class="form-control"
                id="openingQuantity"
                placeholder="Enter Opening Quantity"
                v-model="products.opening_quantity"
                :disabled="edit"
              />
            </div>

            <div class="form-group" v-if="products.product_category === 1 && usergst==1">
              <label for="purchaseQty" class="required">Select Gst Slab</label>
              <model-list-select
                :list="this.gstList"
                v-model="products.gst"
                option-value="val"
                :custom-text="gstSlab"
                placeholder="select Gst"
              >
              </model-list-select>

              <small class="text-danger"> </small>
            </div>

            <div class="form-group" v-if="products.product_category === 1 ">
              <label for="openingQuantity">Mrp</label>
              <input
                type="number"
                class="form-control"
                id="mrp"
                placeholder="Enter Mrp"
                v-model="products.mrp"
              />
            </div>

            <div class="form-group" v-if="products.product_category === 2">
              <label for="rewardPoints">Reward Points</label>
              <input
                type="number"
                class="form-control"
                id="rewardPoints"
                placeholder="Enter Reward Points"
                v-model="products.reward_points"
                :disabled="edit"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary rounded-pill" :disabled=loading>
          {{ button_title }} <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>

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
  props: ["edit","usergst"],
  data() {
    return {
      title: "Add Product",
      productCategories: {},

      loading: false,

      products: {
        id: "",
        product_category: "",
        name: "",
        opening_quantity: "",
        reward_points: "",
        mrp: "",
        gst: "",
      },
      errors: {},

      gstList: [
        {
          val: "0",
          name: "0%",
        },
        {
          val: 5,
          name: "5%",
        },

        {
          val: 12,
          name: "12%",
        },
        {
          val: 18,
          name: "18%",
        },
        {
          val: 28,
          name: "28%",
        },
      ],
    };
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
  created() {
    this.getCategories();

    if (this.edit) {
      var _this = this;
      _this.title = "Edit Product";
      bus.$on("edit-product", function (product) {
        _this.clearData();
        _this.products.product_category = product.category_id;
        _this.products.id = product.id;
        _this.products.name = product.name;

        _this.products.opening_quantity = product.opening_quantity;
        _this.products.reward_points = product.reward_points;

        _this.products.gst = parseFloat(product.gst);
        _this.products.mrp = product.mrp;
      });
    }
  },

  methods: {
    getCategories() {
      axios
        .get("product-categories")
        .then((response) => {
          this.productCategories = response.data;
        })
        .catch((err) => {});
    },

    addProduct() {
      if (this.edit) {
        this.products.id = this.products.id;
      }
      this.loading = true;
      axios
        .post("add-product", this.products)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Product Added successfully",
            });
            bus.$emit("product-added");
            this.$refs.close_product_modal.click();
            this.clearData();
          }
            this.loading = false;
        })
        .catch((error) => {
this.loading = false;
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearData() {
      this.products.product_category = "";
      this.products.name = "";
      this.products.opening_quantity = "";
      this.products.reward_points = "";
      this.errors = {};
    },

    gstSlab(item) {
      return `${item.name}`;
    },
  },
};
</script>
