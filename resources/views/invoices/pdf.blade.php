<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proforma Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            padding: 20px;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            background: white;
        }
        
        /* Header using table layout */
        .invoice-header {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }
        
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .header-table td {
            border: none;
            vertical-align: middle;
        }
        
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .logo-cell {
            text-align: right;
            width: 150px;
        }
        
        /* Company details using table */
        .company-details {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .company-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .company-table td {
            border: none;
            vertical-align: top;
            width: 50%;
            padding-right: 20px;
        }
        
        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        
        .company-info {
            margin-bottom: 4px;
        }
        
        /* Invoice info using table */
        .invoice-info {
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-table td {
            border: none;
            vertical-align: top;
            width: 33.33%;
            padding-right: 15px;
        }
        
        .info-item {
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
        }
        
        /* Products table */
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        
        .products-table th,
        .products-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .products-table th {
            background: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        
        .products-table td:nth-child(1) {
            text-align: center;
            width: 50px;
        }
        
        .products-table td:nth-child(3),
        .products-table td:nth-child(4),
        .products-table td:nth-child(5),
        .products-table td:nth-child(6) {
            text-align: center;
        }
        
        .products-table td:nth-child(7) {
            text-align: right;
        }
        
        /* Totals section */
        .totals-section {
            padding: 0;
            border-top: 1px solid #ddd;
        }
        
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .totals-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        .totals-table .label-col {
            background: #f8f9fa;
            font-weight: bold;
            text-align: left;
            width: 70%;
        }
        
        .totals-table .amount-col {
            text-align: right;
            width: 30%;
        }
        
        .grand-total {
            background: #e9ecef;
            font-weight: bold;
        }
        
        /* Description section */
        .description-section {
            padding: 20px;
            border-top: 1px solid #eee;
        }
        
        .description-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .description-content {
            line-height: 1.6;
            color: #555;
        }
        
        /* Clear floats */
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        
        @media print {
            body {
                padding: 0;
            }
            
            .invoice-container {
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header using table layout -->
        <div class="invoice-header">
            <table class="header-table">
                <tr>
                    <td>
                        <div class="invoice-title">Proforma Invoice</div>
                    </td>
                    <td class="logo-cell">
                        <img src="{{ public_path('images/logo/pdf-logo.png') }}" alt="Company Logo" style="max-width: 140px; max-height: 80px;">
                    </td>
                </tr>
            </table>
        </div>

        <!-- Company Details using table -->
        <div class="company-details">
            <table class="company-table">
                <tr>
                    <td>
                        <div class="section-title">From :</div>
                        <div class="company-info">Swizchem</div>
                        <div class="company-info">Vetehisenkuja 4A 63, 00530 Helsinki, Finland</div>
                        <div class="company-info">Phone: +358 44 763 1234</div>
                        <div class="company-info">Email: sales@swizchem.com</div>
                    </td>
                    <td>
                        <div class="section-title">To :</div>
                        <div class="company-info">{{ $invoice->name ?? 'N/A' }}</div>
                        <div class="company-info">{{ $invoice->to_address }}</div>
                        @if($invoice->phone)
                            <div class="company-info">Phone: {{ $invoice->phone }}</div>
                        @endif
                        @if($invoice->email)
                            <div class="company-info">Email: {{ $invoice->email }}</div>
                        @endif
                        @if($invoice->gstin)
                            <div class="company-info">GSTIN: {{ $invoice->gstin }}</div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Invoice Information using table -->
        <div class="invoice-info">
            <div class="section-title" style="margin-bottom: 15px;">Invoice Information</div>
            <table class="info-table">
                <tr>
                    <td>
                        <div class="info-item">
                            <span class="info-label">Invoice Date:</span> 
                            {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') }}
                        </div>
                        <div class="info-item">
                            <span class="info-label">Invoice Number:</span> {{ $invoice->invoice_number }}
                        </div>
                        @if($invoice->lead_time)
                            <div class="info-item">
                                <span class="info-label">Lead Time:</span> {{ $invoice->lead_time }}
                            </div>
                        @endif
                        @if($invoice->shipping_methods)
                            <div class="info-item">
                                <span class="info-label">Shipping Methods:</span> {{ $invoice->shipping_methods }}
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Products Table -->
        <table class="products-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Compound</th>
                    <th>Purity</th>
                    <th>Quantity</th>
                    <th>Units</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if($invoice->invoiceItems && $invoice->invoiceItems->count() > 0)
                    @foreach($invoice->invoiceItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->purity ?? '-' }}</td>
                            <td>{{ number_format($item->quantity, 0) }}</td>
                            <td>{{ $item->units }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                            No items found for this invoice
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Totals Section -->
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td class="label-col">Subtotal</td>
                    <td class="amount-col">${{ number_format($invoice->sub_total ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td class="label-col">VAT</td>
                    <td class="amount-col">${{ number_format($invoice->vat ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td class="label-col">Shipping Charges</td>
                    <td class="amount-col">${{ number_format($invoice->shipping_charges ?? 0, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="label-col">Grand Total</td>
                    <td class="amount-col">${{ number_format($invoice->grand_total ?? 0, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Description Section -->
        @if($invoice->description)
            <div class="description-section">
                <div class="description-title">Description:</div>
                <div class="description-content">{{ $invoice->description }}</div>
            </div>
        @endif

        {{-- <div class="description-section">
            <div class="description-title">Payment Terms:</div>
            <div class="description-content">defined by swizchem depending on the client and the request.entered here by swizchem while creating
the proforma invoice</div>
        </div> --}}
    </div>
</body>
</html>