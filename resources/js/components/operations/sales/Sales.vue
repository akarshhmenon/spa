<template>
  <div class="px-2">
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="Vendor" class="required">Select Customer</label>
          <multiselect
            v-model="select_customer"
            placeholder="Search for a item"
            label="name"
            :options="customers"
            track-by="id"
            :options-limit="4"
          ></multiselect>

          <small class="text-danger" v-if="errors.customer_id">{{
            errors.customer_id[0]
          }}</small>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label  class="">Invoice Date</label>
          <input
            type="date"
            class="form-control"
            name="invoice_date"
            placeholder="invoice date"
            v-model="sale.invoice_date"
          />
          <small class="text-danger" v-if="errors.invoice_date">{{
            errors.invoice_date[0]
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
            v-model="sale.remarks"
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
          <label for="taxable_amount" class="">Sale Quantity</label>
          <input
            type="number"
            class="form-control"
            name="sale_quantity"
                     min="1"
                  oninput="validity.valid||(value='');"
            placeholder="Enter sale_quantity "
            v-model="sale_quantity"
          />
          <small class="text-danger" v-if="errors.sale_quantity">{{
            errors.sale_quantity[0]
          }}</small>
        </div>

        <small class="text-danger" v-if="errors.sale_quantity">
          {{ errors.sale_quantity[0] }}</small
        >
      </div>
      <div class="col-6">
        <div class="form-group">
          <label  class="">Rate Per Qty</label>
          <input
            type="number"
            class="form-control"
            name="rate_per_qty"
                     min="1"
                  oninput="validity.valid||(value='');"
            placeholder="Enter Rate Per QTY "
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
            <tr v-if="this.sale.items.length == 0">
              <td colspan="9">
                <p class="text-center light-danger p-2">No products added.</p>
              </td>
            </tr>
            <tbody v-for="(data, index) in sale.items" :key="index">
              <tr v-if="sale.items.length != 0">
                <td>
                  {{ index + 1 }}
                </td>
                <td>
                  {{ data.product_id }}
                </td>
                <td>
                  {{ data.sale_quantity }}
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
          @click="addSale()"
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
      select_customer: [],
      select_product: [],
      loading: false,
      customers: [],
      products: [],
      product_id: "",
      sale_quantity: "1",
      rate_per_qty: "",
      taxable_amount: "",
      gst_percentage: "",
      tax: "",
      amount: "",

      sale: {
        items: [],
        id: "",
        customer_id: "",
     
        paytype: "",
        invoice_date: "",
    
        taxable_amount: "",
       
        remarks: "",
      },
    };
  },

  computed: {
    button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Add Sale";
      }
    },

amountTotal: function(){

  let total =0;

this.sale.items.forEach((e) => {
      total+=e.amount; // the value of the current key.
  });

  return total;

}


  },
  created() {
    this.getCustomers();
    this.getProducts();

    if (this.edit) {
      var _this = this;
      _this.title = "Edit sale";
      _this.toastTitle = "Data Updated successfully";
      bus.$on("edit-sale", function (sale) {
        _this.clear_form_data();
        console.log(sale);
        _this.sale.customer_id = sale.customer_id;
       
        _this.sale.paytype = sale.paytype;
        _this.sale.invoice_date = sale.invoice_date;
       
        _this.sale.taxable_amount = sale.taxable_amount;
        _this.sale.remarks = sale.remarks;
      });
    }
  },

  methods: {
    getCustomers() {
      axios
        .get("get-customers")
        .then((response) => {
          this.customers = response.data;
        })
        .catch((err) => {});
    },
    getProducts() {
      axios
        .get("get-product")
        .then((response) => {
          this.products = response.data;
        })
        .catch((err) => {});
    },
    addSale() {
      this.loading = true;
      axios
        .post("add-sale", this.sale)
        .then((response) => {
          this.loading = false;
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });

            this.clear_form_data();
            bus.$emit("sale-added");
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

if(this.product_id==''||this.sale_quantity==''||this.rate_per_qty==''||this.gst_percentage==''){

alert('fields are empty');
return false;
}
var totalTaxAmount=(this.rate_per_qty*this.gst_percentage/100)*this.sale_quantity;
      this.sale.items.push({
        product_id: this.product_id,
        sale_quantity: this.sale_quantity,
        rate_per_qty: this.rate_per_qty,
        gst_percentage:this.gst_percentage,
        totalTaxAmount:totalTaxAmount,
        amount:(this.rate_per_qty*this.sale_quantity)+totalTaxAmount,
      });
      this.new_product = false;

      this.product_id = "";
      this.products = [];
      this.sale_quantity = "1";

      this.rate_per_qty = "";
      this.gst_percentage = "";
      this.taxable_amount = "";
      this.tax = "";
      this.amount = "";
    },

    deleteRow(index) {
      this.sale.items.splice(index, 1);
    },

    clear_form_data() {
      for (let item in this.sale) {
        this.sale[item] = "";
        this.products = [];
         this.sale_quantity = "1";
      }
      this.products = [];
      for (let err in this.errors) {
        this.errors[err] = "";
      }

      this.title = "Add sale";
      this.toastTitle = "Added successfully";
    },
  },
  watch: {
    select_customer: function () {
      if (this.select_customer != null) {
        this.sale.customer_id = this.select_customer.id;
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