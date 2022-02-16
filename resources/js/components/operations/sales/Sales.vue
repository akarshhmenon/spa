<template>
  <div class="px-2">
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="Vendor" class="required">Select Vendor</label>
          <multiselect
            v-model="select_item"
            placeholder="Search for a item"
            label="name"
            :options="vendors"
            track-by="id"
            :options-limit="4"
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
          />
          <small class="text-danger" v-if="errors.purchase_invoice_no">{{
            errors.purchase_invoice_no[0]
          }}</small>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="totaltax" class="">Remarks</label>
          <input
            type="textarea"
            class="form-control"
            name="remarks"
            placeholder="Enter Remarks"
            v-model="purchase.remarks"
          />
          <small class="text-danger" v-if="errors.remarks">{{
            errors.remarks[0]
          }}</small>
        </div>
      </div>

    </div>
<hr>
 <div class="row">
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
    <div class="row">
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

   

    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <br /><br />
          <span class="input-group-btn float-right mr-4">
            <button class="btn btn-dark btn-sm" @click.prevent="addNewRow()">
              Add To List<i class="fas fa-plus-circle fa-fw"></i>
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
            class="table align-items-center table-flush table-hover display text-center"
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
                  {{ data.product_id }}
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
                  {{ data.totalTaxAmount }}
                </td>
                <td>
                  {{ data.amount }}
                </td>
                <td class="pl-4">
                  <button
                    class="btn btn-danger btn-sm"
                    @click.prevent="deleteRow(index)"
                  >
                    <i title="Delete" class="fas fa-trash fafw"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>

<tr>
  <td colspan="7" class="text-right">Total</td><td>{{amountTotal}}</td>
</tr>

            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <div class="row text-center pb-3">
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
  props: ["edit"],

  data() {
    return {
      title: "Add Sales",
      toastTitle: "Sales added successfully",
      errors: {},
      select_item: [],
      select_product: [],
      loading: false,
      vendors: [],
      products: [],
      product_id: "",
      purchase_qty: "1",
      rate_per_qty: "",
      taxable_amount: "",
      gst_percentage: "",
      tax: "",
      amount: "",

      purchase: {
        items: [],
        id: "",
        vendor_id: "",
        billtype: "",
        paytype: "",
        purchasedate: "",
        purchase_invoice_no: "",
        totalproduct: "",
        totalquantity: "",
        totaltaxableamount: "",
        totaltax: "",
        totalamount: "",
        remarks: "",
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

amountTotal: function(){

  let total =0;

this.purchase.items.forEach((e) => {
      total+=e.amount; // the value of the current key.
  });

  return total;

}


  },
  created() {
    this.getVendors();
    this.getproducts();

    if (this.edit) {
      var _this = this;
      _this.title = "Edit purchase";
      _this.toastTitle = "purhase data Updated successfully";
      bus.$on("edit-purchase", function (purchase) {
        _this.clear_form_data();
        console.log(purchase);
        _this.purchase.vendor_id = purchase.vendor_id;
        _this.purchase.billtype = purchase.billtype;
        _this.purchase.paytype = purchase.paytype;
        _this.purchase.purchasedate = purchase.purchasedate;
        _this.purchase.purchase_invoice_no = purchase.purchase_invoice_no;
        _this.purchase.totalproduct = purchase.totalproduct;
        _this.purchase.totalquantity = purchase.totalquantity;
        _this.purchase.totaltaxableamount = purchase.totaltaxableamount;
        _this.purchase.totaltax = purchase.totaltax;
        _this.purchase.totalamount = purchase.totalamount;
        _this.purchase.remarks = purchase.remarks;
      });
    }
  },

  methods: {
    getVendors() {
      axios
        .get("get-vendors")
        .then((response) => {
          this.vendors = response.data;
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
      this.loading = true;
      axios
        .post("add-purchase", this.purchase)
        .then((response) => {
          this.loading = false;
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
        })
        .catch((err) => {
          this.loading = false;
          if (err) {
            this.errors = err.response.data.errors;
            Toast.fire({
              icon: "error",
              title: "Try Again !",
            });
          }
        });
    },

    //add product
    addNewRow() {

if(this.product_id==''||this.purchase_qty==''||this.rate_per_qty==''||this.gst_percentage==''){

alert('fields are empty');
return false;
}
var totalTaxAmount=(this.rate_per_qty*this.gst_percentage/100)*this.purchase_qty;
      this.purchase.items.push({
        product_id: this.product_id,
        purchase_qty: this.purchase_qty,
        rate_per_qty: this.rate_per_qty,
        gst_percentage:this.gst_percentage,
        totalTaxAmount:totalTaxAmount,
        amount:(this.rate_per_qty*this.purchase_qty)+totalTaxAmount,
      });
      this.new_product = false;

      this.product_id = "";
      this.products = [];
      this.purchase_qty = "1";

      this.rate_per_qty = "";
      this.gst_percentage = "";
      this.taxable_amount = "";
      this.tax = "";
      this.amount = "";
    },

    deleteRow(index) {
      this.purchase.items.splice(index, 1);
    },

    clear_form_data() {
      for (let item in this.purchase) {
        this.purchase[item] = "";
        this.products = [];
         this.purchase_qty = "1";
      }
      this.products = [];
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
</style>