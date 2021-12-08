


<template>
  <div>

    <!-- Modal -->
    <div class="modal-header">
      <h5 class="modal-title" id="addPurchaseLabel">{{ title }}</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_purchase_modal"
        @click="clearData()"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <form class="form-horizontal">
      <div class="modal-body">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inv no">Invoice Number</label>
                <input
                  type="text"
                  class="form-control"
                  name="purchase_invoice_no"
                  placeholder="Enter Invoice Number"
                  v-model="purchaseData.purchase_invoice_no"
                  :disabled="reportView"
                />
                <small class="text-danger" v-if="errors.purchase_invoice_no">
                  {{ errors.purchase_invoice_no[0] }}</small
                >
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label for="inv no">Purchase Date</label>
                <input
                  type="date"
                  class="form-control"
                  name="purchase_date"
                  v-model="purchaseData.purchase_date"
                    :disabled="reportView"
                />
                <small class="text-danger" v-if="errors.purchase_date">
                  {{ errors.purchase_date[0] }}</small
                >
              </div>
            </div>
          </div>

          <!--row end-->

          <!------SELECT 2 DROPDOWN SEARCH-->

          <!--   <div class="form-group">
                    <label for="select2Single">Select Product</label>
                    <select class="select2-single form-control" name="product" data-width="100%" id="select2-products" ref="check" v-model="productID">
                      <option value="">Select Products</option>
                      <option :value="product.id" v-for="product in productsList" :key="product.id">{{ product.name  }} {{ product.id }}</option>
                    </select>
                 </div>-->

          <!--SELECT 2 DROPDOWN END-->

          <!--<search-test></search-test>-->

          <div class="row mt-4">
            <div class="col-md-12">
              <h5>Items</h5>
              <div class="table-responsive mt-3">
                <table
                  id="myTable"
                  class="
                    table
                    align-items-center
                    table-flush table-hover
                    display
                  "
                >
                  <thead>
                    <tr>
                      <th>Sl.no</th>
                      <th>Item</th>
                      <th>Quantity</th>
                      <th  v-if="reportView==false">Actions</th>
                    </tr>
                  </thead>
                  <tbody
                    v-for="(data, index) in purchaseData.items"
                    :key="index"
                  >
                    <tr >
                      <td>
                        {{ index + 1 }}
                      </td>
                      <td class="col-4">
 <model-list-select
                  :list="productsList"
                  name="product_id"
                  v-model="data.product_id"
                  option-value="id"
                  :custom-text="customerNameAndMobile"
                  placeholder="select product"
                    :isDisabled="reportView"
                >
                </model-list-select>


                <!-- search component end -->
                        <!-- <select
                          class="form-control xyz"
                          name="product_name"
                          v-model="data.product_id"
                        >
                          <option value="">Select Product</option>
                          <option
                            v-for="product in productsList"
                            :key="product.id"
                            v-bind:value="product.id"
                          >
                            {{ product.name }}
                          </option>
                        </select> -->
                        <small class="text-danger" v-if="errors.product_name">
                          {{ errors.product_name[0] }}</small
                        >
                      </td>
                      <!-- <td width="50%">
                        <v-select
                          :options="arrayProduct"
                          v-model="data.product_name"
                          placeholder="select product"
                          class="xyz"
                        ></v-select>
                      </td>-->
                      <td>
                        <input
                          type="number"
                          class="form-control col-8 xyz"
                          value="1"
                          name="purchase_qty"
                          v-model="data.purchase_qty"
                            :disabled="reportView"
                        />
                        <small class="text-danger" v-if="errors.purchase_qty">
                          {{ errors.purchase_qty[0] }}</small
                        >
                      </td>
                      <td class="pl-4"  v-if="reportView==false">
                        <button
                          class="btn btn-danger btn-sm"
                          @click.prevent="deleteRow(index)"
                        >
                          <i title="Delete" class="fas fa-trash fafw"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
 <button
                  class="btn btn-sm btn-primary float-right mb-3"
                  @click.prevent="addNewRow"
                 v-if="reportView==false">
                  Add new <i class="fas fa-plus-circle fa-fw fa-1x"></i>
                </button>

              <div class="form-group">
                <label for="exampleFormControlTextarea1"
                  >Purchase Remarks</label
                >
                <textarea
                  class="form-control"
                  rows="2"
                  v-model="purchaseData.remarks"
                    :disabled="reportView"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer"  v-if="reportView==false">
        <button
          type="submit"
          class="btn btn-dark rounded-pill"
          @click.prevent="submitPurchase()"
        >
          Save changes
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
  props: ["edit" ,"viewOnly"],
  data() {
    return {
      title: "Add Purchase",
      toastTitle: "Purchase added successfully",
 reportView:false,
      purchase_id: "",
      test: {},
      productsList: [],
      //   arrayProduct: [],
      errors: {},
      purchaseData: {
        id: "",
        purchase_invoice_no: "",
        purchase_date: "",
        remarks: "",
        items: [
          {
            product_id: "",
            purchase_qty: "",
          },
        ],
      },
    };
  },

  methods: {
    // myChangeEvent(val){
    //             console.log(val);
    //         },
    //         mySelectEvent({id, text}){
    //             console.log({id, text})
    //         },

    submitPurchase() {
      if (this.edit) {
        this.purchaseData.id = this.purchase_id;
      }
      axios
        .post("add-purchase", this.purchaseData)
        .then((response) => {
            if (response.data == "items_error" || response.data == "items_array_error") {
             Toast.fire({
              icon: "warning",
               title: 'Please Add Purchase Items...',
            });
          }

          if (response.data == "success") {
             bus.$emit("purchase-added");
            this.$refs.close_purchase_modal.click();
            Toast.fire({
              icon: "success",
               title: this.toastTitle,
            });
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    addNewRow() {
      this.purchaseData.items.push({
        product_id: "",
        purchase_qty: "",
      });
    },

    deleteRow(index) {
      this.purchaseData.items.splice(index, 1);
    },
    getProducts() {
      axios
        .get("get-products")
        .then((response) => {
          this.productsList = response.data;

          //   for (let product in this.productsList) {
          //     let a = this.productsList[product].name;
          //     this.arrayProduct.push(a);
          //   }
        })
        .catch((err) => {
          console.log("products errs".err);
        });
    },

    clearData() {
      this.purchaseData.purchase_invoice_no = "";
      this.purchaseData.purchase_date = "";
      this.purchaseData.remarks = "";
      this.purchaseData.items = [];
      this.errors={};
    },

 // search component functions

    customerNameAndMobile(item) {
      return `${item.name}`;
    },
  },

  created() {
    this.getProducts();



    if (this.edit) {
      var _this = this;
      _this.title = "Edit Purchase";
       _this.toastTitle = "Purchase updated successfully";
      bus.$on("edit-purchase", function (purchase) {

        _this.clearData();
        _this.purchaseData.purchase_invoice_no = purchase.purchase_invoice_no;
        _this.purchaseData.purchase_date = purchase.purchase_date;
        _this.purchaseData.remarks = purchase.remarks;
        _this.purchase_id = purchase.id;

// console.log(purchase.purchase_items)
        for (let item in purchase.purchase_items) {
          var productId = purchase.purchase_items[item].product_id;
          var purchaseQty = purchase.purchase_items[item].purchase_qty;

          for (let product in _this.productsList) {
            if (_this.productsList[product].id == productId) {
              _this.purchaseData.items.push({
                product_id: productId,
                purchase_qty: purchaseQty,
              });
            //   console.log(_this.productsList[product].id);
            }
          }
        }
      });
    }


 if (this.viewOnly) {
      var _this = this;
_this.reportView=true;

      _this.title = "Purchase Details";
      bus.$on("view-purchase", function (purchase) {

_this.clearData();
        _this.purchaseData.purchase_invoice_no = purchase.purchase_invoice_no;
        _this.purchaseData.purchase_date = purchase.purchase_date;
        _this.purchaseData.remarks = purchase.remarks;
        _this.purchase_id = purchase.id;

// console.log(purchase.purchase_items)
        for (let item in purchase.purchase_items) {
          var productId = purchase.purchase_items[item].product_id;
          var purchaseQty = purchase.purchase_items[item].purchase_qty;

          for (let product in _this.productsList) {
            if (_this.productsList[product].id == productId) {
              _this.purchaseData.items.push({
                product_id: productId,
                purchase_qty: purchaseQty,
              });
            //   console.log(_this.productsList[product].id);
            }
          }
        }

        //
      });
    }
  },

  // updated(){
  // // $('.select2-single').$destroy;
  // $('#select2-products').select2().on("select2:select", e => {
  //       const event = new Event("change", { bubbles: true, cancelable: true });
  //       e.params.data.element.parentElement.dispatchEvent(event);
  //     })
  //     .on("select2:unselect", e => {
  //       const event = new Event("change", { bubbles: true, cancelable: true });
  //       e.params.data.element.parentElement.dispatchEvent(event);

  //     });

  // }
};
</script>
<style scoped>
.xyz {
  max-height: 34px;

}
</style>
