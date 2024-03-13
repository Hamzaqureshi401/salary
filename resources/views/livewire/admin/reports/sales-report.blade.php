<div>

    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$lang->data['sales_report'] ?? 'Sales Report'}}</strong></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-0">
                <div class="card-header p-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label>{{$lang->data['start_date'] ?? 'Start Date'}}</label>
                            <input type="date" class="form-control" wire:model="start_date">
                        </div>
                        <div class="col-md-3">
                            <label>{{$lang->data['end_date'] ?? 'End Date'}}</label>
                            <input type="date" class="form-control" wire:model="end_date">
                        </div>
                        <div class="col-md-3">
                            <label>{{$lang->data['order_type'] ?? 'Order Type'}}</label>
                            <select class="form-select" wire:model="order_type">
                                <option class="select-box" value="ALL">{{$lang->data['all_types'] ?? 'All Types'}}</option>
                                <option class="select-box" value="1">{{$lang->data['dining'] ?? 'Dinning'}}</option>
                                <option class="select-box" value="2">{{$lang->data['takeaway'] ?? 'Takeaway'}}</option>
                                <option class="select-box" value="3">{{$lang->data['delivery'] ?? 'Delivery'}}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <a href="#" class="btn btn-primary" wire:click='getData'>{{$lang->data['search'] ?? 'Search'}}</a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped table-sm table-bordered mb-0">
                        <thead class="bg-secondary-light">
                            <tr>
                                <th class="tw-2">{{$lang->data['sl'] ?? 'Sl'}}</th>
                                <th class="tw-10">{{$lang->data['order_Date'] ?? 'Order Date'}}</th>
                                <th class="tw-10">{{$lang->data['order_no'] ?? 'Invoice No'}}</th>
                                <th class="tw-20">{{$lang->data['customer'] ?? 'Customer'}}</th>
                                <th class="tw-20">{{$lang->data['order_details'] ?? 'Order Details'}}</th>
                                <th class="tw-20">{{$lang->data['payment_details'] ?? 'Payment Details'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{\Carbon\Carbon::parse($order->date)->format('d/m/Y')}}</td>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->customer_name_fn}}</td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="text-muted">
                                        {{$lang->data['order_type'] ?? 'Order Type'}}: {{$order->order_type_string}}
                                    </div>
                                    <div class="text-muted">
                                        @if($order->order_type == \App\Models\Order::DINING)
                                        {{$lang->data['table_no'] ?? 'Table No'}}: {{$order->table_no}}
                                        @endif
                                    </div>
                                    <div class="text-muted">
                                        {{$lang->data['order_status'] ?? 'Order Status'}}: {{$order->OrderStatusString($order->status)}}
                                    </div>
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="text-muted">
                                        {{$lang->data['total'] ?? 'Total'}}: {{getCurrency()}}{{number_format($order->total,2)}}
                                    </div>
                                    <div class="text-muted">
                                        {{$lang->data['paid'] ?? 'Paid'}}: {{getCurrency()}}{{number_format($order->payments->sum('amount'),2)}}
                                    </div>
                                    <strong>{{$lang->data['balance'] ?? 'Balance'}}: {{getCurrency()}}{{number_format(($order->total - $order->payments->sum('amount')),2)}}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($orders) == 0)
                        <x-no-data-component message="{{$lang->data['no_orders_found'] ?? 'No orders were found..'}}" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>