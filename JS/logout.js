function handleLogout() {
   const promptMessage = "Are you sure you want to log out? We'll miss you.";

   if (typeof window.showConfirm === "function") {
      window
         .showConfirm(promptMessage, {
            confirmText: "Log out",
            cancelText: "Stay",
         })
         .then((confirmed) => {
            if (confirmed) {
               window.location.href = "../php/logout.php";
            }
         });
      return;
   }

   if (window.confirm(promptMessage)) {
      window.location.href = "../php/logout.php";
   }
}
