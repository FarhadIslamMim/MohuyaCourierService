<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Invoice </title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/backend/invoice/app.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/invoice/style.css') }}" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>

<body>
<div class="invoice-container-wrap">
    <div class="invoice-container">
        @if ($merchant_details)
            <main>
                <div class="as-invoice invoice_style1">
                    <div class="download-inner" id="download_section">
                        <header class="as-header header-layout1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="header-logo">
                                        <img src="{{ asset($setting->logo) }}" alt="" width="80px"
                                             height="80px">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h1 class="big-title">Invoice</h1>
                                </div>
                            </div>
                            <div class="header-bottom">
                                <div class="row align-items-center">
                                    <div class="col">
                                    </div>
                                    <div class="col-auto">
                                        <p class="invoice-number me-4"><b>Invoice No:
                                            </b>#0{{ $merchant_details->paymentInvoice ?? '' }}</p>
                                    </div>
                                    <div class="col-auto">
                                        <p class="invoice-date"><b>Date:
                                            </b>{{ date('d-m-Y', strtotime($merchant_details->updated_at ?? '')) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="row justify-content-between mb-4">
                            <div class="col-auto">
                                <div class="invoice-left">
                                    <b>Invoiced To:</b>
                                    <address>
                                        {{ $merchant_details->merchant->companyName ?? '' }}<br />
                                        {{ $merchant_details->merchant->pickLocation ?? '' }}<br />
                                    </address>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="invoice-right" style="width: 360px;">
                                    <b>Pay from:</b>
                                    <address>
                                        {{ $setting->name }}<br />
                                        {{ $setting->address }},<br />
                                    </address>
                                </div>
                            </div>
                        </div>
                        <table class="invoice-table">
                            <thead>
                            <tr style="font-size:0.85em; text-align: center;">
                                <th>Tracking ID</th>
                                <th>Customer  <br>Information</th>
                                <th>Parcel Type</th>
                                <th>Parcel Amount</th>
                                <th>Partial Return</th>
                                <th>Collected Amount</th>
                                <th>Cod Charge</th>
                                <th>Delivery Charge</th>
                                <th>Return Charge</th>
                                <th>Merchant Pay</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($results as $item)
                                <tr>
                                    <td class="text-center" width="10">{{ $item->trackingCode }} </td>
                                    <td width="10">
                                        {{ ucfirst($item->recipientName) }}
                                        <p class="m-0 text-muted">
                                            {{ $item->recipientAddress }}, <br> Phone :
                                            {{ $item->recipientPhone }}
                                        </p>
                                    </td>
                                    <td class="text-center" width="10">{{ $item->parcelStatus->title }} </td>
                                    <td class="text-center" width="10">{{ $item->cod }} </td>
                                    <td class="text-center" width="10">{{ $item->partial_return_amount }} </td>
                                    <td class="text-center" width="10">{{ $item->collected_amount }} </td>
                                    <td class="text-center" width="10">{{ $item->ccharge }} </td>
                                    <td class="text-center" width="10">{{ $item->deliveryCharge }} </td>
                                    <td class="text-center" width="10">
                                        @if($item->return_charge)
                                            {{ $item->return_charge }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-right" width="10">
                                        @if ($item->collected_amount)
                                            {{ $item->collected_amount - ($item->deliveryCharge + $item->ccharge) }}
                                        @else
                                            - {{ $item->return_charge + $item->deliveryCharge }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right"><b>Total = </b></td>
                                <td>
                                    <b><strong>{{ number_format($amounts->sum('cod'), 2) }}</strong></b>
                                </td>
                                <td>
                                    <b><strong>{{ number_format($amounts->sum('partial_return_amount'), 2) }}</strong></b>
                                </td>
                                <td>
                                    <b><strong>{{ number_format($amounts->sum('collected_amount'), 2) }}</strong></b>
                                </td>
                                <td>
                                    <b><strong>{{ number_format($data_value->sum('c_charge'), 2) }}</strong></b>
                                </td>
                                <td>
                                    <b><strong>{{ number_format($amounts->sum('deliveryCharge'), 2) }}</strong></b>
                                </td>
                                <td>
                                    <b> <strong>
                                            {{ number_format($amounts->sum('return_charge')) }}
                                        </strong></b>
                                </td>
                                <td>
                                    @php
                                        $totalAmount =  $amounts->sum('collected_amount') - ($amounts->sum('deliveryCharge') + $amounts->sum('return_charge') + $data_value->sum('c_charge'))
                                    @endphp
                                    <b><strong>{{ number_format($totalAmount,2) }}</strong></b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row justify-content-between">
                        </div>
                        <p class="invoice-note mt-3">
                            <b>NOTE: </b>This is computer generated receipt and does not require physical signature.
                        </p>
                        <div class="body-shape1">
                            <small>Developed by- One Point IT Solutions</small>
                        </div>
                    </div>
                </div>
            </main>
        @else
            <div class="alert alert-info">We didn't found any invoice for that merchant. Please go back</div>
        @endif
    </div>
</div>
</body>

</html>
