$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*$("#sort").on('change',function(){
        this.form.submit();
    });*/


    /* Product Sort Filter */
    $("#sort").on('change',function(){
        var sort = $(this).val();
        var cuisine = get_filter("cuisine");
        var country = get_filter("country");
        var foodpreference = get_filter("foodpreference");
        var url = $("#url").val();
        $.ajax({
           url:url,
           method:"post",
           data:{cuisine:cuisine,country:country,foodpreference:foodpreference,sort:sort,url:url},
           success:function(data){
               $('.filter_products').html(data);
           }
        })
    });

    /*  Product Filter  */
    $(".cuisine").on('click',function(){
        var cuisine = get_filter(this);
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
           $.ajax({
            url:url,
            method:"post",
            data:{cuisine:cuisine,sort:sort,url:url},
            success:function(data){
                $('.filter_products').html(data);
            }
        })
    });

    $(".country").on('click',function(){
        var country = get_filter(this);
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
           $.ajax({
            url:url,
            method:"post",
            data:{country:country,sort:sort,url:url},
            success:function(data){
                $('.filter_products').html(data);
            }
        })
    });

    $(".foodpreference").on('click',function(){
        var foodpreference = get_filter(this);
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
           $.ajax({
            url:url,
            method:"post",
            data:{foodpreference:foodpreference,sort:sort,url:url},
            success:function(data){
                $('.filter_products').html(data);
            }
        })
    });
    
    /* Get Filter Function */
    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    /* Get Attr Price */
    $("#getPrice").on('change',function(){
        var size = $(this).val();
        var product_id = $(this).attr("product-id");
        $.ajax({
           url:'/get-product-price',
           data:{size:size,product_id:product_id},
           type:'post',
           success:function(resp){
            // alert(resp['save']);
                if(resp['attribute_discount']>0){
                    $(".getAttrPrice").html("&#x20B9; "+resp['final_price']+" &nbsp; "+" <small> MRP: <del>Rs."+resp['product_price']+" </del> </small>&nbsp;<code> Save &#x20B9;"+resp['save']+"</code>" );    
                }else{
                    $(".getAttrPrice").html("MRP:"+"&nbsp;"+" Rs "+resp['product_price']);
                }  
            },error:function(){
               alert("Error");
            }
        });
    });

    // Update Cart Item Quantity
    $(document).on('click','.btnItemUpdate',function(){
        if($(this).hasClass('qtyMinus')){
            // qtyMinus button clicked
            var quantity = $(this).next().val();
            if(quantity<=1){
               alert("Item Order Quantity atleast 1");
               return false;
            }else{
                new_qty = parseInt(quantity)-1;
            }
        }
        if($(this).hasClass('qtyPlus')){
            // qtyPlus button clicked
            // var quantity = $(this).prev().val();
            // new_qty = parseInt(quantity)+1;
            var quantity = $(this).prev().val();
            new_qty = parseInt(quantity)+1;
            
        }
        var cartid = $(this).data('cartid');
        $.ajax({
            data:{"cartid":cartid,"qty":new_qty},
            url:'/update-cart-item-qty',
            type:'post',
            success:function(resp){
                if(resp.status==false){
                    alert(resp.message);
                }
                // alert(resp.totalCartItems);
                $(".AppendCartItems").html(resp.view);
                $(".totalCartItems").text(resp.totalCartItems);
            },error:function(){
                alert("Error");
            }
        })
    });

    // Delete Cart Item
    $(document).on('click','.btnItemDelete',function(){
        var cartid = $(this).data('cartid');
        var result = confirm("Want to delete this item");
        if(result){
            $.ajax({
                data:{"cartid":cartid},
                url:'/delete-cart-item',
                type:'post',
                success:function(resp){
                    $('.AppendCartItems').html(resp.view);
                    $('.totalCartItems').text(resp.totalCartItems);
                },error:function(){
                    alert("Error");
                }
            });
        } 
    });


    // Register User Form Validation
    $("#registerForm").validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true,
            },
            email: {
                required: true,
                email: true,
                remote: "check-email"
            },
            password: {
                required: true,
                minlength: 5
            },
        },
        messages: {
            name: "Please enter your name",
            mobile: {
                required: "Please enter a your phone number",
                minlength: "Your phone number must consist of least 10 characters",
                maxlength: "Your phone number must consist of least 10 characters",
                digits: "Please enter Valid phone number"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
                remote: "Email already exists"
            },    
            password: {
                required: "Please set a password",
                minlength: "Your password must be at least 5 characters long"
            },

        }
    });

    // Login User Form Validation
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
            },    
            password: {
                required: "Please enter your password"
            },

        }
    });

    // USER Change Password Form Validation
    $("#passwordForm").validate({
        rules: {
            current_pwd: {
                required: true,
            },
            new_pwd: {
                required: true,
                minlength: 5
            },
            confirm_pwd: {
                required: true,
                minlength: 5,
                equalTo:"#new_pwd"
            }
        },
        messages: {    
            confirm_pwd: {
                equalTo: "Password Not Matched"
            },

        }
    });

    // Check USER Current Password
    $("#current_pwd").keyup(function(){
        var current_pwd = $(this).val();
        $.ajax({
            type:'post',
            url:'/account/check-user-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp=="false"){
                    $("#chkPwd").html("<font color='red'>Current Password is not matched</font>")
                }else if(resp=="true"){
                    $("#chkPwd").html("<font color='green'>Current Password is matched</font>")
                }  
            },error:function(){
                alert("Error");
            }
        });
    });

    // Apply Coupon
    $("#ApplyCoupon").submit(function(){
        var user = $(this).attr("user");
        if(user==1){
            // Do Nothing
        }else{
            alert("Please login to apply to coupon");
            return false;
        }
        var code = $("#code").val();
        
        $("#couponRow").show();
    
        $.ajax({
            type:'post',
            data:{code:code},
            url:'/apply-coupon',
            success:function(resp){
                if(resp.message!=""){
                    $("#invalidCoupon").html(resp.message);
                }
                $('AppendCartItems').html(resp.view);
                $('.totalCartItems').text(resp.totalCartItems);
                if(resp.couponAmount>=0){
                    $(".couponAmount").text(resp.couponAmount);   
                }else{
                    $(".couponAmount").text(0);
                }
                if(resp.grand_total>=0){
                    $(".grand_total").text(resp.grand_total); 
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    // Show and Hide Delivery Landmark
    $("#addLandmark").click(function(){
        $("#landmark").show();
    });

    // Delivery Address Form Validation
    $("#deliveryAddressForm").validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true,
            },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },
            state: "required",
            address: "required",
            area: "required",
            address_type: "required",
        },
        messages: {
            name: "Please enter your full name",
            mobile: {
                required: "Please enter your phone number",
                minlength: "Your phone number must consist of least 10 characters",
                maxlength: "Your phone number must consist of least 10 characters",
                digits: "Please enter Valid phone number"
            },
            pincode: {
                required: "Please enter pincode of your area",
                digits: "Please enter Valid pincode",
                minlength: "Invalid pincode",
                maxlength: "Invalid pincode",
            },
            state: "Please enter your city name",
            area: "Please enter your local area",
            address: "Please enter address for delivery on time",
            address_type: "Please select any address type",
        }
    });

    // // Delete Delivery Address
    // $(document).on('click','.addressDelete',function(){
    //     var result = confirm("Delete krna h kkya ?");
    //     if(!result){
    //         return false;
    //     }
    // });

    // Get Pincode Area
    $("#pincode").on('change',function(){
        var pincode = $("#pincode").val();
        if(pincode != ''){
            $.ajax({
                type:'post',
                url:'/autofill-address',
                data:{pincode:pincode},
                success:function(resp){
                   $("#state").val(resp['state']);
                   $("#district").val(resp['district']);
                //   alert(resp['state']);
                }
            });
        }
        else{
            return false;
        }
    });

    // Calculate Shipping Charges and updated grand total
    $("input[name=address_id]").bind('change',function(){
        var shipping_charges = $(this).attr("shipping_charges");
        var total_price = $(this).attr("total_price");
        var coupon_amount = $(this).attr("coupon_amount");
        var cod = $(this).attr("cod");
        // alert(cod); die;
        if(cod=="No"){
            $("#codMethod").hide();
        }
        // alert(coupon_amount);
        if(coupon_amount==""){
            coupon_amount = 0;
        }
        $(".shipping_charges").html("Rs."+shipping_charges);
        var grand_total = parseInt(total_price) + parseInt(shipping_charges) - parseInt(coupon_amount);
        // alert(grand_total);
        $(".grand_total").html("Rs."+grand_total);
    });


    // Check Delivery Pincode
    $("#checkPincodeButton").click(function(){
        var pincode = $("#checkPincode").val();
        if(pincode==""){
            alert("Please check delivery pincode"); return false; 
        }
        $.ajax({
            type:'post',
            data:{pincode:pincode},
            url:'/check-pincode',
            success:function(resp){
                alert(resp);
            },error:function(){
                alert("Error");
            }
        })
    });

    
});