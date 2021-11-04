<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>

    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="index.html" data-abc="true">PantryShop</a>
                <div class="float-right">
                    <h3 class="mb-0">Invoice #BBB10234</h3>
                    Date: {{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">From:</h5>
                        <h3 class="text-dark mb-1">Verma Trader</h3>
                        <div>B-1361, Sonia Vihar</div>
                        <div>New Delhi 110034</div>
                        <div>Email: sachinvermab@gmail.com</div>
                        <div>Phone: +91 8700807259</div>
                    </div>
                    <div class="col-sm-6 ">
                        <h5 class="mb-3">To:</h5>
                        <h3 class="text-dark mb-1">{{ $orderDetails['name'] }}</h3>
                        <div>{{ $orderDetails['address'] }}, </div>
                        <div>{{ $orderDetails['area'] }}, {{ $orderDetails['state'] }}, {{ $orderDetails['pincode'] }}</div>
                        <div>Email: {{ $orderDetails['email'] }}</div>
                        <div>Phone: {{ $orderDetails['mobile'] }}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Size</th>
                                <th class="right">Unit Price</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $subTotal=0; @endphp

                            @foreach($orderDetails['orders_products'] as $product)
                            <tr>
                                <td class="center">1</td>
                                <td class="left strong">{{ $product['product_name'] }}</td>
                                <td class="left">{{ $product['product_size'] }}</td>
                                <td class="right">{{ $product['product_price'] }}</td>
                                <td class="center">{{ $product['product_qty'] }}</td>
                                <td class="right">{{ $product['product_price']* $product['product_qty'] }}</td>
                            </tr>
                           
                            @php 
                            
                             $subTotal = $subTotal + ($product['product_price']* $product['product_qty']) 
                            
                            @endphp

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Subtotal</strong>
                                    </td>
                                    <td class="right">{{ $subTotal }}</td>
                                </tr>

                                @if($orderDetails['coupon_amount']>0)
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Discount</strong>
                                        </td>
                                        <td class="right">{{ $orderDetails['coupon_amount'] }}</td>
                                    </tr>
                                @endif   

                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">VAT (10%)</strong>
                                    </td>
                                    <td class="right">$2,304,00</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Shipping</strong>
                                    </td>
                                    <td class="right">$2,304,00</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total</strong> </td>
                                    <td class="right">
                                        <strong class="text-dark">{{ $orderDetails['grand_total'] }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">BBBootstrap.com, Sounth Block, New delhi, 110034</p>
            </div>
        </div>
    </div>
    
</body>
</html>