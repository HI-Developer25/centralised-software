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
        #reportResult {
            padding: 10px;
        }
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
    </style>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
    <div id="app" class="container px-6 mx-auto grid" style="overflow: auto;">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Recovery Report</h2>
        <div style="display: flex; column-gap: 10px;">
            
            <div style="width: 50%;">
                <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">From Date</span>
                    <input v-model="start_date" type="date" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;"> Member's field is required </span>
                </label>
            </div>
            <div style="width: 50%;">
                <label class="block text-sm" style="margin-bottom: 20px;">
                    <span class="text-gray-700 dark:text-gray-400">To Date</span>
                    <input v-model="end_date" type="date" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="shahmir ahsanullah">
                    <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;"> Member's field is required </span>
                </label>
            </div>
        </div>
        <div style="display: flex; column-gap: 5px;">
            <button @click="getData" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Filter
            </button>
            
            <button @click="printReport" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Print
            </button>
        </div>

        <div id="reportResult" style="margin-top: 10px;" v-show="reports.length > 0 && !is_fetching">
        <div class="card" style="background:none; box-shadow:none; border: none !important;">

            <h4 class="my-4 text-center">Payable vs Paid Line Chart</h4>
            <canvas id="payablePaidChart" ref="payablePaidChart"  width="800" height="400"></canvas>
            <h1 class="text-center" style="font-size: 20px; margin: 30px 30px;">Month-wise Totals</h1>
            <div class="card-body p-0">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="table-dark">
                            <th style="padding: 10px;">Year</th>
                            <th style="padding: 10px;">Month</th>
                            <th style="padding: 10px;">Total Current Month Payable</th>
                            <th style="padding: 10px;">Total Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="font-size:13px;" v-for="(report, index) in reports" :key="report.id">
                            <td v-text="report.year" style="padding: 10px;"></td>
                            <td v-text="months[report.month_num - 1]" style="padding: 10px;"></td>
                            <td v-text="Number(report.total_current_month_payable).toLocaleString()" style="padding: 10px;"></td>
                            <td v-text="Number(report.total_paid).toLocaleString()" style="padding: 10px;"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight: bold; padding: 10px; font-size: 13px;">Grand Totals</td>
                            <td style="font-size: 13px; padding: 10px;" v-text="total_current_month_payable"></td>
                            <td style="font-size: 13px; padding: 10px;" v-text="Number(total_paid).toLocaleString()"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
    <div v-show="is_fetching" style="display: flex; justify-content: center; margin-top: 30px;">
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
                    sum: "",
                    is_fetching: false,
                    fetched: true,
                    statuses: ["regular"],
                    reports: [],
                    total_current_month_payable: 0,
                    total_paid: 0,
                    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
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
                },
                async getData() {
                    this.is_fetching = true;
                    const response = await axios.get(route("api.recovery.monthly.report"), {
                        params: {
                            from_date: this.start_date,
                            to_date: this.end_date
                        }
                    });
                    this.reports = response.data.data[0];
                    this.total_current_month_payable = Number(response.data.data[1]).toLocaleString();
                    this.reports.forEach(report => {
                        this.total_paid += parseInt(report.total_paid);
                    })
                    
                    this.is_fetching = false;

                    this.drawChart(this.reports);
                },
                drawChart(reports) {
                    console.log(reports);
                    const total_payable = reports.map(report => report.total_payable);
                    const months = reports.map(report => this.months[report.month_num - 1])
                    const total_paid = reports.map(report => report.total_paid);
                    const total_current_month_payable = reports.map(report => report.total_current_month_payable);
                    
                       if (months.length > 0) {
                        const ctx = document.getElementById('payablePaidChart').getContext('2d');
                        const chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [
                                    {
                                        label: 'Total Payable',
                                        data: total_payable,
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        fill: true,
                                        tension: 0.4
                                    },
                                    {
                                        label: 'Total Paid',
                                        data: total_paid,
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        fill: true,
                                        tension: 0.4
                                    },
                                    {
                                        label: 'Current Month Payable',
                                        data: total_current_month_payable,
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        fill: true,
                                        tension: 0.4
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Month'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Amount'
                                        },
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.raw.toLocaleString();
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                },
                printReport() {
                    window.print();
                }
            }
        }).mount("#app");
    </script>
    
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
</x-layout.app>