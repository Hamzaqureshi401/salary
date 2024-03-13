<div>

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['dashboard'] ?? 'Dashboard'}}</strong></h3>
        </div>
    </div>


<!--
    <div class="row box-height" x-data="initAlpine()">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{$lang->data['lifetime_orders'] ??'Lifetime Orders'}}</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-truck align-middle">
                                                <rect x="1" y="3" width="15" height="13">
                                                </rect>
                                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{\App\Models\Order::count()}}</h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{$lang->data['today_order'] ??'Today Order'}}</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-users align-middle">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{\App\Models\Order::whereDate('date',\Carbon\Carbon::today())->count()}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{$lang->data['today_sale'] ??'Today Sale'}}</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-dollar-sign align-middle">
                                                <line x1="12" y1="1" x2="12" y2="23">
                                                </line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{getCurrency()}}{{\App\Models\Order::whereDate('date',\Carbon\Carbon::today())->sum('total')}}</h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{$lang->data['total_customer'] ??'Total Customer'}}</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-shopping-cart align-middle">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path
                                                    d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{\App\Models\Customer::count()}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{$lang->data['overview'] ??'Overview'}}</h5>
                </div>
                <div class="card-body text-center chart-holder">
                    <template x-if="showChart">
                        <div class="" id="chart"></div>
                    </template>
                    <template x-if="!showChart">
                        <div class="w-100 justify-content-center items-center">
                            <x-no-data-component message="{{$lang->data['no_data_found'] ?? 'No data was found..'}}" />
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <div class="row box-height">
        <div class="col-6">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{$lang->data['latest_orders'] ??'Latest Orders'}}</h5>
                </div>
                <div class="card-body p-2">
                    <table class="table table-striped table-sm table-bordered mb-0">
                        <thead>
                            <tr>

                                <th class="tw-10">{{$lang->data['order_no'] ??'Order Id'}}</th>
                                <th class="tw-20">{{$lang->data['customer'] ??'Customer'}}</th>
                                <th class="tw-10">{{$lang->data['order_type'] ??'Order Type'}}</th>
                                <th class="tw-10">{{$lang->data['amount'] ??'Amount'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestorders as $order)
                            <tr>
                                <td>{{$lang->data['order_no'] ??'Order ID'}}: {{$order->order_number}}</td>
                                <td>{{$order->customer_name_fn}}</td>
                                <td class="d-none d-xl-table-cell">
                                    <span class="badge {{$order->order_type_badge}}">{{$order->order_type_string}}</span>
                                </td>
                                <td><span class="badge {{$order->OrderStatusBadge('bg',($order->status))}}">{{$order->OrderStatusString($order->status)}}</span></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @if(count($latestorders) == 0)
                        <x-no-data-component message="{{$lang->data['no_data_found'] ?? 'No data was found..'}}" />
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{$lang->data['pending_orders'] ??'Pending Orders'}}</h5>
                </div>
                <div class="card-body p-2">
                    <table class="table table-striped table-sm table-bordered mb-0">
                        <thead>
                            <tr>

                                <th class="tw-10">{{$lang->data['order_no'] ??'Order Id'}}</th>
                                <th class="tw-20">{{$lang->data['customer'] ??'Customer'}}</th>
                                <th class="tw-10">{{$lang->data['order_type'] ??'Order Type'}}</th>
                                <th class="tw-10">{{$lang->data['amount'] ??'Amount'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingorders as $order)
                            <tr>
                                <td>{{$lang->data['order_no'] ??'Order ID'}}: {{$order->order_number}}</td>
                                <td>{{$order->customer_name_fn}}</td>
                                <td class="d-none d-xl-table-cell">
                                    <span class="badge {{$order->order_type_badge}}">{{$order->order_type_string}}</span>
                                </td>
                                <td><span class="badge {{$order->OrderStatusBadge('bg',($order->status))}}">{{$order->OrderStatusString($order->status)}}</span></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @if(count($pendingorders) == 0)
                        <x-no-data-component message="{{$lang->data['no_data_found'] ?? 'No data was found..'}}" />
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{asset('assets/js/apex/apexcharts.css')}}">
    @endpush
    <script src="{{asset('assets/js/apex/apexcharts.min.js')}}"></script>
    <script>
        function initAlpine()
        {
            return{
                showChart : false,
                async init()
                {
                    let allseries = [{{\App\Models\Order::whereStatus(\App\Models\Order::PENDING)->count()}}, {{\App\Models\Order::whereStatus(\App\Models\Order::COOKING)->count()}}, {{\App\Models\Order::whereStatus(\App\Models\Order::READY)->count()}}, {{\App\Models\Order::whereStatus(\App\Models\Order::COMPLETED)->count()}}]
                    let showdata  = false;
                    allseries.forEach((item) => {
                        if(item > 0)
                        {
                            showdata = true;
                        }
                    })
                    if(showdata == false)
                    {
                        allseries = []
                        return;
                    }
                    else{
                        this.showChart = true;
                    }
                    await this.$nextTick();
                    var options = {
                        chart: {
                            type: 'donut',
                            height: '150%',
                            width: '130%',
                           
                        },
                        noData: {
                            text: "There's no data",
                            align: 'center',
                            verticalAlign: 'middle',
                        },
                        series: allseries,
                        labels: ['{{$lang->data["pending"] ?? "Pending"}}', '{{$lang->data["cooking"] ?? "Cooking"}}', '{{$lang->data["ready"] ?? "Ready"}}', '{{$lang->data["completed"] ?? "Completed"}}'],
                        colors:['#fcb92c', '#8b1cbb', '#49c9a3', '#2106ed']
                    }
                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();
                }
            }
        }
    </script>
    
</div>
!-->