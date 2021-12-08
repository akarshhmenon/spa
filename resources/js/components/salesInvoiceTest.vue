<template>
  <div>

    <div class="modal-header bg-primary">
      <h5 class="modal-title modal-title-custom" id="salesinvoicelabel">
        {{ "Sale Invoice" }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        @click="clearInvoice()"
      >
        <span aria-hidden="true" class="modal-title-custom">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="text-right">
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

      <!---GST INVOICE START-->

      <div class="container" v-if="gst_bill == 1">
        <div id="canvas_div_pdf">

 <div id="thermal-bill">
<div class="row">

<div class="col">

 <b>{{ companyDetails.name }}</b> <br />
                  {{ companyDetails.address_1 }}<br />
                  {{ companyDetails.address_2 }}<br />
                  {{ companyDetails.district }} - {{ companyDetails.pincode
                  }}<br />
                  {{ companyDetails.state }}<br />

                  Ph: {{ companyDetails.mobile_1 }} /
                  {{ companyDetails.mobile_2 }}<br />
</div>

<div class="col ">
<div class="float-right">
  Invoice No. :
                  <b>{{ invoice_no }}</b
                  ><br />
                  Bill Type. :
                  <span v-if="bill_type == 1"
                    ><b>{{ "Credit" }}</b></span
                  >
                  <span v-if="bill_type == 2"
                    ><b>{{ "Cash" }}</b></span
                  ><br>

 <b>Customer Details:</b> <br />
                   {{billCustomer.name }} <br />
                    {{ billCustomer.mobile }} <br />
 <span v-if="billCustomer.gst_no !== null"
                    >GSTIN/UIN :{{ billCustomer.gst_no }}</span
                  >
</div>
</div>

</div><!--row end-->

  <table class="table table-sm " id="thermal-table">
                    <thead>
                        <tr>
                            <th>sl.no</th>
                            <th>Item</th>
                            <th class="">Rate</th>
                            <th class="">Qty</th>
<th class="">Total</th>
                        </tr>
                    </thead>
                    <tbody>

       <tr v-for="(item, index) in billItems" :key="item.id">
                <td >{{ index + 1 }}</td>

                <td>
                  {{ item.item_name }}
                </td>
<td>
                  {{ item.rate }}
                </td>
                <td >
                  {{ item.quantity }}
                </td>

                <td >
                  {{ item.total_rate }}
                </td>
              </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td colspan="5" align="right" class="mt-1">
                            <p>
                                Total Taxable Amount: {{ total_taxable_amount }} <br>


                                Total SGST:{{ total_sgst}} <br>
Total CGST:{{ total_cgst}} <br>
Total Amount:{{ total_amount}} <br>
Total Discount:{{ total_discount}} <br>
<strong>Net Amount:{{ pay_amount}} </strong></p>
                          </td>

                        </tr>
                    </tbody>

                </table>

<div class="text-center ">
    Thank You <!--Padding is optional-->
</div>

        </div><!--thermal id end-->


          <div class="text-center">
            <h6>GST Invoice</h6>
          </div>

          <img
            class="d-block img-fluid"
            :src="'/images/' + companyDetails.logo"
            alt="logo"
            style="width: 80px"
          />

          <!--{{ billItems }}-->
          <table
            class="table table-bordered mb-5"
            width="100%"
            style="margin-bottom: 0"
          >
            <tbody>
              <tr>
                <td colspan="9">
                  <b>{{ companyDetails.name }}</b> <br />
                  {{ companyDetails.address_1 }}<br />
                  {{ companyDetails.address_2 }}<br />
                  {{ companyDetails.district }} - {{ companyDetails.pincode
                  }}<br />
                  {{ companyDetails.state }}<br />

                  Ph: {{ companyDetails.mobile_1 }} /
                  {{ companyDetails.mobile_2 }}<br />
                </td>
                <td colspan="2" class="w-25">
                  Invoice No. :
                  <b>{{ invoice_no }}</b
                  ><br />
                  Bill Type. :
                  <span v-if="bill_type == 1"
                    ><b>{{ "Credit" }}</b></span
                  >
                  <span v-if="bill_type == 2"
                    ><b>{{ "Cash" }}</b></span
                  >

                  <br />
                  <br />
                </td>
                <td colspan="3">
                  Dated:
                  <b>{{ invoice_date | myDate }}</b>
                  <br />
                  <br />
                </td>
              </tr>

              <tr>
                <td colspan="14">
                  Customer Details: <br />
                  <b>{{ billCustomer.name }}</b> <br />
                  {{ billCustomer.mobile }} <br />

                  <span v-if="billCustomer.gst_no !== null"
                    >GSTIN/UIN :{{ billCustomer.gst_no }}</span
                  >

                  <br />
                </td>
              </tr>
            </tbody>

            <tr class="">
              <td class="items-tr-h">SL No.</td>
              <td colspan="3" class="items-tr-h">Item Details</td>
              <td class="items-tr-h">QTY</td>
              <td class="items-tr-h">Taxable Value</td>
              <td class="items-tr-h">SGST (%)</td>
              <td class="items-tr-h">SGST Amount</td>
              <td class="items-tr-h">CGST (%)</td>
              <td class="items-tr-h">CGST Amount</td>
              <td class="items-tr-h">CESS (%)</td>
              <td class="items-tr-h">CESS Amount</td>
              <td class="items-tr-h">Total Tax Amount</td>
              <td class="items-tr-h">Total Amount</td>
            </tr>

            <tr v-for="(item, index) in billItems" :key="item.id">
              <td colspan="1" align="center" class="items-tr">
                <b>{{ index + 1 }}</b>
              </td>
              <td colspan="3" align="center" class="items-tr">
                <b>{{ item.item_name }}</b>
              </td>

              <td colspan="1" align="center" class="items-tr">
                <b>{{ item.quantity }}</b>
              </td>

              <td colspan="1" align="center" class="items-tr">
                <b>{{ item.taxable_value }}</b>
              </td>
              <td colspan="1" align="center" class="items-tr">
                <b>{{ item.gst / 2 }}</b>
              </td>
              <td colspan="1" align="center" class="items-tr">
                {{ item.sgst_amount }}
              </td>
              <td colspan="1" align="center" class="items-tr">
                {{ item.gst / 2 }}
              </td>
              <td colspan="1" align="center" class="items-tr">
                {{ item.cgst_amount }}
              </td>

              <td colspan="1" align="center" class="items-tr">0</td>

              <td colspan="1" align="center" class="items-tr">
                <b>0.00</b>
              </td>

              <td colspan="1" align="center" class="items-tr">
                <b>{{
                  parseFloat(item.sgst_amount) + parseFloat(item.cgst_amount)
                }}</b>
              </td>

              <td colspan="1" align="center" class="items-tr">
                <b>{{ item.total_rate }}</b>
              </td>
            </tr>

            <tr>
              <td class="items-tr"></td>
              <td colspan="3" class="items-tr"></td>

              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
              <td class="items-tr"></td>
            </tr>

            <tr>
              <td colspan="5" align="right" class="items-tr">
                <b>Total Amount (Rs.)</b>
              </td>
              <td colspan="1" align="right" class="items-tr">
                <b>{{ total_taxable_amount }}</b>
              </td>
              <td colspan="2" align="center" class="items-tr">
                <b>{{ total_sgst }}</b>
              </td>
              <td colspan="2" align="center" class="items-tr">
                <b>{{ total_cgst }}</b>
              </td>
              <td colspan="2" align="center" class="items-tr">
                <b>{{ total_cess }}</b>
              </td>
              <td colspan="1" align="right" class="items-tr">
                <b>{{ parseFloat(total_cgst) + parseFloat(total_sgst) }} </b>
              </td>
              <td colspan="1" align="right" class="items-tr">
                <b>{{ total_amount }}</b>
              </td>
            </tr>
            <tr>
              <td
                colspan="9"
                rowspan="7"
                align="center"
                class="align-middle items-tr"
              >
                <b>Grand Total:&nbsp;&nbsp;{{ total_pay_amount_words }}</b>
              </td>
              <td colspan="3" style="border: 0">Total Taxable Amount</td>
              <td colspan="2" align="right" style="border: 0">
                {{ total_taxable_amount }}
              </td>
            </tr>

            <tr>
              <td colspan="3" style="border: 0">Total SGST</td>
              <td colspan="2" align="right" style="border: 0">
                {{ total_sgst }}
              </td>
            </tr>

            <tr>
              <td colspan="3" style="border: 0">Total CGST</td>
              <td colspan="2" align="right" style="border: 0">
                {{ total_cgst }}
              </td>
            </tr>

            <tr>
              <td colspan="3" style="border: 0">Total Cess</td>
              <td colspan="2" align="right" style="border: 0">
                {{ total_cess }}
              </td>
            </tr>

            <tr>
              <td colspan="3" align="left" style="border: 0">Total Amount</td>
              <td colspan="2" align="right" style="border: 0">
                {{ total_amount }}
              </td>
            </tr>

            <tr>
              <td colspan="3" style="border: 0">Discount Amount</td>
              <td colspan="2" align="right" style="border: 0">
                {{ total_discount }}
              </td>
            </tr>
            <tr>
              <td colspan="3" class="border-bottom-only"><b>Net Amount</b></td>
              <td colspan="2" align="right" class="border-bottom-only">
                <b>{{ pay_amount }}</b>
              </td>
            </tr>

            <tr>
              <td colspan="10" class="items-tr"></td>
              <td colspan="4" class="items-tr text-center">
                <b>FOR {{ companyDetails.name }}</b>
              </td>
            </tr>
            <tr>
              <td colspan="10" class="items-tr"></td>
              <td colspan="4" class="items-tr text-left">
                <b>Signature:</b><br /><br />
                <b>Name:</b>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <!----GST INVOICE END------>

      <div v-if="gst_bill == 0">
        <div class="container">
          <div id="canvas_div_pdf">


   <div id="thermal-bill">
<div class="row">

<div class="col">

 <b>{{ companyDetails.name }}</b> <br />
                  {{ companyDetails.address_1 }}<br />
                  {{ companyDetails.address_2 }}<br />
                  {{ companyDetails.district }} - {{ companyDetails.pincode
                  }}<br />
                  {{ companyDetails.state }}<br />

                  Ph: {{ companyDetails.mobile_1 }} /
                  {{ companyDetails.mobile_2 }}<br />
</div>

<div class="col ">
  Invoice No. :
                  <b>{{ invoice_no }}</b
                  ><br />
                  Bill Type. :
                  <span v-if="bill_type == 1"
                    ><b>{{ "Credit" }}</b></span
                  >
                  <span v-if="bill_type == 2"
                    ><b>{{ "Cash" }}</b></span
                  ><br>

 <b>Customer Details:</b> <br />
                   {{' billCustomer.name' }} <br />
                    {{ 'billCustomer.mobile' }} <br />
{{ 'GST NO:8785655' }}
</div>

</div><!--row end-->

  <table class="table table-hover w-75" id="thermal-table">
                    <thead>
                        <tr>
                            <th>sl.no</th>
                            <th>Item</th>
                            <th class="text-center">Rate</th>
                            <th class="text-center">Qty</th>
<th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>

       <tr v-for="(item, index) in billItems" :key="item.id">
                <td >{{ index + 1 }}</td>

                <td>
                  {{ item.item_name }}
                </td>
<td>
                  {{ item.rate }}
                </td>
                <td >
                  {{ item.quantity }}
                </td>

                <td >
                  {{ item.total_rate }}
                </td>
              </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Total Taxable Amount: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong>$6.94</strong>
                            </p>
                            <p>
                                <strong>$6.94</strong>
                            </p></td>
                        </tr>

                    </tbody>
                </table>
<div style=" height: 1px; border-bottom: 1px solid black; text-align: center" class="w-75">
  <span style="font-size: 6px; background-color: #F3F5F6; padding: 0 1px;">
    Thank You <!--Padding is optional-->
  </span>
</div>
        </div><!--thermal id end-->




            <div class="text-center">
              <h6>Tax Invoice</h6>
            </div>

            <img
              class="d-block img-fluid"
              :src="'/images/' + companyDetails.logo"
              alt="logo"
              style="width: 80px"
            />

            <table
              class="table table-bordered mb-5"
              width="100%"
              style="margin-bottom: 0"
            >
              <tbody>
                <tr>
                  <td colspan="11">
                    <b>{{ companyDetails.name }}</b> <br />
                    {{ companyDetails.address_1 }}<br />
                    {{ companyDetails.address_2 }}<br />
                    {{ companyDetails.district }} - {{ companyDetails.pincode
                    }}<br />
                    {{ companyDetails.state }}<br />

                    Ph: {{ companyDetails.mobile_1 }} /
                    {{ companyDetails.mobile_2 }}<br />
                  </td>
                  <td colspan="2">
                    Invoice No. :
                    <b>{{ invoice_no }}</b
                    ><br />
                    Bill Type. :
                    <span v-if="bill_type == 1"
                      ><b>{{ "Credit" }}</b></span
                    >
                    <span v-if="bill_type == 2"
                      ><b>{{ "Cash" }}</b></span
                    >

                    <br />
                    <br />
                  </td>
                  <td colspan="2">
                    Dated :
                    <b>{{ invoice_date | myDate }}</b>
                    <br />
                    <br />
                  </td>
                </tr>

                <tr>
                  <td colspan="14">
                    Customer Details: <br />
                    <b>{{ billCustomer.name }}</b> <br />
                    {{ billCustomer.mobile }} <br />
                  </td>
                </tr>
              </tbody>

              <tr>
                <td class="items-tr-h" colspan="1">sl.no</td>

                <td class="items-tr-h" colspan="10" style="width: 300px">
                  Item Details
                </td>
                <td class="items-tr-h" colspan="1">Qty</td>
                <td class="items-tr-h" colspan="1">Value</td>
                <td class="items-tr-h" colspan="1">total amount</td>
              </tr>

              <tr v-for="(item, index) in billItems" :key="item.id">
                <td class="items-tr" colspan="1">{{ index + 1 }}</td>

                <td class="items-tr" colspan="10">
                  {{ item.item_name }}
                </td>
                <td class="items-tr" colspan="1">
                  {{ item.quantity }}
                </td>
                <td class="items-tr" colspan="1">
                  {{ item.rate }}
                </td>
                <td class="items-tr" colspan="1">
                  {{ item.total_rate }}
                </td>
              </tr>

              <tr>
                <td colspan="12" align="right" class="items-ftr">
                  <b>Total Amount (Rs.)</b>
                </td>

                <td colspan="2" align="right" class="items-ftr">
                  <b>{{ total_amount }}</b>
                </td>
              </tr>

              <tr>
                <td colspan="14" align="center" style="border: 0">
                  <b>Grand Total:&nbsp;&nbsp;{{ total_pay_amount_words }}</b>
                </td>
              </tr>

              <tr>
                <td colspan="12" align="left" style="border: 0">
                  Total Amount
                </td>
                <td colspan="2" align="right" style="border: 0">
                  {{ total_amount }}
                </td>
              </tr>

              <tr>
                <td colspan="12" style="border: 0">Discount Amount</td>
                <td colspan="2" align="right" style="border: 0">
                  {{ total_discount }}
                </td>
              </tr>
              <tr>
                <td colspan="12" style="border: 0"><b>Net Amount</b></td>
                <td colspan="2" align="right" style="border: 0">
                  <b>{{ pay_amount }}</b>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ToWords } from "to-words";

