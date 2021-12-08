


<template>
  <div>
    <!-- Modal -->
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addPurchaseLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_purchase_modal"
        @click="clearData()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>

    <form class="form-horizontal">
      <div class="modal-body">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inv no" class="required">Invoice Number</label>
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
                <label for="inv no" class="required">Purchase Date</label>
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
          <div class="row" v-if="reportView == false">
            <div class="col">
              <label for="productName" class="required">Select Product </label>
              <div class="form-group">
                <model-list-select
                  :list="productsList"
                  name="product_id"
                  option-value="id"
                  :custom-text="productName"
                  placeholder="Select Product"
                  v-model="product_id"
                >
                </model-list-select>
                <small class="text-danger"> {{ productErrorMessage }}</small>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label for="purchaseQty" class="required"
                  >Product Quantity</label
                >
                <div class="input-group">
                  <input
                    type="number"
                    class="form-control width100 xyz"
                    v-model="purchase_qty"
                    name="purchase_qty"
                    placeholder="Enter product quantity"
                  />
                </div>
                <small class="text-danger">
                  {{ purchase_qtyErrorMessage }}</small
                >
              </div>
            </div>

            <div class="col">
              <label for="productName" class="required"
                >Rate Per Quantity
              </label>
              <div class="form-group">
                <input
                  type="number"
                  class="form-control width100 xyz"
                  v-model="rate_per_qty"
                  name="rate_per_qty"
                  placeholder="Rate per quantity"
                />
                <small class="text-danger"> {{ rate_per_qty_error_msg }}</small>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label for="purchaseQty" class="required"
                  >Select Gst Slab</label
                >
                <model-list-select
                  :list="this.gstList"
                  v-model="gst_percentage"
                  option-value="val"
                  :custom-text="gstSlab"
                  placeholder="select Gst"
                >
                </model-list-select>

                <small class="text-danger"> {{ gst_percentage_err_msg }}</small>
              </div>
              <span class="input-group-btn float-right">
                <button
                  class="btn btn-dark btn-sm"
                  @click.prevent="addNewRow()"
                >
                  Add <i class="fas fa-plus-circle fa-fw"></i>
                </button>
              </span>
            </div>
          </div>
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
                      <th>Rate</th>
                      <th>Gst</th>
                      <th>Taxable Value</th>
                      <th>Total Tax Amount</th>
                      <th>Total Amount</th>
                      <th v-if="reportView == false">Actions</th>
                    </tr>
                  </thead>
                  <tr v-if="this.purchaseData.items.length == 0">
                    <td colspan="9">
                      <p class="text-center light-danger p-2">
                        No products added.
                      </p>
                    </td>
                  </tr>
                  <tbody
                    v-for="(data, index) in purchaseData.items"
                    :key="index"
                  >
                    <tr v-if="purchaseData.items.length != 0">
                      <td>
                        {{ index + 1 }}
                      </td>
                      <td class="">
                        {{ data.product_name }}
                      </td>
                      <td>
                        {{ data.purchase_qty }}
                      </td>
                      <td>
                        {{ data.rate_per_qty }}
                      </td>
                      <td>
                        {{ data.gst_percentage }}
                      </td>
                      <td>
                        {{ data.taxable_amount }}
                      </td>
                      <td>
                        {{ data.tax }}
                      </td>
                      <td>
                        {{ data.amount }}
                      </td>
                      <td class="pl-4" v-if="reportView == false">
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
      <div class="modal-footer" v-if="reportView == false">
        <button
          type="submit"
          class="btn btn-primary rounded-pill"
          @click.prevent="submitPurchase()"
         :disabled=loading
        >
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
  props: ["edit", "viewOnly"],
  data() {
    return {
loading:false,
      product_id: "",
      purchase_qty: "",
      title: "Add Purchase",
      toastTitle: "Purchase added successfully",
      reportView: false,
      purchase_id: "",
      purchase_qtyErrorMessage: "",
      productErrorMessage: "",
rate_per_qty_error_msg:"",
gst_percentage_err_msg:"",


      productsList: [],

      errors: {},
      rate_per_qty: "",
      gst_percentage: "",
      purchaseData: {
        id: "",
        purchase_invoice_no: "",
        purchase_date: "",
        remarks: "",
        items: [],
      },
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

  methods: {
    submitPurchase() {
      if (this.edit) {
        this.purchaseData.id = this.purchase_id;
      }
this.loading=true;
      axios
        .post("add-purchase", this.purchaseData)
        .then((response) => {
          if (
            response.data == "items_error" ||
            response.data == "items_array_error"
          ) {
            Toast.fire({
              icon: "warning",
              title: "Please add purchase items to the list",
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
this.loading=false;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
this.loading=false;
        });
    },
    addNewRow() {
      if (this.product_id == "" || this.purchase_qty == "") {
        if (this.product_id == "") {
          this.productErrorMessage = "Please select product";
        }

        if (this.purchase_qty == "") {
          this.purchase_qtyErrorMessage = "Purchase quantity is required";
        }

if (this.rate_per_qty == "") {
          this.rate_per_qty_error_msg = "Rate per quantity is required";
        }


if (this.gst_percentage == "") {
          this.gst_percentage_err_msg = "Gst percentage is required";
        }

        return false;
      }

      var id = this.product_id;
      var product_name;

      for (let product in this.productsList) {
        if (this.productsList[product].id == id) {
          product_name = this.productsList[product].name;
          //for-calculating-amount
          var _tax_amount = this.rate_per_qty * this.purchase_qty;
          var _tax =
            (this.purchase_qty * this.rate_per_qty * this.gst_percentage) / 100;
          this.purchaseData.items.push({
            product_id: this.product_id,
            purchase_qty: this.purchase_qty,
            product_name: product_name,

            rate_per_qty: this.rate_per_qty,
            gst_percentage: this.gst_percentage,

            taxable_amount: this.rate_per_qty * this.purchase_qty,
            tax:
              (this.purchase_qty * this.rate_per_qty * this.gst_percentage) /
              100,

            amount: _tax_amount + _tax,
          });

          this.product_id = "";
          this.purchase_qty = "";

          (this.rate_per_qty = ""),
            (this.gst_percentage = ""),
            (this.productErrorMessage = "");

          this.purchase_qtyErrorMessage = "";
        }
      }
    },

    deleteRow(index) {
      this.purchaseData.items.splice(index, 1);
    },
    getProducts() {
      axios
        .get("get-products")
        .then((response) => {
          this.productsList = response.data;
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
      this.errors = {};

      this.product_id = "";
      this.purchase_qty = "";
      this.productErrorMessage = "";

      this.purchase_qtyErrorMessage = "";
    },

    // search component functions

    productName(item) {
      return `${item.name}`;
    },

    gstSlab(item) {
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

var ratePerQty=purchase.purchase_items[item].rate_per_qty;
var gstPercentage=purchase.purchase_items[item].gst_percentage;
var taxableAmount=purchase.purchase_items[item].taxable_amount;
var tax=purchase.purchase_items[item].tax;
var totalAmount=purchase.purchase_items[item].amount;


          for (let product in _this.productsList) {
            if (_this.productsList[product].id == productId) {
              var product_name = _this.productsList[product].name;

              _this.purchaseData.items.push({
                product_id: productId,
                purchase_qty: purchaseQty,
                product_name: product_name,

rate_per_qty:ratePerQty,
gst_percentage:gstPercentage,
taxable_amount:taxableAmount,
tax:tax,
amount:totalAmount,


              });
              //   console.log(_this.productsList[product].id);
            }
          }
        }
      });
    }

    if (this.viewOnly) {
      var _this = this;
      _this.reportView = true;

      _this.title = "Purchase Details";
    }
  },

  watch: {
    product_id: function () {
      if (this.product_id != "") {
        this.productErrorMessage = "";
      }
    },

    purchase_qty: function () {
      if (this.purchase_qty != "") {
        this.purchase_qtyErrorMessage = "";
      }
    },

 rate_per_qty: function () {
      if (this.rate_per_qty != "") {
        this.rate_per_qty_error_msg = "";
      }
    },

gst_percentage: function () {
      if (this.gst_percentage != "") {
        this.gst_percentage_err_msg = "";
      }
    },
  },
};
</script>
<style scoped>
.xyz {
  max-height: 38px;
}

/*.light-danger{
background-color: rgba(247, 25, 25, 0.247);
 color: rgba(0, 0, 0, 0.705);
}*/
</style>
