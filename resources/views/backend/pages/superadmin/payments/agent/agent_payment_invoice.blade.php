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
            @if ($agent_details)
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
                                            {{-- <div class="border-line"><img src="assets/img/bg/line_pattern.svg" alt="line" /></div> --}}
                                        </div>
                                        <div class="col-auto">
                                            <p class="invoice-number me-4"><b>Invoice No:
                                                </b>#0{{ $agent_details->agent_payment_invoice ?? '' }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <p class="invoice-date"><b>Date:
                                                </b>{{ date('d M Y', strtotime($agent_details->updated_at ?? '')) }}
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
                                            {{ $agent_details->agent->name ?? '' }}<br />
                                            {{ $agent_details->agent->phone ?? '' }}<br />
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
                                    <tr>
                                        <th>Order Info</th>
                                        <th>Tracking ID</th>
                                        <th>Parcel Type</th>
                                        <th>Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $item)
                                        <tr>
                                            <td width="250">
                                                {{ ucfirst($item->recipientName) }}
                                                <p class="m-0 text-muted">
                                                    {{ $item->recipientAddress }}, <br> Phone :
                                                    {{ $item->recipientPhone }}
                                                </p>
                                            </td>
                                            <td width="120">
                                                <p>TC : {{ $item->trackingCode }}</p>
                                            </td>
                                            <td width="60">{{ $item->parcelStatus->title }}
                                            </td>
                                            <td class="text-center" width="10">
                                                {{ $item->agent_paid }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td class="text-right"><b>Total = </b></td>
                                        <td>
                                            <b><strong>{{ number_format($amounts->sum('agent_paid'), 2) }}</strong></b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <div class="invoice-left">
                                        {{-- <b>Terms & Conditions</b>
                                    <p class="mb-0">
                                        Authoritatively envisioneer business<br />
                                        action items through parallel sources.
                                    </p> --}}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    {{-- <table class="total-table">
                                    <tr>
                                        <th>Sub Total:</th>
                                        <td>$2000.00</td>
                                    </tr>
                                    <tr>
                                        <th>Tax:</th>
                                        <td>$250.00</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>$2250.00</td>
                                    </tr>
                                </table> --}}
                                </div>
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
    {{-- <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/js/main.js"></script> --}}
</body>

</html>
