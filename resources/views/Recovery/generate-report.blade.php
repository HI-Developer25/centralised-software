<x-layout.app>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        .choices__item--choice {
  white-space: nowrap;
}
.choices__list--dropdown {
  top: 100% !important;
  bottom: auto !important;
  transform: none !important;
}
.choices__inner {
    background: white;
    border: 1px solid rgba(76, 79, 82, var(--border-opacity));
}
.choices {
    border: 1px solid rgba(76, 79, 82, var(--border-opacity));
}
input.choices__input.choices__input--cloned {
    background-color: white;
}
.choices__list {
  margin-bottom: 50px;
}

.choices[data-type*="select-one"].is-open {
  position: relative !important;
}

.status{
  width:15%
}
tr .print-status{
        border: none;
        border-radius: 25px;
        height: 25px;
        /* font-size:12px; */
        /* Other styles specific for printing */
 
}
tr th{
  font-size: 15px;
  font-weight: 400;
}
.table-dark, .table-dark>td, .table-dark>th{
  background-color: #41423c !important;
}

.table-sm td, .table-sm th{
  padding:2px;
}
p{
  margin:0;
  margin-bottom:1px;
}
.d-print{
  font-size:17px;
}
.d-print span{
  font-weight:bold;
}
.d-print{
  display:none;
}



    @media print {
        body * {
            visibility: hidden;
        }
        #reportResult, #reportResult * {
            visibility: visible;
        }
        #reportResult {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
      @page { 
        size: landscape; 
        margin: 0 auto;
  
      }
      *{
        background: #fff;
      }
      .content-wrapper{
        background: #fff;
      }
      .card{
        box-shadow: none;
    background: none;
      }
     
        form{
            display: none;
        }
        .card-header{
          display: none;
        }
        .card-footer{
            display: none;
            background: #fff;
          }
          .print-button{
            display:none;
          }
          .d-print{
            display:block !important;
          }
    /* td{
     background:red;
    } */
  
