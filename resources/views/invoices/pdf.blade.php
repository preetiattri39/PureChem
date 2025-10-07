<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            padding: 15px;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            background: white;
        }
        
        .invoice-header {
            background: #f8f9fa;
            padding: 15px 20px;
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
        
        .company-details {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }
        
        .top-section-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .top-section-table td {
            border: none;
            vertical-align: top;
            padding-right: 20px;
        }
        
        .top-section-table .left-col {
            width: 50%;
        }
        
        .top-section-table .right-col {
            width: 50%;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
        }
        
        .section-title {
            font-weight: bold;
            margin-bottom: 4px;
            color: #2c3e50;
            font-size: 12px;
        }
        
        .company-info {
            margin-bottom: 2px;
            font-size: 10px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-cell {
            display: table-cell;
            padding: 2px 10px 2px 0;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
            font-size: 10px;
            display: inline-block;
            min-width: 140px;
        }
        
        .info-value {
            font-size: 10px;
        }
        
        .addresses-section {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }
        
        .address-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .address-table td {
            border: none;
            vertical-align: top;
            width: 50%;
            padding-right: 15px;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        
        .products-table th,
        .products-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            font-size: 10px;
        }
        
        .products-table th {
            background: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        
        .products-table td:nth-child(1) {
            text-align: center;
            width: 40px;
        }
        
        .products-table td:nth-child(3),
        .products-table td:nth-child(4),
        .products-table td:nth-child(5) {
            text-align: center;
        }
        
        .products-table td:nth-child(6) {
            text-align: right;
        }
        
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
            padding: 6px;
            font-size: 10px;
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
        
        .description-section {
            padding: 15px 20px;
            border-top: 1px solid #eee;
        }
        
        .description-title {
            font-weight: bold;
            margin-bottom: 4px;
            color: #2c3e50;
            font-size: 12px;
        }
        
        .description-content {
            line-height: 1.6;
            color: #555;
            font-size: 10px;
        }
        
        .payment-info-section {
            padding: 15px 20px;
            background: #f8f9fa;
            border-top: 1px solid #eee;
        }
        
        .payment-grid {
            display: table;
            width: 100%;
        }
        
        .payment-row {
            display: table-row;
        }
        
        .payment-cell {
            display: table-cell;
            padding: 2px 10px 2px 0;
        }
        
        .footer {
            padding: 15px 20px;
            text-align: center;
            border-top: 1px solid #eee;
            background: #f8f9fa;
            font-size: 10px;
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
        <!-- Header -->
        <div class="invoice-header">
            <table class="header-table">
                <tr>
                    <td>
                        <div class="invoice-title">Invoice</div>
                    </td>
                    <td class="logo-cell">
                        <img src="{{ public_path('images/logo/pdf-logo.png') }}" alt="Company Logo" style="max-width: 140px; max-height: 80px;">
                    </td>
                </tr>
            </table>
        </div>

        <!-- Company Details & Invoice Information Side by Side -->
        <div class="company-details">
            <table class="top-section-table">
                <tr>
                    <td class="left-col">
                        <div class="section-title">From:</div>
                        <div class="company-info">Swizchem</div>
                        <div class="company-info">Vetehisenkuja 4A 63, 00530 Helsinki, Finland</div>
                        <div class="company-info">Phone: +358 44 7631234</div>
                        <div class="company-info">Email: manvatt@swizchem.com</div>
                        <div class="company-info">VAT: FI29232227</div>
                    </td>
                    <td class="right-col">
                        <div class="section-title" style="margin-bottom: 6px;">Invoice Information</div>
                        <div class="info-grid">
                            <div class="info-row">
                                <div class="info-cell">
                                    <span class="info-label">Invoice Date:</span>
                                    <span class="info-value">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-cell">
                                    <span class="info-label">Invoice Number:</span>
                                    <span class="info-value">{{ $invoice->invoice_number }}</span>
                                </div>
                            </div>
                            @if($invoice->customer_po)
                            <div class="info-row">
                                <div class="info-cell">
                                    <span class="info-label">Customer PO:</span>
                                    <span class="info-value">{{ $invoice->customer_po }}</span>
                                </div>
                            </div>
                            @endif
                            <div class="info-row">
                                <div class="info-cell">
                                    <span class="info-label">Country of Departure:</span>
                                    <span class="info-value">{{ $invoice->country_of_departure ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-cell">
                                    <span class="info-label">Country of Destination:</span>
                                    <span class="info-value">{{ $invoice->country_of_destination ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-cell">
                                    <span class="info-label">Shipping Method:</span>
                                    <span class="info-value">{{ $invoice->shipping_methods ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Ship To and Bill To Addresses -->
        <div class="addresses-section">
            <table class="address-table">
                <tr>
                    <td>
                        <div class="section-title">Ship To:</div>
                        <div class="company-info">{{ $invoice->ship_to_company ?? 'N/A' }}</div>
                        <div class="company-info">{{ $invoice->ship_to_address ?? 'N/A' }}</div>
                        @if($invoice->ship_to_phone)
                            <div class="company-info">Phone: {{ $invoice->ship_to_phone }}</div>
                        @endif
                        @if($invoice->ship_to_email)
                            <div class="company-info">Email: {{ $invoice->ship_to_email }}</div>
                        @endif
                        @if($invoice->ship_to_tax_id)
                            <div class="company-info">Tax ID: {{ $invoice->ship_to_tax_id }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="section-title">Bill To:</div>
                        @if($invoice->bill_to_different && $invoice->bill_to_address)
                            <div class="company-info">{{ $invoice->bill_to_company ?? 'N/A' }}</div>
                            <div class="company-info">{{ $invoice->bill_to_address }}</div>
                            @if($invoice->bill_to_phone)
                                <div class="company-info">Phone: {{ $invoice->bill_to_phone }}</div>
                            @endif
                            @if($invoice->bill_to_email)
                                <div class="company-info">Email: {{ $invoice->bill_to_email }}</div>
                            @endif
                            @if($invoice->bill_to_tax_id)
                                <div class="company-info">Tax ID: {{ $invoice->bill_to_tax_id }}</div>
                            @endif
                        @else
                            <div class="company-info" style="font-style: italic;">Same as Ship To</div>
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
                            <td>
                                @if($item->is_custom_product && $item->customProduct)
                                    {{ $item->customProduct->molecule_name ?? 'N/A' }}
                                @else
                                    {{ $item->product->name ?? 'N/A' }}
                                @endif
                            </td>
                            <td>{{ number_format($item->quantity, 0) }}</td>
                            <td>{{ $item->units }}</td>
                            <td>{{ $invoice->currency ?? '$' }} {{ number_format($item->price, 2) }}</td>
                            <td>{{ $invoice->currency ?? '$' }} {{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
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
                    <td class="amount-col">{{ $invoice->currency ?? '$' }} {{ number_format($invoice->sub_total ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td class="label-col">VAT</td>
                    <td class="amount-col">{{ $invoice->currency ?? '$' }} {{ number_format($invoice->vat ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td class="label-col">Shipping Charges</td>
                    <td class="amount-col">{{ $invoice->currency ?? '$' }} {{ number_format($invoice->shipping_charges ?? 0, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="label-col">Grand Total</td>
                    <td class="amount-col">{{ $invoice->currency ?? '$' }} {{ number_format($invoice->grand_total ?? 0, 2) }}</td>
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

        <!-- Payment Information Section -->
        <div class="payment-info-section">
            <div class="section-title" style="margin-bottom: 6px;">Payment Information</div>
            
            <div class="payment-grid">
                @if($invoice->payment_terms)
                <div class="payment-row">
                    <div class="payment-cell">
                        <span class="info-label">Payment Terms:</span>
                        <span class="info-value">{{ $invoice->payment_terms }}</span>
                    </div>
                </div>
                @endif
                
                @if($invoice->payment_method)
                <div class="payment-row">
                    <div class="payment-cell">
                        <span class="info-label">Payment Method:</span>
                        <span class="info-value">{{ $invoice->payment_method }}</span>
                    </div>
                </div>
                @endif
                
                <div class="payment-row">
                    <div class="payment-cell">
                        <span class="info-label">Currency:</span>
                        <span class="info-value">{{ $invoice->currency ?? '$' }}</span>
                    </div>
                </div>
            </div>

            <div style="margin-top: 8px;">
                <div class="description-title" style="margin-bottom: 4px;">Bank Details:</div>
                <div class="payment-grid">
                    <div class="payment-row">
                        <div class="payment-cell">
                            <span class="info-label">Bank Name:</span>
                            <span class="info-value">{{ $invoice->bank_name ?? 'Nordea Finland' }}</span>
                        </div>
                    </div>
                    <div class="payment-row">
                        <div class="payment-cell">
                            <span class="info-label">SWIFT/BIC:</span>
                            <span class="info-value">{{ $invoice->swift_bic ?? 'NDEAFIHH' }}</span>
                        </div>
                    </div>
                    <div class="payment-row">
                        <div class="payment-cell">
                            <span class="info-label">IBAN:</span>
                            <span class="info-value">{{ $invoice->iban ?? 'FI39 1544 3000 0826 31' }}</span>
                        </div>
                    </div>
                    @if($invoice->reference_number)
                    <div class="payment-row">
                        <div class="payment-cell">
                            <span class="info-label">Reference Number:</span>
                            <span class="info-value">{{ $invoice->reference_number }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <strong>{{ parse_url(config('app.url'), PHP_URL_HOST) }}</strong>
        </div>
    </div>
</body>
</html>