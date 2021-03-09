$(document).ready(function(){
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        //alert(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: {current_pwd:current_pwd},
            success:function(resp){
                if(resp=="false"){
                    $("#chkcurrentPwd").html("<font color=red>Current Password is incorrect</font>");
                }else if(resp=="true"){
                    $("#chkcurrentPwd").html("<font color=green>Current Password correct</font>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Update Section Status
    $(".updateSectionStatus").click(function(){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status, section_id:section_id},
            success:function(resp){
                if(resp['status'] == 0){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(O)'>Inactive</a>");
                }else if(resp['status'] == 1){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(O)'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Update Category Status
    $(".updateCategoryStatus").click(function(){
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        $.ajax({
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status, category_id:category_id},
            success:function(resp){
                if(resp['status'] == 0){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(O)'>Inactive</a>");
                }else if(resp['status'] == 1){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(O)'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Update Product status
    $(".updateProductStatus").click(function(){
        var status = $(this).text();
        var product_id = $(this).attr("product_id");
        $.ajax({
            type:'post',
            url:'/admin/update-product-status',
            data:{status:status, product_id:product_id},
            success:function(resp){
                if(resp['status'] == 0){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(O)'>Inactive</a>");
                }else if(resp['status'] == 1){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(O)'>Active</a>");
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
            type: 'post',
            url: '/admin/append-categories-level',
            data: {section_id:section_id},
            success:function(resp){
                $("#appendCategoriesLevel").html(resp);
            },error:function(){
                alert("Error");
            }
        });
    });

    /* Confirm Deletion of record
    $(".confirmDelete").click(function(){
        var name = $(this).attr("name");
        if(confirm("Etes vous sure de vouloir supprimer " + name + " ?")){
            return true;
        }
        return false;
    });
    */

   // Confirm deletion with sweet alert
   $(".confirmDelete").click(function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Etes-vous sûre de vouloir supprimer ?',
            text: "Cette action est irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Annuler !',
            confirmButtonText: 'Oui , supprimer !'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href="delete-"+ record + "/" + recordid;
            }
          });
          return false;
    });

});
