@extends('cashier.cashier-nav')

@section('title')
    Cashier Dashboard - POS
@endsection

@section('cashier-content')

    <head>
        <style>
            @media print {
                @page {
                    size: 80mm 80mm;
                    margin: 0;
                }

                body {
                    margin: 0;
                    padding: 0;
                    font-size: 12px;
                    line-height: 1.1;
                }

                .receipt-container {
                    width: 80mm;
                    margin: 0 auto;
                    padding: 0;
                }

                h3,
                h4,
                p {
                    margin: 0;
                    padding: 0;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th,
                td {
                    padding: 2px 0;
                    text-align: left;
                }

                .no-print {
                    display: none !important;
                }

                .total {
                    margin-top: 5px;
                    font-size: 14px;
                    font-weight: bold;
                }
            }
        </style>

    </head>

    <body class="col-lg-12 col-md-6 col-sm-12">
        @if (Session('error'))
            <div class="alert alert-danger my-4">{{ Session('error') }}</div>
        @endif
        @if (Session('status'))
            <div class="alert alert-success my-4">{{ Session('status') }}</div>
        @endif
        <div class="cashier-dashboard">
            <h3 class="text-center">Cashier Name: @auth {{ Auth::user()->user_name }} @endauth
            </h3>
            <div class="cashier-items">
                <form>
                    <div class="row" style="display: flex; justify-content:space-between;">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="dateToday">Date Today</label>
                                <input type="date" class="form-control" value="{{ $todayDate }}" id="dateToday"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="orderId">Order ID</label>
                                <input type="text" class="form-control" value="{{ $next_order_id }}" id="orderId"
                                    readonly disabled>
                            </div>
                        </div>
                    </div>
                </form>

                <head>
                    <title>Order Page</title>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                </head>

                <body>
                    <form id="orderTable">
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Barcode</label>
                                <input type="text" class="form-control" id="barcode" placeholder="Enter barcode">
                            </div>
                            <div class="col-lg-3">
                                <label>Product Name</label>
                                <input type="text" class="form-control" id="product-name" disabled>
                            </div>
                            <div class="col-lg-3">
                                <label>Quantity</label>
                                <input type="number" id="quantity" class="form-control" min="1">
                            </div>
                            <div class="col-lg-3">
                                <label>Price</label>
                                <input type="text" class="form-control" id="price" disabled>
                            </div>
                        </div>
                    </form>
                    <button id="addProductBtn" class="button1 my-3">Add Product</button>
                    <button type="button" class="button1 bg-danger" id="resetButton">Reset Entries</button>

                    <h3 class="text-center">Products Summary</h3>
                    <div class="products" style="box-shadow: inset 0px 0px 10px 100px #00000023;">
                        <table id="orderSummary" class="table text-light table-heading">
                            <thead>
                                <tr>
                                    <th class="table-heading">Product Name</th>
                                    <th class="table-heading">Quantity</th>
                                    <th class="table-heading">Price Per Unit</th>
                                    <th class="table-heading">Total Price</th>
                                    <th class="table-heading">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <h4 class="price-box text-center col-lg-12" style="font-size: 30px; font-weight:800;">Total: <span
                            id="orderTotal" class="total-price" style="font-size: 30px; font-weight:800;">0.00</span></h4>



                    <!-- Button trigger modal -->
                    <button type="button" class="button1 col-lg-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Save
                    </button>
                    <button id="viewOrdersBtn" class="button1 bg-danger">View Today's Orders</button>


                    <!-- Cashier Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Save or Print Receipt</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="totalPrice" class="form-label">Total Price</label>
                                        <input type="text" class="form-control" id="totalPrice" disabled readonly>
                                    </div>

                                    <form id="paymentForm">
                                        <label for="" class="form-check-label">Payment Method</label>
                                        <div class="container">
                                            <div class="form-group d-flex align-items-center"
                                                style="justify-content: space-between;">
                                                <div class="col-lg-4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="paymentMethod" id="cashOption" value="cash" checked>
                                                        <label class="form-check-label fs-5 fw-800" for="cashOption">
                                                            Cash
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="paymentMethod" id="cardOption" value="card">
                                                        <label class="form-check-label fs-5 fw-800" for="cardOption">
                                                            Bank Card
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="cashSection">
                                            <label for="customerMoney" class="form-label">Customer Cash</label>
                                            <input type="number" class="form-control" id="customerMoney"
                                                placeholder="Enter cash received">
                                            <label for="toBeReturn" class="form-label">Change to Return</label>
                                            <input type="number" class="form-control" id="toBeReturn" readonly>
                                        </div>

                                        <div id="cardSection" style="display: none;">
                                            <label for="transactionId" class="form-label">Transaction ID</label>
                                            <input type="text" class="form-control" name="transaction_id"
                                                id="transactionId" placeholder="Enter Transaction ID">
                                            <label for="totalBillAmount" class="form-label">Total Bill Amount</label>
                                            <input type="number" class="form-control" id="totalBillAmount" disabled
                                                readonly>
                                        </div>
                                    </form>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="savePdfCheck">
                                        <label class="form-check-label" for="savePdfCheck">Save as PDF</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button id="saveOrderBtn" class="button1 my-3">Save/Print</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Error Modal -->
                    <div class="modal fade bg-dark" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog bg-danger">
                            <div class="modal-content bg-danger">
                                <div class="modal-header bg-danger text-light">
                                    <h5 class="text-center" id="errorModalLabel">Error Occurred</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="alert bg-danger text-center mt-2">
                                    <h2><strong class="text-light">Error! </strong></h2><span id="errorModalBody"
                                        class="text-light text-center fw-bold"></span>
                                </div>
                                <div class="modal-footer m-0">
                                    <button type="button" class="button1" data-bs-dismiss="modal"
                                        id="closeButton">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>




                    <script>
                        $(document).ready(function() {
                            function showErrorModal(errorMessage) {
                                $('#errorModalBody').text(errorMessage);
                                $('#errorModal').modal('show');
                            }
                            var products = [];

                            // Fetch product details based on barcode input
                            $('#barcode').on('input', function() {
                                var barcode = $(this).val();
                                var quantity = parseInt($('#quantity').val()) || 1; // default to 1 if not entered

                                $.ajax({
                                    url: '/fetch-product',
                                    type: 'POST',
                                    data: {
                                        barcode: barcode,
                                        quantity: quantity,
                                        _token: $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            $('#product-name').val(response.product.product_name);
                                            $('#price').val(response.price);
                                        } else {
                                            showErrorModal(response.message);
                                        }
                                    }
                                });
                            });


                            // Add product to order
                            $('#addProductBtn').on('click', function() {
                                var barcode = $('#barcode').val();
                                var productName = $('#product-name').val();
                                var quantity = parseInt($('#quantity').val());
                                var price = parseFloat($('#price').val());

                                if (productName && quantity > 0) {
                                    // AJAX call to check stock
                                    $.ajax({
                                        url: '/check-stock',
                                        type: 'POST',
                                        data: {
                                            barcode: barcode,
                                            quantity: quantity,
                                            _token: $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                // Stock is sufficient, proceed with adding the product
                                                var existingProductIndex = products.findIndex(p => p.barcode ===
                                                    barcode);

                                                if (existingProductIndex >= 0) {
                                                    var existingProduct = products[existingProductIndex];
                                                    existingProduct.quantity += quantity;

                                                    var $existingRow = $('#orderSummary tbody tr').eq(
                                                        existingProductIndex);
                                                    $existingRow.find('.quantity-input').val(existingProduct
                                                        .quantity);
                                                    $existingRow.find('.total-price').text((existingProduct
                                                        .quantity * existingProduct.price).toFixed(2));
                                                } else {
                                                    products.push({
                                                        barcode: barcode,
                                                        product_id: barcode,
                                                        name: productName,
                                                        quantity: quantity,
                                                        price: price
                                                    });

                                                    var row = `
                                                            <tr>
                                                                <td>${productName}</td>
                                                                <td><input type="number" disabled readonly class="quantity-input" style="border:none;" data-barcode="${barcode}" value="${quantity}" min="1"></td>
                                                                <td class="single-price">${price.toFixed(2)}</td>
                                                                <td class="total-price">${(price * quantity).toFixed(2)}</td>
                                                                <td><button class="delete-btn button1" data-barcode="${barcode}"><i class="fa fa-trash"></i></button></td>
                                                            </tr>
                                                        `;

                                                    $('#orderSummary tbody').append(row);
                                                }

                                                calculateTotalPrice();
                                                clearInputs();
                                            } else {
                                                // Stock is insufficient, show alert
                                                showErrorModal('Stock is not available. Available quantity: ' +
                                                    response
                                                    .available_stock);
                                                clearInputs();
                                            }
                                        },
                                        error: function(error) {
                                            showErrorModal('Failed to check stock. Please try again.');
                                        }

                                    });
                                } else {
                                    showErrorModal('Please enter a valid product.');
                                }
                            });


                            // Delete product
                            $(document).on('click', '.delete-btn', function() {
                                var barcode = $(this).data('barcode');
                                var productIndex = products.findIndex(p => p.barcode === barcode);

                                if (productIndex >= -1) {
                                    products.splice(productIndex, 1);
                                    $(this).closest('tr').remove();
                                    calculateTotalPrice();
                                }
                            });

                            $('input[name="paymentMethod"]').on('change', function() {
                                if ($('#cashOption').is(':checked')) {
                                    $('#cashSection').show();
                                    $('#cardSection').hide();
                                } else if ($('#cardOption').is(':checked')) {
                                    $('#cashSection').hide();
                                    $('#cardSection').show();
                                }
                            });


                            $('#saveOrderBtn').on('click', function() {
                                var saveAsPdf = $('#savePdfCheck').is(':checked');
                                var orderDate = $('#dateToday').val();
                                var paymentMethod = $('input[name="paymentMethod"]:checked')
                                    .val(); // Get selected payment method
                                var orderData = {
                                    order_id: '{{ $next_order_id }}',
                                    products: products,
                                    date: orderDate,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                };

                                // Add payment-specific data based on selected method
                                if (paymentMethod === 'cash') {
                                    orderData.payment_method = 'cash';
                                    orderData.received_money = parseFloat($('#customerMoney').val());
                                } else if (paymentMethod === 'card') {
                                    orderData.payment_method = 'card';
                                    orderData.transaction_id = $('#transactionId').val();
                                    orderData.total_bill_amount = parseFloat($('#totalBillAmount').val());
                                }

                                function saveAndPrintOrder() {
                                    $.ajax({
                                        url: '/save-order',
                                        type: 'POST',
                                        data: orderData,
                                        success: function(response) {
                                            if (response.success) {
                                                var iframe = document.createElement('iframe');
                                                iframe.style.display = 'none';
                                                iframe.src = '/print-order/' + '{{ $next_order_id }}';
                                                document.body.appendChild(iframe);
                                                iframe.onload = function() {
                                                    iframe.contentWindow.print();
                                                    iframe.contentWindow.onafterprint = function() {
                                                        window.location.reload();
                                                    };
                                                };
                                            } else {
                                                showErrorModal('Failed to save the order.');
                                            }
                                        },
                                        error: function(error) {
                                            showErrorModal(error.responseJSON.message);
                                        }
                                    });
                                }

                                if (saveAsPdf) {
                                    // Save PDF order and then proceed to save and print the order
                                    $.ajax({
                                        url: '/save-pdf-order',
                                        type: 'POST',
                                        data: {
                                            order_id: '{{ $next_order_id }}',
                                            products: products,
                                            date: orderDate,
                                            _token: $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                window.location.href = response.pdf_url;
                                                saveAndPrintOrder
                                                    (); // Call function to save and print order after saving PDF
                                            } else {
                                                showErrorModal('Failed to generate PDF.');
                                            }
                                        },
                                        error: function(error) {
                                            showErrorModal('Error saving PDF: ' + error.responseJSON.message);
                                        }
                                    });
                                } else {
                                    // Directly save and print the order if PDF is not needed
                                    saveAndPrintOrder();
                                }
                            });


                            function calculateTotalPrice() {
                                var total = 0;
                                products.forEach(function(item) {
                                    total += item.price * item.quantity;
                                });
                                $('#orderTotal').text(total.toFixed(2)); // Update total price in the UI
                                $('#totalPrice').val(total.toFixed(2)); // Update total price in the modal
                                $('#totalBillAmount').val(total.toFixed(2)); // Update total price in the modal
                            }

                            function clearInputs() {
                                $('#barcode').val('');
                                $('#product-name').val('');
                                $('#quantity').val(''); // Reset quantity to 1
                                $('#price').val('');
                            }

                            // Calculate return money based on customer input
                            $('#customerMoney').on('keyup', function() {
                                var totalMoney = parseFloat($('#totalPrice').val());
                                var receivedMoney = parseFloat($(this).val());
                                var remainingMoney = receivedMoney - totalMoney;
                                $('#toBeReturn').val(remainingMoney.toFixed(0));
                            });
                            $('#resetButton').on('click', function() {
                                clearInputs();
                            });
                        });


                        document.getElementById('viewOrdersBtn').addEventListener('click', function() {
                            window.open('/orders/today', 'OrderWindow', 'width=800,height=600');
                        });
                    </script>
                </body>
            @endsection
