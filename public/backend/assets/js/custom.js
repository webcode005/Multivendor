$(document).ready(function(){
    // check Admin password is correct or not

    $("#currentPassword").keyup(function(){
        var currentPassword = $("#currentPassword").val();
        // alert(currentPassword);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/check-current-password',
            data:{currentPassword:currentPassword},
            success:function(resp)
            {
                if(resp == "false")
                {
                    $("#check_error").html("<font color='red'>Current Password is Incorrect!</font>");
                }
                else if(resp == "true")
                {
                    $("#check_error").html("<font color='green'>Current Password is Correct!</font>");
                }
            },error:function()
            {
                alert('Error');
            }

        });
    });

});

// Active / Inactive Vendor and Admin

$(document).on("click",".updateAdminStatus",function(){
    var status = $(this).children("span").attr("status");
    var admin_id = $(this).attr("admin_id");
    

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp)
            {
                if(resp['status'] == 0)
                {
                    $("#admin-"+admin_id).html("<span class='badge bg-danger'  id='status' status='InActive'> InActive </span>");
                }
                else if(resp['status'] == 1)
                {
                    $("#admin-"+admin_id).html("<span class='badge bg-success'  id='status' status='Active'> Active </span>");
                }
            },error:function()
            {
                alert('Error');
            }

        });


});


// Active / Inactive Sections Status

$(document).on("click",".updateSectionStatus",function(){
    var status = $(this).children("span").attr("status");
    var section_id = $(this).attr("section_id");
    

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp)
            {
                if(resp['status'] == 0)
                {
                    $("#section-"+section_id).html("<span class='badge bg-danger'  id='status' status='InActive'> InActive </span>");
                }
                else if(resp['status'] == 1)
                {
                    $("#section-"+section_id).html("<span class='badge bg-success'  id='status' status='Active'> Active </span>");
                }
            },error:function()
            {
                alert('Error');
            }

        });


});

// delete section simple js

$(".deletesection").click(function(){
    var title = $(this).attr("title");
    if(confirm("Are You Sure to delete this " + title+"?"))
    {
        return true;
    }
    else
    {
        return false;
    }

});

// delete section sweetalert js

// $(".deletesection").click(function(){
//     var title = $(this).attr("title");
//     if(confirm("Are You Sure to delete this " + title+"?"))
//     {
//         return true;
//     }
//     else
//     {
//         return false;
//     }

// });


// Active / Inactive Categories Status

$(document).on("click",".updateCategoryStatus",function(){
    var status = $(this).children("span").attr("status");
    var category_id = $(this).attr("category_id");
    

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp)
            {
                if(resp['status'] == 0)
                {
                    $("#category-"+category_id).html("<span class='badge bg-danger'  id='status' status='InActive'> InActive </span>");
                }
                else if(resp['status'] == 1)
                {
                    $("#category-"+category_id).html("<span class='badge bg-success'  id='status' status='Active'> Active </span>");
                }
            },error:function()
            {
                alert('Error');
            }

        });


});

// delete Category simple js

$(".deletecategory").click(function(){
    var title = $(this).attr("title");
    if(confirm("Are You Sure to delete this " + title+"?"))
    {
        return true;
    }
    else
    {
        return false;
    }

});


// Append Section Level 

$("#section_id").change(function(){
    var section_id = $(this).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'get',
        url:'/admin/append-section-level',
        data:{section_id:section_id},
        success:function(resp)
        {
            $("#appendSectionLevel").html(resp);

        },error:function()
        {
            alert('Error');
        }

    });

});  




// Append SubCategory Level 

$("#category_id").change(function(){
    var category_id = $(this).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'post',
        url:'/admin/append-subcategories',
        data:{category_id:category_id},
        success:function(resp)
        {
            $("#appendCategoryLevel").html(resp);

        },error:function()
        {
            alert('Error');
        }

    });

});  

// Append Sub SubCategory Level 

