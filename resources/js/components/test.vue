<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="addcustomerLabel">
        {{ title }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_sale_modal"
        @click="clear_form_data()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <div class="card-body" id="salesForm">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <div class="form-group">
                <label for="customer" class="required">Select Customer</label>

                <!-- search component -->

 <multiselect v-model="customer" tag-placeholder="Add this as new Customer" placeholder="Search or add a tag" label="name"  :options="customer_list" :taggable="true" @tag="addTag" track-by="mobile"></multiselect>

<div class="form-group" v-if="newCustom == true">
<input type="text" name="" id="" placeholder="Enter Name" v-model="sale.name" class="form-control"><br>
<input type="phone" name="" id="" placeholder="Enter Mobile Number" v-model="sale.mobile" class="form-control"><br>
<input type="text" name="" id="" placeholder="Enter GST Number" v-model="sale.gst_no" class="form-control"><br>

</div>
<br>
<br>
{{ customer}}<br><br>{{ mobile }}<br><br>{{ gst_no }}<br><br>{{ this.sale.customer_id }}

               <!-- <model-list-select
                  :list="this.customer_list"
                  name="customer_id"
                  v-model="sale.customer_id"
                  option-value="id"
                  :custom-text="customerNameAndMobile"
                  placeholder="select customer"
                  :isDisabled="this.reportView"
                >
                </model-list-select>-->

                <!-- search component end -->
              </div>

              <small class="text-danger" v-if="errors.customer_id">
                {{ errors.customer_id[0] }}</small
              >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="category" class="required">Select Bill Type</label>
              <select
                class="form-control"
                id="bill_type"
                v-model="sale.bill_type"
                name="bill_type"
                :disabled="reportView"
              >
                <option value="">Select Bill Type</option>

                <option value="2">Cash</option>
                <option value="1">Credit</option>
              </select>
            </div>
            <small class="text-danger" v-if="errors.bill_type">
              {{ errors.bill_type[0] }}</small
            >
          </div>

          <div class="col">
            <div class="form-group">
              <label for="invoice_date">Date</label>
              <input
                type="date"
                class="form-control"
                id="invoice_date"
                name="invoice_date"
                v-model="sale.date"
                :disabled="reportView"
              />
            </div>

            <small class="text-danger" v-if="errors.invoice_date">
              {{ errors.invoice_date[0] }}</small
            >
          </div>
        </div>

        <div class="row" v-if="vehiclecheck == 1">
          <div class="col">
            <div class="form-group">
              <label for="vehicle">Vehicle</label>
              <input
                type="text"
                class="form-control"
                placeholder="Enter Name"
                name="vehicle"
                v-model="sale.vehicle"
                :disabled="reportView"
              />
            </div>

            <small class="text-danger" v-if="errors.vehicle">
              {{ errors.vehicle[0] }}</small
            >
          </div>

          <div class="col">
            <div class="form-group">
              <label for="register_no">Register No</label>
              <input
                type="text"
                class="form-control"
                id="register_no"
                placeholder="Enter Number"
                name="register_no"
                v-model="sale.register_no"
                :disabled="reportView"
              />
            </div>

            <small class="text-danger" v-if="errors.register_no">
              {{ errors.register_no[0] }}</small
            >
          </div>
        </div>

        <hr />

        <div class="row" v-if="reportView == false">
          <div class="col">
            <button
              type="button"
              class="btn btn-secondary btn-sm rounded m-2"
              @click="showServiceCard()"
            >
              Add Service
            </button>

            <button
              type="button"
              class="btn btn-secondary rounded btn-sm m-2"
              @click="showSaleCard()"
            >
              Add Sale
            </button>
          </div>

          <div class="col" v-if="user == 1 && reportView == false">
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value="1"
                id="flexCheckDefault"
                v-model="gst_bill"
                @click="checkBox"
              />
              <label class="form-check-label" for="flexCheckDefault">
                GST Bill
              </label>
            </div>
          </div>
        </div>

        <!-- service row -->

        <div class="card" v-if="serviceShowCard">
          <div class="card-header">Service</div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="Service" class="required">Select Service</label>

                  <!-- service search component -->

                  <model-list-select
                    :list="this.serviceList"
                    v-model="saleItem"
                    name="service"
                    option-value="id"
                    :custom-text="service"
                    placeholder="select item"
                  >
                  </model-list-select>

                  <!-- service search component end-->
                </div>
                <small class="text-danger"> {{ saleItemErrorMessage }}</small>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="service_rate" class="required">Rate</label>
                  <input
                    type="number"
                    class="form-control"
                    name="service_rate"
                    min="0"
                    oninput="validity.valid||(value='');"
                    v-model="sale_rate_per_quantity"
                  />
                </div>

                <small class="text-danger"> {{ rateErrorMessage }}</small>
              </div>
            </div>

            <div class="row">
              <!-- gst slab  -->

              <div class="col" v-if="this.user == 1 && this.gst_bill == 1">
                <div class="form-group">
                  <label for="saleitem" class="required">Select GST Slab</label>

                  <!-- saleitem search component-->

                  <model-list-select
                    :list="this.gstList"
                    v-model="gst"
                    option-value="val"
                    :custom-text="gstSlab"
                    placeholder="select Gst"
                  >
                  </model-list-select>

                  <!-- saleitem search component end-->
                </div>
                <small class="text-danger"> {{ gstErrorMessage }}</small>
              </div>
              <!-- gst slab end -->

              <div class="col" v-if="this.user == 1 && this.gst_bill == 1">
                <div class="form-group">
                  <label for="discount">Discount</label>
                  <input
                    type="number"
                    class="form-control"
                    name="discount"
                    min="0"
                    oninput="validity.valid||(value='');"
                    v-model="discount"
                  />
                </div>

                <small class="text-danger"> {{ discountErrorMessage }}</small>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button
              type="button"
              class="btn rounded btn-primary"
              @click="addToArray()"
            >
              Add
            </button>
          </div>
        </div>
        <!-- service row  end-->

        <!-- sale row -->

        <div class="card" v-if="saleShowCard">
          <div class="card-header">Sale</div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="saleitem" class="required">Select Item</label>

                  <!-- saleitem search component-->

                  <model-list-select
                    :list="this.saleList"
                    v-model="saleItem"
                    option-value="id"
                    :custom-text="saleItemName"
                    placeholder="select item"
                  >
                  </model-list-select>

                  <!-- saleitem search component end-->
                </div>
                <small class="text-danger"> {{ saleItemErrorMessage }}</small>
              </div>

              <!-- gst slab  -->

              <div class="col" v-if="this.user == 1 && this.gst_bill == 1">
                <div class="form-group">
                  <label for="saleitem" class="required">Select GST Slab</label>

                  <!-- saleitem search component-->

                  <model-list-select
                    :list="this.gstList"
                    v-model="gst"
                    option-value="val"
                    :custom-text="gstSlab"
                    placeholder="select Gst"
                  >
                  </model-list-select>

                  <!-- saleitem search component end-->
                </div>
                <small class="text-danger"> {{ gstErrorMessage }}</small>
              </div>
              <!-- gst slab end -->
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="item_quantity">Quantity</label>
                  <input
                    type="number"
                    class="form-control"
                    name="item_quantity"
                    min="0"
                    oninput="validity.valid||(value='');"
                    v-model="saleQuantity"
                    @input="saleQuantityErrorMessage = ''"
                  />
                </div>

                <small class="text-danger" v-if="saleQuantityErrorMessage">
                  {{ saleQuantityErrorMessage }}</small
                >
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="rate_per_quantity" class="required"
                    >Rate per quantity</label
                  >
                  <input
                    type="number"
                    class="form-control"
                    name="rate_per_quantity"
                    min="0"
                    oninput="validity.valid||(value='');"
                    v-model="sale_rate_per_quantity"
                  />
                </div>

                <small class="text-danger"> {{ rateErrorMessage }}</small>
              </div>
              <div class="col" v-if="this.user == 1 && this.gst_bill == 1">
                <div class="form-group">
                  <label for="discount">Discount</label>
                  <input
                    type="number"
                    class="form-control"
                    name="discount"
                    min="0"
                    oninput="validity.valid||(value='');"
                    v-model="discount"
                  />
                </div>

                <small class="text-danger"> {{ discountErrorMessage }}</small>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button
              type="button"
              class="btn btn-primary rounded"
              @click="addToArray()"
            >
              Add
            </button>
          </div>
        </div>
        <!-- sale row  end-->

        <div class="row mt-4">
          <div class="col-md-12">
            <h5>Item Details</h5>
            <div class="table-responsive mt-3">
              <!--  -->
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>Index</th>
                          <th scope="col">Type</th>
                          <th scope="col">Item</th>
                          <th scope="col text-right">Quantity</th>
                          <th scope="col text-right">Rate</th>
                          <th
                            scope="col text-right"
                            v-if="this.user == 1 && this.gst_bill == 1"
                          >
                            GST
                          </th>
                          <th scope="col text-right">Total Rate</th>
                          <th
                            scope="col text-right"
                            v-if="this.user == 1 && this.gst_bill == 1"
                          >
                            Discount
                          </th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in sale.items" :key="item.id">
                          <td scope="row" class="trashIconContainer">
                            {{ index + 1 }}
                          </td>
                          <td>
                            <input
                              type="text"
                              class="form-control"
                              v-model="item.type"
                              disabled
                            />
                          </td>
                          <td>
                            <input
                              type="text"
                              class="form-control"
                              v-model="item.item_name"
                              disabled
                            />
                          </td>
                          <td>
                            <input
                              type="number"
                              min="1"
                              class="form-control text-right"
                              v-model="item.quantity"
                              disabled
                            />
                          </td>
                          <td>
                            <input
                              type="number"
                              min="1"
                              class="form-control text-right"
                              v-model="item.rate"
                              disabled
                            />
                          </td>

                          <td v-if="item.gst != ''">
                            <input
                              readonly="readonly"
                              type="number"
                              class="form-control text-right"
                              :value="item.gst"
                              disabled
                            />
                          </td>

                          <td>
                            <input
                              readonly="readonly"
                              type="number"
                              class="form-control text-right"
                              :value="item.rate * item.quantity"
                              disabled
                            />
                          </td>

                          <td v-if="item.gst != ''">
                            <input
                              readonly="readonly"
                              type="number"
                              class="form-control text-right"
                              :value="item.discount"
                              disabled
                            />
                          </td>

                          <td scope="row" class="trashIconContainer">
                            <i
                              class="far fa-trash-alt"
                              @click="removeFromArray(index)"
                            ></i>
                          </td>
                        </tr>

                        <tr v-if="this.sale.items.length == 0">
                          <td
                            colspan="9"
                            v-if="this.user == 1 && this.gst_bill == 1"
                          >
                            <p class="text-center light-danger p-2">
                              No products added/available.
                            </p>
                          </td>
                          <td colspan="7" v-else>
                            <p class="text-center light-danger p-2">
                              No products added/available.
                            </p>
                          </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr v-if="this.sale.items.length != 0">
                          <td
                            colspan="7"
                            class="text-right"
                            v-if="this.user == 1 && this.gst_bill == 1"
                          >
                            Total Discount &#x20b9;:
                          </td>
                          <td colspan="5" class="text-right" v-else>
                            Total Discount &#x20b9;:
                          </td>

                          <td class="text-right" style="width: 250px">
                            <input
                              v-if="
                                this.user == 1 && this.gst_bill == 1
                                  ? (sale.total_discount = netdiscount)
                                  : ''
                              "
                              type="number"
                              class="form-control text-right"
                              min="0"
                              oninput="validity.valid||(value='');"
                              v-model="sale.total_discount"
                              :disabled="reportView"
                            />

                            <input
                              v-else
                              type="number"
                              class="form-control text-right"
                              min="0"
                              oninput="validity.valid||(value='');"
                              v-model="sale.total_discount"
                              :disabled="reportView"
                            />
                          </td>
                        </tr>
                        <tr v-if="this.sale.items.length != 0">
                          <td
                            colspan="7"
                            class="text-right"
                            v-if="this.user == 1 && this.gst_bill == 1"
                          >
                            Net Pay &#x20b9;:
                          </td>
                          <td colspan="5" class="text-right" v-else>
                            Net Pay &#x20b9;:
                          </td>

                          <td class="text-right">
                            <span class="paymentclass">
                              {{ netPayAmout - sale.total_discount }}/-</span
                            >
                          </td>
                        </tr>
                        <!-- <tr>
                          <td colspan="5" class="text-right">Total</td>
                          <td class="text-right">0.00</td>
                        </tr> -->
                      </tfoot>
                    </table>
                  </div>
                </div>

                <div class="col-md-12" v-if="this.sale.bill_type == 2">
                  <div class="form-group">
                    <label for="payment_type">Select Payment Type</label>
                    <select
                      class="form-control"
                      v-model="sale.pay_type"
                      name="pay_type"
                      :disabled="reportView"
                      @change="payTypeErrorMessage = ''"
                    >
                      <option value="">Select Type</option>

                      <option value="Cash">Cash</option>
                      <option value="Bank">Bank</option>
                    </select>
                  </div>
                  <small class="text-danger" v-if="payTypeErrorMessage != ''">
                    {{ payTypeErrorMessage }}</small
                  >
                </div>
              </div>
              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!----------------SALE BILL RECIEPT PDF   START------------------------>
    <!--  <div class="p-2" style="display: none" id="pdfGenerateSales">
      <div id="sale_bill_canvas_pdf">
<div class="text-center">
<h5>Tax Invoice</h5>
</div>

        <h6>Invoice no : {{ forBillReciept.bill_inovoice_no }}</h6>
        <br />
        <h6>Bill Date : {{ forBillReciept.bill_date | myDate }}</h6>
        <br />
        <h6>Customer Name : {{ forBillReciept.bill_name }}</h6>
        <br />
        <h6>Bill Type : {{ forBillReciept.bill_type }}</h6>
        <br />
        <h6>Vehicle : {{ forBillReciept.bill_vehicle }}</h6>
        <br />
        <h6>Register Number : {{ forBillReciept.bill_vehicle_reg_no }}</h6>
        <br />
        <h6>Total Bill Amount : {{ forBillReciept.bill_total_amount }}</h6>
        <br />
        <h6>Discount : {{ forBillReciept.bill_total_discount }}</h6>
        <br />
        <h6>Amount To Pay : {{ forBillReciept.bill_net_pay }}</h6>
        <br />

        <tr v-for="item in forBillReciept.billItems" :key="item.id">
          {{
            item.item_name
          }}<br />
          {{
            item.quantity
          }}
          {{
            "  --Quantity "
          }}<br />
          {{
            item.rate
          }}{{
            "  --Rate "
          }}
          <hr />
        </tr>
      </div>
      <div class="col-md-12 text-center">
        <button
          @click.prevent="clickPdf()"
          class="btn btn-dark rounded-pill btn-sm"
        >
          Download Reciept <i class="fas fa-download fa-fw"></i>
        </button>
      </div>
    </div>-->
    <!----------------SALE BILL RECIEPT PDF   END------------------------>

    <div class="modal-footer" v-if="reportView == false">
      <!--<button
            @click.prevent="clear_reciept()"
            class="btn btn-dark rounded-pill"
            id="clear-and-close-button"
            style="display:none;"
          >
            {{ 'Close' }} <i class="fas fa-times fa-fw"></i>
          </button>-->

      <button
        type="button"
        class="btn btn-primary rounded-pill"
        @click="addSale()"
        id="add-sale-button"
        :disabled="loading"
      >
        {{ button_title }}
        <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
      </button>
    </div>
  </div>
</template>
<script>
import html2pdf from "html2pdf.js";
import { ModelListSelect } from "vue-search-select";
export default {
  components: {
    ModelListSelect,
  },
  props: ["edit", "viewOnly", "usergst", "vehicle"],
  data() {
    return {

  newCustom:false,


name:'',
mobile:'',
gst_no:'',




loading:false,
      user: this.usergst,
      vehiclecheck: this.vehicle,
      title: "Add Sale",
      toastTitle: "sale added successfully",
      saleShowCard: false,
      serviceShowCard: false,
      sale_rate_per_quantity: "",
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
      gst: "",
      gst_bill: "",
      gstErrorMessage: "",
      discount: "0",
      discountErrorMessage: "",
      saleItem: "",
      saleQuantity: "1",
      saleItemErrorMessage: "",
      rateErrorMessage: "",
      saleQuantityErrorMessage: "",
      payTypeErrorMessage: "",
      saleList: [],
      serviceList: [],
      product_list: [],
      customer_list: [],
customer:[],
      sale: {
        id: "",
        customer_id:'',
name:'',
mobile:'',
gst_no:'',
        bill_type: "",
        vehicle: "",
        register_no: "",
        date: "",
        total_discount: "0",
        gst_bill: "",
        pay_type: "",

        items: [],
      },
      reportView: false,

      errors: {},
    };
  },


  created() {
    this.getProduct();
    this.getcustomer();


    if (this.edit) {
      var _this = this;

      _this.title = "Edit Sale";
      _this.toastTitle = "Sale updated successfully";
      bus.$on("edit-sale", function (sale) {


        _this.clearField();
        _this.showItemList(sale);
      });
    }

    if (this.viewOnly) {
      var _this = this;
      this.user = 1;
      this.vehicle = 1;
      _this.reportView = true;
      _this.title = "Sale Card";
      _this.toastTitle = "Sale updated successfully";
      bus.$on("view-sale", function (sale) {
        _this.clearField();
        _this.showItemList(sale);

        //
      });
    }
  },

mounted(){


},
  methods: {
 addTag (newTag) {
this.newCustom=true;

      this.sale.name=newTag;
this.sale.customer_id='';
this.customer=[];

    },
    addSale() {
      if (this.sale.items.length == 0) {
        Toast.fire({
          icon: "error",
          title: " No products added",
        });

        return false;
      }

      if (this.user == 1 && this.gst_bill == 1) {
        this.sale.gst_bill = " 1";
      } else {
        this.sale.gst_bill = "0";
      }

      if (this.sale.bill_type == 2 && this.sale.pay_type == "") {
        this.payTypeErrorMessage = "This field required";
        return false;
      }
		this.loading=true;

      axios
        .post("/admin/add-sale", this.sale)
        .then((response) => {
          Toast.fire({
            icon: "success",
            title: this.toastTitle,
          });

          this.$refs.close_sale_modal.click();
          this.clear_form_data();
          bus.$emit("sale-added");
		  this.loading=false;
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
			this.loading=false;
        });
    },

    getProduct() {
      axios
        .get("/admin/get-products")
        .then((response) => {
          this.product_list = response.data;

          if (this.product_list.length != 0) {
            for (let item in this.product_list) {
              if (this.product_list[item].category_id == "1") {
                this.saleList.push({
                  category: this.product_list[item].category,
                  category_id: this.product_list[item].category_id,
                  created_at: this.product_list[item].created_at,
                  deleted_at: this.product_list[item].deleted_at,
                  id: this.product_list[item].id,
                  name: this.product_list[item].name,
                  opening_quantity: this.product_list[item].opening_quantity,
                  quantity: this.product_list[item].quantity,
                  reward_points: this.product_list[item].reward_points,
                  updated_at: this.product_list[item].updated_at,
                  user_id: this.product_list[item].user_id,
                });
              }

              if (this.product_list[item].category_id == "3") {
                this.serviceList.push({
                  category: this.product_list[item].category,
                  category_id: this.product_list[item].category_id,
                  created_at: this.product_list[item].created_at,
                  deleted_at: this.product_list[item].deleted_at,
                  id: this.product_list[item].id,
                  name: this.product_list[item].name,
                  opening_quantity: this.product_list[item].opening_quantity,
                  quantity: this.product_list[item].quantity,
                  reward_points: this.product_list[item].reward_points,
                  updated_at: this.product_list[item].updated_at,
                  user_id: this.product_list[item].user_id,
                });
              }
            }
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getcustomer() {
      axios
        .get("/admin/get-customers")
        .then((response) => {
          this.customer_list = response.data;


// this.sale.customer_id=this.customer_list.find(option=>option.id== '1');




        })
        .catch((err) => {
          console.log(err);
        });
    },

    addToArray() {
      if (this.user == 1 && this.gst_bill == 1) {
        if (
          this.saleItem == "" ||
          this.sale_rate_per_quantity == "" ||
          this.gst == "" ||
          this.discount == ""
        ) {
          if (this.saleItem == "") {
            this.saleItemErrorMessage = "This field required";
          }

          if (this.sale_rate_per_quantity == "") {
            this.rateErrorMessage = "This field required";
          }

          if (this.gst == "") {
            this.gstErrorMessage = "This field required";
          }

          if (this.discount == "") {
            this.discountErrorMessage = "This field required";
          }

          return false;
        }
      } else if (this.user == 1 && this.gst_bill == 0) {
        if (this.saleItem == "" || this.sale_rate_per_quantity == "") {
          if (this.saleItem == "") {
            this.saleItemErrorMessage = "This field required";
          }

          if (this.sale_rate_per_quantity == "") {
            this.rateErrorMessage = "This field required";
          }

          return false;
        }
      } else if (this.user == 0) {
        if (this.saleItem == "" || this.sale_rate_per_quantity == "") {
          if (this.saleItem == "") {
            this.saleItemErrorMessage = "This field required";
          }

          if (this.sale_rate_per_quantity == "") {
            this.rateErrorMessage = "This field required";
          }

          return false;
        }
      }

      var id = this.saleItem;

      var type;
      var category_id;
      var product_id;
      var item_name;

      for (let product in this.product_list) {
        if (this.product_list[product].id == id) {
          if (
            this.saleQuantity > parseInt(this.product_list[product].quantity)
          ) {
            this.saleQuantityErrorMessage =
              "The requested quantity is not available";
            return false;
          }

          type = this.product_list[product].category.name;
          category_id = this.product_list[product].category.id;
          product_id = this.product_list[product].id;
          item_name = this.product_list[product].name;

          if (this.user == 1 && this.gst_bill == 1) {
            this.sale.items.push({
              type: type,
              item_name: item_name,

              category_id: category_id,
              product_id: product_id,
              quantity: this.saleQuantity,
              rate: this.sale_rate_per_quantity,
              gst: this.gst,
              discount: this.discount,
            });
          } else {
            this.sale.items.push({
              gst: "",
              type: type,
              item_name: item_name,

              category_id: category_id,
              product_id: product_id,
              quantity: this.saleQuantity,
              rate: this.sale_rate_per_quantity,
            });
          }

          this.gst = "";
          this.discount = "0";
          this.saleQuantity = "1";
          this.sale_rate_per_quantity = "";
          this.saleItem = "";
          this.rateErrorMessage = "";
          this.saleItemErrorMessage = "";
          this.saleQuantityErrorMessage = "";
          this.gstErrorMessage = "";
          this.discountErrorMessage = "";
          this.payTypeErrorMessage = "";
        }
      }
    },

    removeFromArray(index) {
      if (this.reportView) {
        return false;
      }

      this.sale.items.splice(index, 1);
    },

    showItemList(sale) {
      this.sale.id = sale.id;
      this.gst_bill = sale.gst_bill;
      this.sale.customer_id = sale.customer_id;
      this.sale.bill_type = sale.bill_type;
      this.sale.vehicle = sale.vehicle;
      this.sale.register_no = sale.register_no;
      this.sale.date = sale.invoice_date;
      this.sale.total_discount = parseFloat(sale.total_discount);

      var salesItem = sale.items;

      for (let item in salesItem) {
        var id = salesItem[item].product_id;
        var rate = salesItem[item].rate;
        var quantity = salesItem[item].quantity;

        var gst = salesItem[item].gst;
        var discount = salesItem[item].discount;

        var type;
        var category_id;
        var product_id;
        var item_name;

        for (let product in this.product_list) {
          if (this.product_list[product].id == id) {
            type = this.product_list[product].category.name;
            category_id = this.product_list[product].category.id;
            product_id = this.product_list[product].id;
            item_name = this.product_list[product].name;

            if (this.user == 1 && sale.gst_bill == 1) {
              this.sale.items.push({
                type: type,
                item_name: item_name,

                category_id: category_id,
                product_id: product_id,
                quantity: quantity,
                rate: rate,

                gst: gst,
                discount: discount,
              });
            } else {
              this.sale.items.push({
                gst: "",
                type: type,
                item_name: item_name,

                category_id: category_id,
                product_id: product_id,
                quantity: quantity,
                rate: rate,
              });
            }

            // ##################################################
          }
        }
      }
    },

    showSaleCard() {
      this.saleShowCard = !this.saleShowCard;

      this.serviceShowCard = false;

      this.rateErrorMessage = "";
      this.saleItemErrorMessage = "";
      this.saleQuantityErrorMessage = "";
      this.saleQuantity = "1";
      this.sale_rate_per_quantity = "";
      this.saleItem = "";
      this.discount = "0";
      this.gst = "";
      this.gstErrorMessage = "";
      this.discountErrorMessage = "";
      this.payTypeErrorMessage = "";
    },

    showServiceCard() {
      this.serviceShowCard = !this.serviceShowCard;
      this.saleShowCard = false;
      this.rateErrorMessage = "";
      this.saleItemErrorMessage = "";
      this.saleQuantityErrorMessage = "";
      this.sale_rate_per_quantity = "";
      this.saleItem = "";
      this.discount = "0";
      this.gst = "";
      this.gstErrorMessage = "";
      this.discountErrorMessage = "";
      this.payTypeErrorMessage = "";
    },

    clear_form_data() {


      if (this.viewOnly == false) {
        document.getElementById("add-sale-button").style.display = "block";
        // document.getElementById("clear-and-close-button").style.display = "none";
      }



      this.saleShowCard = false;
      this.serviceShowCard = false;
      this.sale_rate_per_quantity = "";

      this.saleItem = "";
      this.saleQuantity = "1";
      this.clearField();

      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },

    clearField() {
      this.sale.id = "";
      this.sale.customer_id = "";
      this.sale.bill_type = "";
      this.sale.vehicle = "";
      this.sale.register_no = "";
      this.sale.date = "";
      this.sale.total_discount = "0";
      this.sale.gst_bill = "";

      this.sale.items = [];
    },

    checkBox() {
      this.sale.items = [];
    },

    // search component functions

    customerNameAndMobile(item) {
      return `${item.name} - ${item.mobile} `;
    },

    service(item) {
      return `${item.name}`;
    },

    saleItemName(item) {
      return `${item.name}`;
    },
    gstSlab(item) {
      return `${item.name}`;
    },

    // search component functions ends
  },

  computed: {
    netPayAmout: function () {
      if (this.sale.items != []) {
        var sum = 0;
        this.sale.items.forEach((e) => {
          sum += parseFloat(e.rate) * parseInt(e.quantity);
        });
        return sum;
      }
    },

    button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Save Changes";
      }
    },

    netdiscount: function () {
      if (this.user == 1 && this.gst_bill == 1) {
        if (this.sale.items != []) {
          var sum = 0;
          this.sale.items.forEach((e) => {
            sum += parseFloat(e.discount);
          });
          return sum;
        }
      }
    },
  },

  watch: {
    saleItem: function () {
      if (this.saleItem != "") {
        this.saleItemErrorMessage = "";

        for (let item in this.product_list) {
          if (this.product_list[item].id == this.saleItem) {
            if (this.product_list[item].mrp != null) {
              this.sale_rate_per_quantity = this.product_list[item].mrp;
            }

            if (this.product_list[item].gst != null) {
              this.gst = parseFloat(this.product_list[item].gst);

            }
          }

          //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        }
      }
    },

    sale_rate_per_quantity: function () {
      if (this.sale_rate_per_quantity != "") {
        this.rateErrorMessage = "";
      }
    },


customer:function(){

if(this.customer!=null){
this.sale.customer_id=this.customer.id;
console.log(this.sale.customer_id);

}

},

  },
};
</script>


<style scoped>

.trashIconContainer {
  vertical-align: middle !important;
  padding-top: 10px;
  text-align: center;
}

.paymentclass {
  font-weight: bold;
  color: black;
}
</style>

