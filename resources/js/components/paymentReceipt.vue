<template>
  <div>
    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="paymentReceiptLabel">
        {{ "Payment Receipt" }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <!----Reciept area start*****************************-->
      <div class="float-right pb-4">
        <button
          @click.prevent="clickPdf()"
          class="btn btn-dark rounded-pill btn-sm"
          :disabled="printLoading"
        >
          {{ print_btn_title }}
          <i class="fas fa-print fa-fw" v-if="printLoading == false"></i
          ><i
            class="fas fa-spinner fa-spin fa-fw"
            v-if="printLoading == true"
          ></i>
        </button>
      </div>
      <div class="p-5">
        <div id="payment_receipt_pdf">
          <div class="container pt-3">
            <div class="row">
              <div class="col">
                <b>{{ companyData.name }}</b> <br />
                {{ companyData.address_1 }}<br />
                {{ companyData.address_2 }}<br />
                {{ companyData.district }} - {{ companyData.pincode }}
                {{ companyData.state }}<br />
                Ph: {{ companyData.mobile_1 }} / {{ companyData.mobile_2
                }}<br />
              </div>

              <div class="col">
                <img
                  class="d-block img-fluid ml-auto"
                  :src="'/images/' + companyData.logo"
                  alt="logo"
                  style="width: 150px"
                />
              </div>
            </div>
            <hr />

            <div class="row pt-2">
              <div class="col-md-12">
                <div class="row">
                  <!-- <div class="col-md-12 "> -->
                  <div class="col-auto">
                    <h6>Customer Name : {{ customerDetails.name }}</h6>
                  </div>

                  <div class="col-auto ml-auto">
                    <h6>Reciept No: {{ receipt_num }}</h6>
                    <h6>Date : {{ payment_date | myDate }}</h6>
                  </div>
                  <!-- </div> -->
                </div>
                <br />
                <div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>
                          <h6>Description</h6>
                        </th>
                        <th>
                          <h6>Amount</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="col-md-9">Amount Paid</td>
                        <td class="col-md-3">
                          <i class="fas fa-rupee-sign" area-hidden="true"></i>
                          {{ paid_amount }}
                        </td>
                      </tr>
                      <tr>
                        <td class="col-md-9">Payment Type</td>
                        <td class="col-md-3">
                          {{ pay_type }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div>
                  <div class="col-md-12">
                    <p class="float-right pt-3"><b>Signature</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-----reciept area end********************************-->
    </div>
  </div>
</template>

<script>
import html2pdf from "html2pdf.js";
export default {
  data() {
    return {
      printLoading: false,
      companyData: {},
      customerDetails: {},
      paid_amount: "",
      pay_type: "",
      receipt_num: "",
      payment_date: "",

      company_id: 1,
    };
  },

  methods: {
    getCompany() {
      axios
        .post("get-company", { company_id: this.company_id })
        .then((response) => {
          this.companyData = response.data;
        })
        .catch((err) => {});
    },

    clickPdf() {
      var _this = this;
      _this.printLoading = true;
      var element = document.getElementById("payment_receipt_pdf");

      var opt = {
        margin: 1,
        filename: "Receipt_" + this.receipt_num,
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 3, logging: true },
        jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
      };

      var result = html2pdf()
        .set(opt)
        .from(element)
        .toPdf()
        .get("pdf")
        .then(function (pdf) {
          window.open(pdf.output("bloburl"), "_blank");
          _this.printLoading = false;
        });
    },
  },
  computed: {
    print_btn_title() {
      if (this.printLoading == true) {
        return "Processing  ";
      } else {
        return "Print";
      }
    },
  },
  created() {
    this.getCompany();
    var _this = this;
    bus.$on("payment-receipt", function (payment) {
      _this.customerDetails = payment.customer;

      _this.paid_amount = payment.amount;
      _this.pay_type = payment.pay_type;
      _this.receipt_num = payment.id;
      _this.payment_date = payment.payment_date;
    });
  },
};
</script>
<style scoped>
#payment_receipt_pdf {
  color: rgb(20, 19, 19);
}

table {
  color: rgb(20, 19, 19);
}
</style>

