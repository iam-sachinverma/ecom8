$(document).ready(function(){
    // Check Current Admin Password 
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        //alert(current_pwd);
        $.ajax({
            type:'post',
            url:'/admin/check-current-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp=="false"){
                    $("#chkCurrentPwd").html("<font color=red>Current Password is incorrect</font>");
                }else if(resp=="true"){
                    $("#chkCurrentPwd").html("<font color=green>Current Password is correct</font>");
                }   
            },error:function(){
                alert("Error");
            }
        });
    });

    // Sections Active and Inactive Status
    $(document).on("click",".updateSectionStatus",function(){    
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#section-"+section_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#section-"+section_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    // Category Active and Inactive Status
    $(document).on("click",".updateCategoryStatus",function(){      
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    // Append Category Level
    $('#section_id').change(function(){
        var section_id = $(this).val();
        $.ajax({
            type:'post',
            url:'/admin/append-categories-level',
            data:{section_id:section_id},
            success:function(resp){
                $("#appendCategoriesLevel").html(resp);
            },error:function(){
                alert("Error");
            } 
        });    
    });

    // SweetAlert (Confirm Deletion of any record)
    $(document).on("click",".confirmDelete",function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          })
          .then((result) => {
            if (result.isConfirmed) {
              window.location.href="/admin/delete-"+record+"/"+recordid;
            } 
          });

    });
    
    //Brands Active and Inactive Status
    $(document).on("click",".updateBrandStatus",function(){      
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-brand-status',
            data:{status:status,brand_id:brand_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#brand-"+brand_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#brand-"+brand_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    // Product Active and Inactive Status
    $(document).on("click",".updateProductStatus",function(){      
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    //Products Attributes ADD/REMOVE FIELD

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height:10px;"></div><input type="text" name="sku[]" style="width: 120px" value="" placeholder="SKU"/>&nbsp;<input type="text" name="size[]" style="width:120px" value="" placeholder="Size" />&nbsp;<input type="number" step="any" name="weight[]" style="width: 120px;" value="" placeholder="Weight" /> &nbsp;<input type="number" step="any" name="price[]" style="width: 120px;" value="" placeholder="Price"/>&nbsp;<input type="number" step="any" name="discount[]" style="width: 120px;" value="" placeholder="Discount"/>&nbsp;<input type="number" name="stock[]" style="width: 120px" value="" placeholder="Stock"/>&nbsp; <a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;&nbsp;<b>Remove</b></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    // Attribute Active and Inactive Status
    $(document).on("click",".updateAttributeStatus",function(){      
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-attribute-status',
            data:{status:status,attribute_id:attribute_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#attribute-"+attribute_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#attribute-"+attribute_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    // Images Active and Inactive Status
    $(document).on("click",".updateImageStatus",function(){     
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-image-status',
            data:{status:status,image_id:image_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#image-"+image_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#image-"+image_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    // Banners Active and Inactive Status
    $(document).on("click",".updateBannerStatus",function(){    
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-banner-status',
            data:{status:status,banner_id:banner_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    // Coupons Active and Inactive Status
    $(document).on("click",".updateCouponStatus",function(){    
        var status = $(this).children("i").attr("status");
        var coupon_id = $(this).attr("coupon_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-coupon-status',
            data:{status:status,coupon_id:coupon_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#coupon-"+coupon_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#coupon-"+coupon_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });

    // Show/Hide Form Coupon Field For Manual/Automatic
    $("#ManualCoupon").click(function(){
        $("#couponField").show();
    });

    $("#AutomaticCoupon").click(function(){
        $("#couponField").hide();
    });

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })
    //Money Euro
    $("[data-mask]").inputmask()
    

    // Show Courier Name and Tracking number Input in case of Shipped Order
    $("#courier_name").hide();
    $("#tracking_number").hide();
    $("#order_status").on("change",function(){
        // alert(this.value);
        if(this.value=="Shipped"){
            $("#courier_name").show();
            $("#tracking_number").show();
        }else{
            $("#courier_name").hide();
            $("#tracking_number").hide();
        }
    });


    // Shipping Charges Active and Inactive Status
    $(document).on("click",".updateShippingStatus",function(){    
        var status = $(this).children("i").attr("status");
        var shipping_id = $(this).attr("shipping_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url:'/admin/update-shipping-status',
            data:{status:status,shipping_id:shipping_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#shipping-"+shipping_id).html("<i class='fas fa-toggle-off fa-lg' aria-hidden='true' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#shipping-"+shipping_id).html("<i class='fas fa-toggle-on fa-lg' aria-hidden='true' status='Active'></i>");
                }

            },error:function(){
                alert("Error");
            }
        });
    });
    

    
});