footer{
  display:none;
}

}
.choices__item--selectable[data-value='cleared']:not(.choices__item--choice) {
    background: #27241b !important;
    border: none;
}
.choices__item--selectable[data-value='level1']:not(.choices__item--choice) {
    background: #bbd5d2 !important;
    border: none;
    color: black;
}
.choices__item--selectable[data-value='level2']:not(.choices__item--choice) {
    background: #fef000 !important;
    border: none;
    color: black;
}
.choices__item--selectable[data-value='level3']:not(.choices__item--choice) {
    background: #ff9c07 !important;
    border: none;
    color: black;
}
.choices__item--selectable[data-value='level4']:not(.choices__item--choice) {
    background: #a60411 !important;
    border: none;
}
.choices__item--selectable[data-value='re-regularized']:not(.choices__item--choice) {
    background: #661416 !important;
    border: none;
}
.choices__item--selectable[data-value='Regular']:not(.choice__item--choice) {
    background: #e9ecef !important;
    border: none;
    color: black;
}

    </style>
    <div id="app" class="container px-6 mx-auto grid" stlye="overflow: auto;">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Recovery Report</h2>
        <div style="display: flex; column-gap: 10px;">
            
            <div style="width: 33.33%;">
                <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">Start Date</span>
                    <input v-model="start_date" type="date" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;"> Member's field is required </span>
                </label>
            </div>
            <div style="width: 33.33%;">
                <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">End Date</span>
                    <input v-model="end_date" type="date" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;"> Member's field is required </span>
                </label>
            </div>
            <div style="width: 33.33%;">
                <label for="status">
                    <span class="text-gray-700 dark:text-gray-400">Select Status: </span>
                    <select name="status[]" v-model="statuses" id="status" class="choices form-control label" multiple>
                        <option value="all">All</option>
                        <option value="Regular">Regular</option>
                        <option value="level1">Level 1 - Request For Payment</option>
                        <option value="level2">Level 2 - Payment Reminder Letter</option>
                        <option value="level3">Level 3 - Final notice</option>
                        <option value="level4">Level 4 - Membership Cancelled</option>
                        <option value="cleared">Cleared</option>
                        <option value="re-regularized">Re-regularized</option>
                    </select>
                </label>
            </div>
        </div>
        <div style="display: flex; column-gap: 5px;">
            <button @click="getData" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Generate Report
            </button>
            
            <button @click="printReport" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Print
            </button>
            
            <button @click="refresh" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Refresh
            </button>
        </div>

        <div id="reportResult" style="padding: 30px;" v-if="reports.length > 0 && !is_fetching">
        <div class="card" style="background:none; box-shadow:none; border: none !important;">
            <div class="card-body p-0">
                <div class="row my-3 date-print">
                    <div class="col-sm-4">
                        <table class="" style="width:100%">
                            <tr>
                                <td class="d-print"><span>Start Date: <span v-text="start_date"></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table class="" style="width:100%">
                            <tr>
                                <td class="d-print text-center"><span>End Date: </span><span v-text="end_date"></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table class="" style="width:100%">
                            <tr>
                                <td class="d-print text-right"><span>Select Status: </span><span v-text="statuses.join(', ')"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <table style="width:100%; height:20px;" class="mt-1">
                            <thead>
                                <tr>
                                    <th style="width:100%; text-align:center; font-size:12px; font-weight:600;">Total recovery Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border:2px solid #000; position-relative; bottom:0px;">
                                    <td style="width:100%; text-align:center; font-weight:600; font-size:13px; padding:5px; height:40px;" id="total-payable" v-text="sum.toLocaleString()"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-2">
                        <table style="width:100%; height:20px;" class="mt-1">
                            <thead>
                                <tr>
                                    <th style="width:100%; text-align:center; font-size:12px; font-weight:600;" colspan="2" >Total Installment paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border:2px solid #000; position-relative; bottom:0px;">
                                    <td style="width:30%; text-align:center; font-weight:600; font-size:13px; border:2px solid #000; padding:5px; height:40px;"></td>
                                    <td style="width:70%; text-align:center; font-weight:600; font-size:13px; padding:5px;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-5">
                        <table class="table-bordered table-sm my-3" style="width:100%; height:20px; border:none;">
                            <tr>
                                <td style="width:20%; background:#bbd5d2; padding:3px;">
                                    <h4 style="font-weight:600; font-size:12px; background:none;">Level 1</h4>
                                    <p style="font-size:11px; line-height: 10px; background:none;">Request for Payment</p>
                                </td>
                                <td style="width:20%; background:#fef000; padding:3px;">
                                    <h4 style="font-weight:600; font-size:12px; background:none;">Level 2</h4>
                                    <p style="font-size:11px; line-height: 10px; background:none;">Payment Reminder Letter</p>
                                </td>
                                <td style="width:20%; background:#ff9c07; padding:3px;">
                                    <h4 style="font-weight:600; font-size:12px; background:none;">Level 3</h4>
                                    <p style="font-size:11px; line-height: 10px; background:none;">Final notice</p>
                                </td>
                                <td style="width:20%; background:#a60411; padding:3px;">
                                    <h4 style="font-weight:600; font-size:12px; color:#fff; background:none;">Level 4</h4>
                                    <p style="font-size:11px; line-height: 10px; background:none; color:#fff;">Membership Cancelled</p>
                                </td>
                                <td style="width:20%; background:#661416; padding:3px;">
                                    <h4 style="font-weight:600; font-size:12px; color:#fff; background:none;">Level 5</h4>
                                    <p style="font-size:11px; line-height: 10px; background:none; color:#fff;">re-irregularized</p>
                                </td>
                                <td style="width:20%; font-size:12px; background:#27241b; color:#fff; padding:3px; text-align:center;" >Cleared</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-3">
                        <table style="width:100%;" class="my-4">
                            <tr style="border:2px solid #000; position-relative; bottom:0px;">
                                <td style="width:50%; text-align:center; font-weight:600; font-size:13px; border:2px solid #000; padding:5px; height:40px;">Approved By</td>
                                <td style="width:50%; text-align:center; font-weight:600; font-size:13px; padding:5px;height:40px;" ></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="table-dark">
                            <th>Serial #</th>
                            <th>Membership #</th>
                            <th>Member's name</th>
                            <th>Member's phone #</th>
                            <th>Alternate phone #</th>
                            <th>Recovery Amount</th>
                            <th>Levels</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr style="font-size:13px;" v-for="(report, index) in reports" :key="report.id">
                                <td v-text="index + 1"></td>
                                <td v-text="report.membership_number"></td>
                                <td v-text="report.member_name"></td>

                                <td v-if="report?.recovery_phone_number.length ?? null > 0" v-text="report.recovery_phone_number"></td>
                                <td v-else-if="report.phone_number?.replace('+', '').split(', ')[0]?.length ?? null > 0" v-text="report.phone_number?.replace('+', '').split(', ')[0]"></td>
                                <td v-else-if="report.phone_number?.replace('+', '').split(', ')[1]?.length ?? null > 0" v-text="report.phone_number?.replace('+', '').split(', ')[1]"></td>
                                <td v-else-if="report.alternate_ph_number.length > 0" v-text="report.alternate_ph_number.replace('+', '')"></td>
                                <td v-else>-</td>

                                <td v-if="report.alternate_ph_number?.replace('+', '')?.length ?? null > 0" v-text="report.alternate_ph_number?.replace('+', '')">&nbsp;</td>
                                <td v-else>-</td>
                                
                                <td class="text-right pe-2 latest_payable" v-text="report.recovery[0]?.payable.toLocaleString() ?? 'no updated'">no updated</td>

                                <td class="status">
                                    <input v-if="report.payment_status === 'level1'" class="form-control print-status" type="text" style="color: black; background-color: #bbd5d2;" value="Level 1" readonly>
                                    <input v-else-if="report.payment_status === 'level2'" class="form-control print-status" type="text" style="color: black; background-color: rgb(254, 240, 0);" value="Level 2" readonly>
                                    <input v-else-if="report.payment_status === 'level3'" class="form-control print-status" type="text" style="color: black; background-color: rgb(255, 156, 7);" value="Level 3" readonly>
                                    <input v-else-if="report.payment_status === 'level4'" class="form-control print-status" type="text" style="color: white; background-color: rgb(166, 4, 17);" value="Level 4" readonly>
                                    <input v-else-if="report.payment_status === 'level5'" class="form-control print-status" type="text" style="color: white; background-color: rgb(102, 20, 22);" value="Level 4" readonly>
                                    <input v-else-if="report.payment_status === 'cleared'" class="form-control print-status" type="text" style="color: white; background-color: rgb(39, 36, 27);" value="Level 4" readonly>
                                    <input v-else class="form-control print-status" type="text" style="color: black; background-color: #e9ecef;" value="Regular" readonly>
                                </td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
    <div v-else-if="is_fetching" style="display: flex; justify-content: center; margin-top: 30px;">
        <span class="loader big purple"></span>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/choices.min.js" integrity="sha512-7PQ3MLNFhvDn/IQy12+1+jKcc1A/Yx4KuL62Bn6+ztkiitRVW1T/7ikAh675pOs3I+8hyXuRknDpTteeptw4Bw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
         
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    start_date: "",
                    end_date: "",
                    sum: 0,
                    is_fetching: false,
                    fetched: true,
                    statuses: ["regular"],
                    reports: []
                }
            },
            mounted() {
                var selectStatesInputEl = document.querySelector('#status');
                console.log(selectStatesInputEl);

                if(selectStatesInputEl) {
                    const choices = new Choices("#status", {
                        itemSelectText: '',
                        removeItemButton: true,
                    }); 
                }
                    
                document.addEventListener('click', function (e) {
                    if (e.target.classList.contains('choices__item')) {
                        const value = e.target.getAttribute('data-value');
                        choices.removeActiveItemsByValue(value);
                    }
                });
            },
            methods: {
                refresh() {
                    this.start_date = "";
                    this.end_date = "";
                    this.reports = [];
                },
                async getData() {
                    if(!this.fetched) this.fetched = true;

                    const choice__data = document.querySelectorAll(".choices__item[aria-selected='true']");
                    this.statuses = [];
                    choice__data.forEach(data => {
                        this.statuses.push(data.dataset.value);
                    });
                    this.is_fetching = true;

                    const response = await axios.get(route("api.recovery.report"), {
                        params: {
                            start_date: this.start_date,
                            end_date: this.end_date,
                            statuses: this.statuses.join(",")
                        }
                    });
                    console.log(response);


                    this.is_fetching = false;
                    this.reports = response.data.data[0];
                    response.data.data[0].forEach(res => {
                        this.sum += res.recovery[0].payable;
                    })
                },
                printReport() {
                    window.print();
                }
            }
        }).mount("#app");
    </script>
    
    
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
</x-layout.app>