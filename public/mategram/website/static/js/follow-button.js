function follow(profile_id) {

    var a = document.getElementById('follow-btn');
    console.log(a.innerHTML);



    $.ajax({
        type:"GET",
        url:"{{route('profile.follow')}}",
        data:{id: profile_id},
        dataType: "JSON",
        success:function(response){
            // console.log(response);
        }
    });

    // $.ajax({
    //     type: "GET",
    //     url:   "{{route('product.get-sub-category')}}",
    //     data: {id : categoryId},
    //     dataType: "JSON",
    //     success:function(response){

    //         var option = '';
    //         option += '<option value="" disabled selected>--- Select SubCategory ---</option>';
    //         $.each(response, function(key, value)
    //         {
    //             if (value.status == 1) {
    //                 option += '<option value="'+value.id+'">'+value.name+'</option>';
    //             }
    //         });
    //         var subCategoryid = $('#subCategoryId');
    //         subCategoryid.empty();
    //         subCategoryid.append(option);
    //     }
    // });

    // alert(`Profile id = ` + id)
    // var a = document.getElementById('follow-btn');
    
    // if(a.innerHTML == 'Follow')
    //     a.innerHTML = 'Unfollow';

    // else
    //     a.innerHTML = 'Follow'

}

