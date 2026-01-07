
$("#SLO_Logout").on("click", function() {
    swal.fire({
    title: 'Are you sure?',
    text: "You will logout this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: '<i class="fa-solid fa-person-running"></i> Yes, Logout it!',
    color: "#e8c72e",
    background: "#fff url(../pictures/BRain.gif) center no-repeat",
    width: 800,
    closeOnConfirm: true,
    closeOnCancel: true
   }).then((result) => { 
      if (result.value===true) { 
        swal.fire({
          title: "You are now logged out!",
          text: 'Bye see you later. :)',
          icon: "success",
          
          timer: 3000,
          showConfirmButton: false
        }).then(function() {
    window.location = "../AA_Project/logout.php";
})
         // this submits the form 
      } 
   }) 
})   