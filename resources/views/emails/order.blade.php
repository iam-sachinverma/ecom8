<html>
    <body>
        <table style="width: 700px;">
           <tr><td>&nbsp;</td></tr>
           <tr><td>Hello {{ $name }},</td></tr>
           <tr><td>&nbsp;</td></tr>
           <tr><td>Thank you for shopping with us. Your Order details are as below :-</td></tr>
           <tr><td>&nbsp;</td></tr>
           <tr><td>Order no: {{ $order_id }}</td></tr>
           <tr><td>&nbsp;</td></tr>
           <tr>
               <td>
                   <table style="width: 95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                     <tr bgcolor="#cccccc">
                        <td>Product Name</td>
                        <td>Product Size</td>
                        <td>Product Quantity</td>
                        <td>Product Price</td>
                     </tr>
                     @foreach($orderDetails['orders_products'] as $order)
                        <tr>
                            <td>{{ $order['product_name'] }}</td>
                            <td>{{ $order['product_size'] }}</td>
                            <td>{{ $order['product_qty'] }}</td>
                            <td>&#8377; {{ $order['product_price'] }}</td>
                        </tr>
                     @endforeach

                        <tr><td>&nbsp;</td></tr>
                       
                        
                        <tr>
                            <td colspan="4" align="right">Shipping Charges</td>
                            <td>&#8377; {{ $orderDetails['shipping_charges'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">Coupon Discount</td>
                            <td>&#8377; 
                                @if($orderDetails['coupon_amount']>0)
                                 {{ $orderDetails['coupon_amount'] }}
                                @else
                                  0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">Grand Total</td>
                            <td>&#8377; {{ $orderDetails['grand_total'] }}</td>
                        </tr>
                   </table>
               </td>
           </tr>
           <tr><td>&nbsp;</td></tr>
            <tr><td>
              <table>
                  <tr>
                    <td><strong>Delivery to this Address :-</strong></td>
                  </tr>
                  <tr>
                    <td>{{ $orderDetails['name'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $orderDetails['address'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $orderDetails['area'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $orderDetails['state'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $orderDetails['pincode'] }}</td>
                  </tr>
                  <tr>
                    <td>{{ $orderDetails['mobile'] }}</td>
                  </tr>
              </table>
            </td></tr> 
           <tr><td>&nbsp;</td></tr>
           <tr>
               <td>
               For any enquiries, you can contact us at <a href="mailto:sachinvermab@gmail.com">sachinvermab@gmail.com</a>
               </td>
            </tr>
           <tr><td>&nbsp;</td></tr>
           <tr><td>Regards,<br>Team Soul</td></tr>
           <tr><td>&nbsp;</td></tr>
        </table>
    </body>
</html>
