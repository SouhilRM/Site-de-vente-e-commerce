$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 


    });

});

// Confirm 

$("#updateStatus").on("click", function (event) {
  event.preventDefault();
  let link = $(this).attr("href");
  let status = $(this).text();
  status = status.split(" ")[0];

  Swal.fire({
      title: `Are you sure to ${status}?`,
      text: `once ${status} , You won't be able to revert this!`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: `Yes, ${status} it!`,
  }).then((result) => {
      if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire(`${status}`, `Order has been ${status}.`, "success");
      }
  });
});