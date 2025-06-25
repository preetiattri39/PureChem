@extends('layouts.main.mainLayout')
@section('title', 'Welcome')

@section('vite')
    @vite(['resources/js/pages/cart.js', 'resources/css/pages/cart.css'])
@endsection

@section('content')

<!-- Hero Section -->
<section class="inner-hero sh-custom-bg-light align-items-center">
    <div class="container">
        <h1 class="display-6 fw-bold">Cart</h1>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
  <!-- Main Content -->
    <div class="container pb-5">
        <div class="row g-5">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5>Category</h5>
                    <ul class="d-flex flex-column gap-3 list-unstyled">
                        <li><a href="#">Advanced Intermediates</a></li>
                        <li><a href="#">Fine Chemicals</a></li>
                        <li><a href="#">Isotope Labeled</a></li>
                        <li><a href="#">Metabolites & Impurities</a></li>
                        <li><a href="#">Natural Products</a></li>
                        <li><a href="#">OLED</a></li>
                        <li><a href="#">Peptides</a></li>
                        <li><a href="#">Reagents & Ligands</a></li>
                        <li><a href="#">Featured Products</a></li>
                        <li><a href="#">Complete Product List</a></li>
                    </ul>
                </div>
            </div>
            <!-- Product List -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold sh-custom-text-accent">RFQ Items</h3>
                </div>
                <div class="row g-3">
                    <div class="table-wrap">
                        <table class="table rfq-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>CAS</th>
                                    <th>Quantity</th>
                                    <th>Price (USD)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-title">Candesartan Methylester</td>
                                    <td>13481-44-0</td>
                                    <td>10MG</td>
                                    <td>RFQ</td>
                                    <td><button class="btn btn-sm btn-primary mt-0">Delete</button></td>
                                </tr>
                                <tr>
                                    <td class="product-title">Candesartan Tetrazole Methyl Ester</td>
                                    <td>N/A</td>
                                    <td>10MG</td>
                                    <td>RFQ</td>
                                    <td><button class="btn btn-sm btn-primary mt-0">Delete</button></td>
                                </tr>
                                <tr>
                                    <td class="product-title">2-Butyl-1,3-diazaspiro[4.4]non-en-4-one hydrochloride</td>
                                    <td>151257-01-1</td>
                                    <td>10MG</td>
                                    <td>RFQ</td>
                                    <td><button class="btn btn-sm btn-primary mt-0">Delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Show More -->
                    <div class="d-flex flex-row gap-3 sh-custom-mt-xxl">
                        <button class="btn btn-outline-yellow">Add More Producrs</button>
                        <button class="btn-yellow">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection