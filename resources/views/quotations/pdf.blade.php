<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proforma Quotation - {{ $quotation->quotation_number }}</title>
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
        
        .quotation-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            background: white;
        }
        
        /* Header using table layout */
        .quotation-header {
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
        
        .quotation-title {
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
        
        /* Quotation info using table */
        .quotation-info {
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
            
            .quotation-container {
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="quotation-container">
        <!-- Header using table layout -->
        <div class="quotation-header">
            <table class="header-table">
                <tr>
                    <td>
                        <div class="quotation-title">Proforma Quotation</div>
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
                        <div class="company-info">{{ $quotation->company ?? 'N/A' }}</div>
                        <div class="company-info">{{ $quotation->to_address }}</div>
                        @if($quotation->phone)
                            <div class="company-info">Company: {{ $quotation->company }}</div>
                        @endif
                        @if($quotation->email)
                            <div class="company-info">Email: {{ $quotation->email }}</div>
                        @endif
                        @if($quotation->gstin)
                            <div class="company-info">VAT: {{ $quotation->vat_number }}</div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Quotation Information using table -->
        <div class="quotation-info">
            <div class="section-title" style="margin-bottom: 15px;">Quotation Information</div>
            <table class="info-table">
                <tr>
                    <td>
                        <div class="info-item">
                            <span class="info-label">Quotation Date:</span> 
                            {{ \Carbon\Carbon::parse($quotation->quotation_date)->format('Y-m-d') }}
                        </div>
                        <div class="info-item">
                            <span class="info-label">Quotation Number:</span> {{ $quotation->quotation_number }}
                        </div>
                        @if($quotation->lead_time)
                            <div class="info-item">
                                <span class="info-label">Lead Time:</span> {{ $quotation->lead_time }}
                            </div>
                        @endif
                        @if($quotation->shipping_methods)
                            <div class="info-item">
                                <span class="info-label">Shipping Methods:</span> {{ $quotation->shipping_methods }}
                            </div>
                        @endif
                        @if($quotation->payment_terms)
                            <div class="info-item">
                                <span class="info-label">Payment Terms:</span> {{ $quotation->payment_terms }}
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
                    <th>Quantity</th>
                    <th>Units</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if($quotation->quotationItems && $quotation->quotationItems->count() > 0)
                    @foreach($quotation->quotationItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name ?? $item->customProduct->molecule_name }}</td>
                            <td>{{ number_format($item->quantity, 0) }}</td>
                            <td>{{ $item->units }}</td>
                            <td>{{ $quotation->currency }}{{ number_format($item->price, 2) }}</td>
                            <td>{{ $quotation->currency }}{{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                            No items found for this quotation
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
                    <td class="amount-col">{{ $quotation->currency }}{{ number_format($quotation->sub_total ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td class="label-col">VAT</td>
                    <td class="amount-col">{{ $quotation->currency }}{{ number_format($quotation->vat ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td class="label-col">Shipping Charges</td>
                    <td class="amount-col">{{ $quotation->currency }}{{ number_format($quotation->shipping_charges ?? 0, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="label-col">Grand Total</td>
                    <td class="amount-col">{{ $quotation->currency }}{{ number_format($quotation->grand_total ?? 0, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Description Section -->
        @if($quotation->description)
            <div class="description-section">
                <div class="description-title">Description:</div>
                <div class="description-content">{{ $quotation->description }}</div>
            </div>
        @endif

        <div class="description-section">
            <div class="description-title">Disclaimer:</div>
            <div class="description-content">By proceeding, you acknowledge that all products supplied by Swizchem are intended solely for research and internal purposes. Your organization accepts full responsibility for safe handling, storage, transport, and disposal of the products in compliance with all applicable safety and regulatory requirements. Swizchem disclaims any liability for misuse or unauthorized application of its products.</div>
        </div>
    </div>
</body>
</html>