$("#appendCategoryLevel").change(function(){
    var category_id = $(this).val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'post',
        url:'/admin/append-subcat',
        data:{category_id:category_id},
        success:function(resp)
        {
            $("#appendSubCat").html(resp);

        },error:function()
        {
            alert('Error');
        }

    });

}); 

// Active / Inactive SubCategories Status

$(document).on("click",".updateSubCategoryStatus",function(){
    var status = $(this).children("span").attr("status");
    var category_id = $(this).attr("category_id");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/update-subcategory-status',
            data:{status:status,category_id:category_id},
            success:function(resp)
            {
                if(resp['status'] == 0)
                {
                    $("#category-"+category_id).html("<span class='badge bg-danger'  id='status' status='InActive'> InActive </span>");
                }
                else if(resp['status'] == 1)
                {
                    $("#category-"+category_id).html("<span class='badge bg-success'  id='status' status='Active'> Active </span>");
                }
            },error:function()
            {
                alert('Error');
            }

        });


});

// delete SubCategory simple js

$(".deletesubcategory").click(function(){
    var title = $(this).attr("title");
    if(confirm("Are You Sure to delete this " + title+"?"))
    {
        return true;
    }
    else
    {
        return false;
    }

});
// Active / Inactive SubSubCategories Status

$(document).on("click",".updateSubCatStatus",function(){
    var status = $(this).children("span").attr("status");
    var category_id = $(this).attr("category_id");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/update-subcat-status',
            data:{status:status,category_id:category_id},
            success:function(resp)
            {
                if(resp['status'] == 0)
                {
                    $("#category-"+category_id).html("<span class='badge bg-danger'  id='status' status='InActive'> InActive </span>");
                }
                else if(resp['status'] == 1)
                {
                    $("#category-"+category_id).html("<span class='badge bg-success'  id='status' status='Active'> Active </span>");
                }
            },error:function()
            {
                alert('Error');
            }

        });


});

// delete Sub SubCategory simple js

$(".deletesubcat").click(function(){
    var title = $(this).attr("title");
    if(confirm("Are You Sure to delete this " + title+"?"))
    {
        return true;
    }
    else
    {
        return false;
    }

});

// Active / Inactive Brand Status

$(document).on("click",".updatebrandStatus",function(){
    var status = $(this).children("span").attr("status");
    var brand_id = $(this).attr("brand_id");
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/update-brand-status',
            data:{status:status,brand_id:brand_id},
            success:function(resp)
            {
                if(resp['status'] == 0)
                {
                    $("#brand-"+brand_id).html("<span class='badge bg-danger'  id='status' status='InActive'> InActive </span>");
                }
                else if(resp['status'] == 1)
                {
                    $("#brand-"+brand_id).html("<span class='badge bg-success'  id='status' status='Active'> Active </span>");
                }
            },error:function()
            {
                alert('Error');
            }

        });


});

// delete Brand simple js

$(".deletebrand").click(function(){
    var title = $(this).attr("title");
    if(confirm("Are You Sure to delete this " + title+"?"))
    {
        return true;
    }
    else
    {
        return false;
    }

});

// Active / Inactive Product Status

$(document).on("click",".updateProductStatus",function(){
    var status = $(this).children("span").attr("status");
    var product_id = $(this).attr("product_id");
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:'/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp)
            {
                if(resp['status'] == 0)
                {
                    $("#product-"+product_id).html("<span class='badge bg-danger'  id='status' status='InActive'> InActive </span>");
                }
                else if(resp['status'] == 1)
                {
                    $("#product-"+product_id).html("<span class='badge bg-success'  id='status' status='Active'> Active </span>");
                }
            },error:function()
            {
                alert('Error');
            }

        });


});

// delete Product simple js

$(".deleteproduct").click(function(){
    var title = $(this).attr("title");
    if(confirm("Are You Sure to delete this " + title+"?"))
    {
        return true;
    }
    else
    {
        return false;
    }

});








