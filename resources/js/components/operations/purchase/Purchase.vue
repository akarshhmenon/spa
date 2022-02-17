<template>
  <div class="px-2">
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="Vendor" class="required">Select Vendor</label>
          <multiselect
            v-model="select_item"
            placeholder="Search.."
            label="name"
            :options="vendors"
            track-by="id"
            :options-limit="4"
            :disabled="viewOnly"
          ></multiselect>

          <small class="text-danger" v-if="errors.vendor_id">{{
            errors.vendor_id[0]
          }}</small>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="purchasedate" class="">Purhase Date</label>
          <input
            type="date"
            class="form-control"
            name="purchasedate"
            placeholder="purchase date"
            v-model="purchase.purchasedate"
            :disabled="viewOnly"
          />
          <small class="text-danger" v-if="errors.purchasedate">{{
            errors.purchasedate[0]
          }}</small>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="purchase_invoice_no" class="">Purchase Invoice No:</label>
          <input
            type="text"
            class="form-control"
            name="purchase_invoice_no"
            placeholder="Enter Purchase_Invoice_No "
            v-model="purchase.purchase_invoice_no"
            :disabled="viewOnly"
          />
          <small class="text-danger" v-if="errors.purchase_invoice_no">{{
            errors.purchase_invoice_no[0]
          }}</small>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="totaltax" class="">Remarks</label>

          <textarea
            class="form-control form-height item shadow-sm"
            name="remarks"
            v-model="purchase.remarks"
          >
          </textarea>

          <small class="text-danger" v-if="errors.remarks">{{
            errors.remarks[0]
          }}</small>
        </div>
      </div>
    </div>
    <hr />
    <div class="row" v-if="viewOnly != true">
      <div class="col-6">
        <div class="form-group">
          <label for="Vendor" class="required">Select Product</label>
          <multiselect
            v-model="select_product"
            placeholder="Search for a item"
            label="name"
            :options="products"
            track-by="id"
            :options-limit="4"
          ></multiselect>

          <small class="text-danger" v-if="errors.product_id">{{
            errors.product_id[0]
          }}</small>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label class="required">Select GST Slab</label>
          <select class="form-control" name="gst_no" v-model="gst_percentage">
            <option value="">Select GST Slab</option>
            <option value="0">0%</option>
            <option value="5">5%</option>
            <option value="12">12%</option>
            <option value="18">18%</option>
            <option value="28">28%</option>
          </select>
          <small class="text-danger" v-if="errors.gst_percentage">{{
            errors.gst_percentage[0]
          }}</small>
        </div>
      </div>
    </div>
    <div class="row" v-if="viewOnly != true">
      <div class="col-6">
        <div class="form-group">
          <label for="totalamount" class="">Purchase_qty</label>
          <input
            type="number"
            class="form-control"
            name="purchase_qty"
            min="1"
            oninput="validity.valid||(value='');"
            placeholder="Enter Purchase_qty "
            v-model="purchase_qty"
          />
          <small class="text-danger" v-if="errors.purchase_qty">{{
            errors.purchase_qty[0]
          }}</small>
        </div>

        <small class="text-danger" v-if="errors.purchase_qty">
          {{ errors.purchase_qty[0] }}</small
        >
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="totaltax" class="">Rate Per Qty</label>
          <input
            type="number"
            class="form-control"
            name="rate_per_qty"
            min="1"
            oninput="validity.valid||(value='');"
            placeholder="Enter Rate Per   QTY "
            v-model="rate_per_qty"
          />
          <small class="text-danger" v-if="errors.rate_per_qty">{{
            errors.rate_per_qty[0]
          }}</small>
        </div>
      </div>
    </div>

    <div class="row" v-if="viewOnly != true">
      <div class="col-12">
        <div class="form-group">
          <br /><br />
          <span class="input-group-btn float-right mr-4">
            <button class="btn btn-dark btn-sm" @click.prevent="addNewRow()">
              Add To List <i class="fas fa-plus-circle fa-fw"></i>
            </button>
          </span>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-12">
        <h5><center>ITEMS</center></h5>
        <div class="table-responsive mt-3">
          <table
            id="myTable"
            class="
              table
              align-items-center
              table-flush table-hover
              display
              text-center
            "
          >
            <thead>
              <tr>
                <th>Sl.no</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Rate Per Quantity</th>
                <th>Gst%</th>

                <th>Total Tax Amount</th>
                <th>Total Amount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tr v-if="this.purchase.items.length == 0">
              <td colspan="9">
                <p class="text-center light-danger p-2">No products added.</p>
              </td>
            </tr>
            <tbody v-for="(data, index) in purchase.items" :key="index">
              <tr v-if="purchase.items.length != 0">
                <td>
                  {{ index + 1 }}
                </td>
                <td>
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
                  {{ data.total_tax_amount }}
                </td>
                <td>
                  {{ data.amount }}
                </td>
                <td class="pl-4">
                  <button
                    class="btn btn-danger btn-sm"
                    @click.prevent="deleteRow(index)"
                    :disabled="viewOnly"
                  >
                    <i title="Delete" class="fas fa-trash fafw"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot v-if="purchase.items.length != 0">
              <tr>
                <td colspan="6" class="text-right">Total</td>
                <td>
                  <strong>{{ amountTotal }}/-</strong>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <div
      class="row text-center pb-3"
      v-if="viewOnly != true && purchase.items.length != 0"
    >
      <div class="col">
        <button
          type="button"
          @click="addPurchase()"
          class="btn btn-primary rounded-pill"
          :disabled="loading"
        >
          {{ button_title }}
          <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
        </button>
      </div>
    </div>
  </div>

  <!--added-->
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
      title: "Add Purchase",
      toastTitle: "purchase added successfully",
      errors: {},
      select_item: [],
      select_product: [],
      loading: false,
      vendors: [],
      edit_vendor_id: "",
      products: [],
      product_id: "",
      purchase_qty: "1",
      rate_per_qty: "",

      gst_percentage: "",

      purchase: {
        items: [],
        id: "",
        vendor_id: "",

        purchasedate: "",
        purchase_invoice_no: "",
        total_amount: "",
        remarks: "",
      },
    };
  },

  computed: {
    button_title() {
      if (this.loading == true) {
        return "processing..  ";
      } else {
        return "Add Purchase";
      }
    },

    amountTotal: function () {
      let total = 0;
      if (this.purchase.items.length != 0) {
        this.purchase.items.forEach((e) => {
          total += parseFloat(e.amount); // the value of the current key.
        });

        return parseFloat(total).toFixed(2);
      }
    },
  },
  created() {
    this.getVendors();
    this.getproducts();

    var _this = this;
    bus.$on("clear-field", function () {
      _this.clear_form_data();
    });

    if (this.edit) {
      var _this = this;
      _this.title = "Edit purchase";
      _this.toastTitle = "purhase data Updated successfully";
      bus.$on("edit-purchase", function (purchase) {
        _this.clear_form_data();

        _this.purchase.id = purchase.id;

        _this.purchase.items = purchase.purchase_items;
        _this.edit_vendor_id = purchase.vendor_id;

        _this.purchase.purchasedate = purchase.purchase_date;
        _this.purchase.purchase_invoice_no = purchase.purchase_invoice_no;

        _this.purchase.remarks = purchase.remarks;
        _this.getVendors();
        _this.getproducts();
      });
    }
  },

  methods: {
    getVendors() {
      axios
        .get("get-vendors")
        .then((response) => {
          this.vendors = response.data;

          if (this.edit == true) {
            this.select_item = this.vendors.find(
              (vendor) => vendor.id == this.edit_vendor_id
            );
          } else {
            this.vendors = [];
          }
        })
        .catch((err) => {});
    },
    getproducts() {
      axios
        .get("get-product")
        .then((response) => {
          this.products = response.data;
        })
        .catch((err) => {});
    },
    addPurchase() {
      this.purchase.total_amount = parseFloat(this.amountTotal);

      this.loading = true;
      axios
        .post("add-purchase", this.purchase)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });

            this.clear_form_data();
            bus.$emit("purchase-added");
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });
          }
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          if (err) {
            this.errors = err.response.data.errors;
            Toast.fire({
              icon: "error",
              title: "Try Again !",
            });
            this.loading = false;
          }
        });
    },

    //add product
    addNewRow() {
      if (
        this.product_id == "" ||
        this.purchase_qty == "" ||
        this.rate_per_qty == "" ||
        this.gst_percentage == ""
      ) {
        alert("fields are empty");
        return false;
      }
      var totalTaxAmount =
        ((this.rate_per_qty * this.gst_percentage) / 100) * this.purchase_qty;
      this.purchase.items.push({
        product_id: this.select_product.id,
        product_name: this.select_product.name,
        purchase_qty: this.purchase_qty,
        rate_per_qty: this.rate_per_qty,
        gst_percentage: this.gst_percentage,
        total_tax_amount: totalTaxAmount,
        amount: this.rate_per_qty * this.purchase_qty + totalTaxAmount,
      });
      this.new_product = false;

      this.product_id = "";
      this.select_product = [];

      this.purchase_qty = "1";

      this.rate_per_qty = "";
      this.gst_percentage = "";
    },

    deleteRow(index) {
      this.purchase.items.splice(index, 1);
    },

    clear_form_data() {
      for (let item in this.purchase) {
        this.purchase[item] = "";
      }
      this.purchase.items = [];
      this.purchase_qty = "1";
      this.product_id = "";
      this.purchase_qty = "1";
      this.rate_per_qty = "";
      this.edit_vendor_id = "";
      this.gst_percentage = "";
      this.select_item = [];
      this.select_product = [];
      for (let err in this.errors) {
        this.errors[err] = "";
      }

      this.title = "Add Purchase";
      this.toastTitle = "Added successfully";
    },
  },
  watch: {
    select_item: function () {
      if (this.select_item != null) {
        this.purchase.vendor_id = this.select_item.id;
      }
    },
    select_product: function () {
      if (this.select_product != null) {
        this.product_id = this.select_product.id;
      }
    },
  },
};
</script>

<style scoped>
.form-height {
  height: 43px;
}
</style>