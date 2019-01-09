$(document).ready(function(){
    cat();
    brand();
    products();

    function cat(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {category:1},
            success : function(data){
                $("#get_category").html(data);
            }
        })
    }

    function brand(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {brands:1},
            success : function(data){
                $("#get_brands").html(data);
            }
        })
    }

    function products(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {products:1},
            success : function(data){
                $("#get_products").html(data);
            }
        })
    }

    $("body").delegate(".category","click",function(event){
        event.preventDefault();
        var cid = $(this).attr('cid');
        $.ajax({
            url     : "action.php",
            method  : "POST",
            data    : {get_select_category:1, cat_id:cid},
            success : function(data){
                $("#get_products").html(data);
            }
        })
    })

    $("body").delegate(".brand","click",function(event){
        event.preventDefault();
        var bid = $(this).attr('bid');
        $.ajax({
            url     : "action.php",
            method  : "POST",
            data    : {get_select_brand:1, brand_id:bid},
            success : function(data){
                $("#get_products").html(data);
            }
        })
    })

    $("#search_btn").click(function(){
        var keywords = $("#search").val();
        if(keywords != ""){
            $.ajax({
                url     : "action.php",
                method  : "POST",
                data    : {search:1, keywords:keywords},
                success : function(data){
                    $("#get_products").html(data);
                }
            }) 
        }
    })

    $("#signup").click(function(event){
        event.preventDefault();
        $.ajax({
            url     : "customer_register.php",
            method  : "POST",
            data    : $("form").serialize(),
            success : function(data){
                $("#alert_msg").html(data);
            }
        }) 
    })

    $("#login").click(function(event){
        event.preventDefault();
        var email = $("#email").val();
        var password = $("#password").val();
        $.ajax({
            url     : "login.php",
            method  : "POST",
            data    : {Userlogin:1, Useremail:email, Userpassword:password},
            success : function(data){
                if(data == "Success"){
                    window.location.href = "profile.php";
                }
            }
        }) 
    })

    $("body").delegate("#product", "click", function(event){
        event.preventDefault();
        var p_id = $(this).attr("pid");
        $.ajax({
            url     : "action.php",
            method  : "POST",
            data    : {Addtocart:1, pid:p_id},
            success : function(data){
                $("#CartAddMsg").html(data);
                cart_count();
            }
        })
    })

    $("#cart").click(function(event){
        event.preventDefault();
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {cartlist:1},
            success : function(data){
                $("#cartlist").html(data);
            }
        })
    })

    Cartcheckout();
    function Cartcheckout(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {cartcheckout:1},
            success : function(data){
                $("#cartcheckout").html(data);
            }
        })
    }

    $("body").delegate(".qty","keyup",function(){
        var id = $(this).attr("pid");
        var qty = $("#qty-"+id).val();
        var price = $("#price-"+id).val();
        var total = qty * price;
        $("#total-"+id).val(total);
    })

    $("body").delegate(".delete","click",function(event){
        event.preventDefault();
        var id = $(this).attr("delete_id");
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {deletecart:1,deleteid:id},
            success : function(data){
                Cartcheckout();
                $("#deleteMsg").html(data);
            }
        })
    })

    $("body").delegate(".update","click",function(event){
        event.preventDefault();
        var id = $(this).attr("update_id");
        var qty = $("#qty-"+id).val();
        var total = $("#total-"+id).val();

        $.ajax({
            url : "action.php",
            method : "POST",
            data : {updatecart:1,updateid:id,quantity:qty,total:total},
            success : function(data){
                Cartcheckout();
                $("#deleteMsg").html(data);
            }
        })
    })

    page();
    function page(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {page:1},
            success : function(data){
                $("#pageno").html(data);
            }
        })
    }

    $("body").delegate("#page","click",function(){
        var page = $(this).attr("pageno");
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {products:1, setpage:1, pagenumber:page},
            success : function(data){
                $("#get_products").html(data);
            }
        })
    })
    cart_count();
    function cart_count(){
        $.ajax({
            url : "action.php",
            method : "POST",
            data : {cart_count:1},
            success : function(data){
                $(".badge").html(data);
            }
        })
    }

})