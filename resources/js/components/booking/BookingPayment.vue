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
        ref="close_payment_modal"
        @click="clear_form_data()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <address>
              <strong>Billed To:</strong><br />
              <h3>{{ customer_name }}</h3>
              {{ customer_mobile }}<br />
            </address>
          </div>

          <hr />
        </div>

        <div class="row">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Service</th>

                  <th scope="col">Quantity</th>
                  <th scope="col">Rate</th>
                  <th scope="col">Total Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in this.item_list" :key="item.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.quantity }}</td>
                  <td>{{ item.rate }}</td>
                  <td>{{ item.rate * item.quantity }}</td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="table-borderless">
                  <td colspan="4" class="text-right pt-3">
                    Total Amount &#x20b9;:
                  </td>

                  <td class="text-right" style="width: 250px">
                    <span> {{ net_total_amount }}/- </span>
                  </td>
                </tr>

                <tr class="table-borderless">
                  <td colspan="4" class="text-right pt-3">
                    Total Discount &#x20b9;:
                  </td>

                  <td class="text-right" style="width: 250px">
                    <div class="form-group">
                      <input
                        type="number"
                        class="form-control bg-transparent text-right"
                        required="required"
                        name="discount"
                        min="0"
                        oninput="validity.valid||(value='');"
                        v-model="payment.total_discount"
                      />
                      <small class="text-danger" v-if="errors.discount">{{
                        errors.discount[0]
                      }}</small>
                    </div>
                  </td>
                </tr>
                <tr class="table-borderless">
                  <td colspan="4" class="text-right pt-3">
                    <strong>Pay Type &#x20b9;:</strong>
                  </td>
                  <td class="text-right">
                    <div class="form-group">
                      <select
                        class="form-control"
                        v-model="payment.pay_type"
                        name="pay_type"
                      >
                        <option value="">Select Type</option>

                        <option value="Cash">Cash</option>
                        <option value="Bank">Bank</option>
                      </select>
                      <small class="text-danger">{{ pay_type_error }}</small>
                      <small class="text-danger" v-if="errors.pay_type">
                        {{ errors.pay_type[0] }}</small
                      >
                    </div>
                  </td>
                </tr>
                <tr class="table-borderless">
                  <td colspan="4" class="text-right pt-3">
                    <strong>Total Payable Amount &#x20b9;:</strong>
                  </td>

                  <td class="text-right" style="width: 250px">
                    <strong>
                      <span>
                        {{ net_total_amount - payment.total_discount }}/-
                      </span></strong
                    >
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-primary rounded-pill"
        :disabled="loading"
        @click="addPayment()"
      >
        {{ button_title
        }}<i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "Add Payment",
      toastTitle: "Payment Added Successfully!",
      loading: false,
      item_list: [],
      customer_name: "",
      customer_mobile: "",
      pay_type_error: "",
      payment: {
        customer_id: "",
        booking_id: "",
        total_price: "",
        payable_amount: "",
        total_discount: "0",
        pay_type: "",
      },
      errors: {},
    };
  },

  created() {
    var _this = this;
    bus.$on("add-payment", function (payment) {
      _this.payment.customer_id = payment.customer.id;
      _this.payment.booking_id = payment.id;
      _this.customer_name = payment.customer.name;
      _this.customer_mobile = payment.customer.mobile;

      for (let item in payment.booked_items) {
        _this.item_list.push({
          name: payment.booked_items[item].product_and_service.name,
          quantity: payment.booked_items[item].quantity,
          rate: payment.booked_items[item].rate,
          total_amount:
            payment.booked_items[item].rate *
            payment.booked_items[item].quantity,
        });
      }
    });
  },

  methods: {
    addPayment() {
      console.log(this.net_total_amount);

      if (this.payment.pay_type == "") {
        this.pay_type_error = "This field required";

        return false;
      }
      this.payment.total_price = parseFloat(this.net_total_amount);
      this.payment.payable_amount =
        parseFloat(this.net_total_amount) -
        parseFloat(this.payment.total_discount);

      this.loading = true;
      axios
        .post("booking-payment", this.payment)
        .then((response) => {
          this.loading = false;
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: this.toastTitle,
            });
            bus.$emit("payment-added");
            this.$refs.close_payment_modal.click();
          }

          if (response.data == "failed") {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });

            this.$refs.close_payment_modal.click();
          }

          console.log(this.net_total_amount);
        })
        .catch((err) => {
          console.log(err);
        });
    },

    clear_form_data() {
      for (let item in this.payment) {
        this.payment[item] = "";
      }
      this.payment.total_discount = "0";
      for (let err in this.erros) {
        this.erros[err] = "";
      }
      this.item_list = [];
      this.customer_name = "";
      this.customer_mobile = "";
      this.pay_type_error = "";
    },
  },
  computed: {
    net_total_amount: function () {
      if (this.item_list != []) {
        var sum = 0;
        this.item_list.forEach((e) => {
          sum += parseFloat(e.rate) * parseFloat(e.quantity);
        });
        return sum;
      }
    },

    button_title() {
      if (this.loading == true) {
        return "processing..  ";
      } else {
        return "Pay Now";
      }
    },
  },
};
</script>

<style>
</style>