import html2pdf from "html2pdf.js";
export default {
  data() {
    return {
      printLoading: false,

      gst_bill: "",
      bill_type: "",
      invoice_date: "",
      invoice_no: "",
      pay_amount: "",
      total_amount: "",
      total_discount: "",
      total_pay_amount_words: "",

      total_sgst: "",
      total_cgst: "",
      total_cess: "",

      billCustomer: [],

      billItems: [],

      productNames: [],

      productsDataBill: "",

      totalTaxCalculate: [],
      companyDetails: {},
      company_id: 1,
    };
  },

  methods: {
    clickPdf() {
      var _this = this;
      _this.printLoading = true;
      var element = document.getElementById("canvas_div_pdf");

      var opt = {
        margin: 0.15,
        filename: "Invoice_" + _this.invoice_no,
        image: { type: "jpeg", quality: 4 },
        html2canvas: { scale: 4, logging: true },
        jsPDF: { unit: "in",   format: [3,10], orientation: "portrait" },
      };

      //

      var result = html2pdf()
        .set(opt)
        .from(element)
        .toPdf()
        .get("pdf")
        .then(function (pdf) {
          //  pdf.autoPrint();
          window.open(pdf.output("bloburl"), "_blank");
          _this.printLoading = false;
        });

      //  var result = html2pdf().from(element).set(opt).save();
    },

    getProductsBill() {
      axios
        .get("get-products")
        .then((response) => {
          this.productsDataBill = response.data;
        })
        .catch((err) => {});
    },

    getCompany() {
      axios
        .post("get-company", { company_id: this.company_id })
        .then((response) => {
          this.companyDetails = response.data;
        })
        .catch((err) => {});
    },

    clearInvoice() {
      this.billItems = [];
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
    this.getProductsBill();
    var _this = this;

    bus.$on("sale-invoice", function (sale) {
      // console.log(sale)
      _this.billCustomer = sale.customer;
      // _this.billItems=sale.items;
      _this.gst_bill = sale.gst_bill;
      _this.bill_type = sale.bill_type;
      _this.invoice_date = sale.invoice_date;
      _this.invoice_no = sale.invoice_no;
      _this.pay_amount = sale.pay_amount;
      _this.total_amount = sale.total_amount;
      _this.total_discount = sale.total_discount;

      //gst-bill
      _this.total_taxable_amount = sale.total_taxable_amount;
      _this.total_cgst = sale.total_cgst;
      _this.total_sgst = sale.total_sgst;
      _this.total_cess = sale.total_cess;

      const toWords = new ToWords({
        localeCode: "en-IN",
        converterOptions: {
          currency: true,
          ignoreDecimal: false,
          ignoreZeroCurrency: false,
          doNotAddOnly: false,
        },
      });
      _this.total_pay_amount_words = toWords.convert(sale.pay_amount);

      var salesItem = sale.items;

      for (let item in salesItem) {
        var id = salesItem[item].product_id;
        var rate = salesItem[item].rate;
        var quantity = salesItem[item].quantity;
        var total_rate = salesItem[item].total_rate;

        //GST-BILL
        var taxable_value = salesItem[item].taxable_amount;
        var gst = salesItem[item].gst;
        var sgst_amount = salesItem[item].sgst;
        var cgst_amount = salesItem[item].cgst;
        var total_cess = salesItem[item].total_cess;

        var product_id;
        var item_name;
        var total_rate;

        for (let product in _this.productsDataBill) {
          if (_this.productsDataBill[product].id == id) {
            product_id = _this.productsDataBill[product].id;
            item_name = _this.productsDataBill[product].name;

            _this.billItems.push({
              item_name: item_name,
              product_id: product_id,
              quantity: quantity,
              rate: rate,
              total_rate: total_rate,

              //GST-BILL
              taxable_value: taxable_value,
              gst: gst,
              sgst_amount: sgst_amount,
              cgst_amount: cgst_amount,
              total_cess: total_cess,
            });
          }
        }
      }
    });
  },
};
</script>
<style scoped>
td {
  font-size: 6px;
}

.container {
  color: black;
}
table.table-bordered {
  color: black;
  border: 1px solid black;
  margin-top: 20px;
}
table.table-bordered > thead > tr > th {
  border: 1px solid black;
}
table.table-bordered > tbody > tr > td {
  border: 1px solid black;
}
td {
  padding: 5px;
}
th {
  padding: 5px;
}
table {
  background-color: transparent;
}
table {
  border-spacing: 0;
  border-collapse: collapse;
}

.items-tr-h {
  border-bottom: 1px solid black;
  border-right: 1px solid black;
  border-left: 1px solid black;
  font-size: 6px;
}

.items-tr {
  border-bottom: 1px solid black;
  border-right: 1px solid black;
  border-left: 1px solid black;
  font-weight: bold;
  font-size: 6px;
  text-align: center;
}

.items-ftr {
  border-bottom: 1px solid black;
  border-right: 1px solid black;
  border-left: 1px solid black;
  font-weight: bold;
  font-size: 6px;
}

.border-bottom-only {
  border-bottom: 1px solid black;
  border-right: 0px;
  border-left: 0px;
  border-top: 0px;
}

#thermal-bill{
font-size: 5px;

color:black;

}

#thermal-table{
color:black;}


</style>
