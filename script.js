function upview() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.style.visibility = "visible";
  signInBox.style.visibility = "hidden";
}

function inview() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.style.visibility = "hidden";
  signInBox.style.visibility = "visible";
}
function upview1() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.style.visibility = "visible";
  signInBox.style.visibility = "hidden";
}

function inview1() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.style.visibility = "hidden";
  signInBox.style.visibility = "visible";
}


function signup() {

  var name = document.getElementById("name");
  var email = document.getElementById("email");
  var psw = document.getElementById("password");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  var form = new FormData();

  form.append("n", name.value);
  form.append("e", email.value);
  form.append("p", psw.value);
  form.append("m", mobile.value);
  form.append("g", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {
      var response = request.responseText;

      if (response == "success") {

        document.getElementById("msg").innerHTML = "Registration Successfull";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  }

  request.open("POST", "signupProcess.php", true);
  request.send(form);



}

function signin() {

  var email = document.getElementById("email1");
  var psw = document.getElementById("password1");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();

  form.append("e", email.value);
  form.append("p", psw.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      if (response == "success") {
        window.location = "home.php";
      } else {
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgdiv1").className = "d-block";
      }

    }
  }

  request.open("POST", "signinprocess.php", true);
  request.send(form);


}

var forgotPasswordModal;

function forgotPassword() {

  var email = document.getElementById("email1");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;

      if (response == "Success") {
        alert("Verification code has sent successfully. Please check your Email.");
        var modal = document.getElementById("fpmodal");
        forgotPasswordModal = new bootstrap.Modal(modal);
        forgotPasswordModal.show();
      } else {
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgdiv1").className = "d-block";
      }

    }
  }

  request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  request.send();

}

function showPassword1() {
  var textfield = document.getElementById("np");
  var button = document.getElementById("npb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "Show";
  }
}

function showPassword2() {
  var textfield = document.getElementById("rnp");
  var button = document.getElementById("rnpb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "Show";
  }
}

function resetPassword() {

  var email = document.getElementById("email1");
  var newPassword = document.getElementById("np");
  var retypePassword = document.getElementById("rnp");
  var verification = document.getElementById("vcode");

  var form = new FormData();
  form.append("e", email.value);
  form.append("n", newPassword.value);
  form.append("r", retypePassword.value);
  form.append("v", verification.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        alert("Password updated successfully.");
        forgotPasswordModal.hide();
      } else {
        alert(response);
      }
    }
  }

  request.open("POST", "resetPasswordProcess.php", true);
  request.send(form);

}



function signout() {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      }
    }
  }

  request.open("GET", "signOutProcess.php", true);
  request.send();

}

function changeProfileImg() {
  var img = document.getElementById("profileimage");

  img.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("img").src = url;
  }

}


function updateProfile() {

  var name = document.getElementById("name");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");
  var image = document.getElementById("profileimage");

  var form = new FormData();

  form.append("n", name.value);
  form.append("m", mobile.value);
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("p", province.value);
  form.append("d", district.value);
  form.append("c", city.value);
  form.append("pc", pcode.value);
  form.append("i", image.files[0]);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;

      if (response == "Updated" || response == "Saved") {
        window.location.reload();
      } else if (response == "You have not selected any image.") {
        alert("You have not selected any image.");
        window.location.reload();
      } else {
        alert(response);
      }

    }
  }

  request.open("POST", "updateProfileProcess.php", true);
  request.send(form);

}


function addProduct() {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");
  var clr = document.getElementById("clr");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var size = document.getElementById("size");
  var image = document.getElementById("imageuploader");

  var form = new FormData();
  form.append("ca", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("t", title.value);
  form.append("clr", clr.value);
  form.append("q", qty.value);
  form.append("co", cost.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("desc", desc.value);



  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;

      if (response == "success") {
        document.getElementById("msg").innerHTML = "Product saved Successfull";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
        window.location.reload();

      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  }

  request.open("POST", "addProductProcess.php", true);
  request.send(form);

}

function changeProductImage() {

  var image = document.getElementById("imageuploader");

  image.onchange = function () {

    var file_count = image.files.length;

    if (file_count <= 3) {

      for (var x = 0; x < file_count; x++) {

        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(file_count + "files. You are proceed to upload only 3 or less than 3 files.")
    }
  }
}

function changeStatus(id) {
  var product_id = id;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;
      if (response == "deactivated" || response == "activated") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  }

  request.open("GET", "changeStatusProcess.php?id=" + product_id, true);
  request.send();

}

function sort(x) {

  var search = document.getElementById("s");

  var time = "0";

  if (document.getElementById("n").checked) {
    var time = "1";
  } else if (document.getElementById("o").checked) {
    var time = "2";
  }


  var qty = "0";

  if (document.getElementById("h").checked) {
    var qty = "1";
  } else if (document.getElementById("l").checked) {
    var qty = "2";
  }


  var form = new FormData();

  form.append("s", search.value);
  form.append("t", time);
  form.append("q", qty);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      document.getElementById("sort").innerHTML = response;
    }
  }

  request.open("POST", "sortprocess.php", true);
  request.send(form);

}

function clearSort() {
  window.location.reload();
}

function sendid(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;

      if (response == "Success") {
        window.location = "updateproduct.php";
      } else {
        alert(response);
      }
    }
  }

  request.open("GET", "sendidprocess.php?id=" + id, true);
  request.send();

}

function loadMainImg(id) {

  var sample_img = document.getElementById("productImg" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.style.backgroundImage = "url(" + sample_img + ")";
}







function updateProduct() {

  var title = document.getElementById("title");
  var qty = document.getElementById("qty");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var description = document.getElementById("desc");
  var images = document.getElementById("imageuploader");

  var form = new FormData();
  form.append("t", title.value);
  form.append("q", qty.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("d", description.value);

  var file_count = images.files.length;

  for (var x = 0; x < file_count; x++) {
    form.append("i" + x, images.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;
      if (response == "Product has been Updated.") {
        window.location = "myproduct.php";
      } else {
        alert(response);
      }

    }
  }

  request.open("POST", "updateproductprocess.php", true);
  request.send(form);






}
function basicsearch(x) {

  var text = document.getElementById("basic_search_txt");
  var select = document.getElementById("basic_search_select");


  var form = new FormData();

  form.append("t", text.value);
  form.append("s", select.value);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      document.getElementById("basicSearchResult").innerHTML = response;

    }
  }

  request.open("POST", "basicsearchprocess.php", true);
  request.send(form);


}


function addtocart(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;

      if (response == "New product added to the cart.") {

        alert("New product added to the cart.");
        window.location.reload();

      } else {
        alert(response);
      }

    }
  }

  request.open("GET", "addToCartProcess.php?id=" + id, true);
  request.send();



}


function addtowatchlist(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;
      alert(response);

    }

  }

  request.open("POST", "addtowatchlistprocess.php?id=" + id, true);
  request.send();


}


function payNow(id) {

  var qty = document.getElementById("qty_input").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      var obj = JSON.parse(response);

      var mail = obj["umail"];
      var amount = obj["amount"];

      if (response == 1) {
        alert("Please Login.");
        window.location = "index.php";
      } else if (response == 2) {
        alert("Please update your profile.");
        window.location = "userprofile.php";
      } else {

        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          alert("Payment completed. OrderID:" + orderId);
          saveInvoice(orderId, id, mail, amount, qty);

        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          "sandbox": true,
          "merchant_id": obj["mid"],    // Replace your Merchant ID
          "return_url": "http://localhost/trendz/singleproductview.php?id=" + id,     // Important
          "cancel_url": "http://localhost/trendz/singleproductview.php?id=" + id,     // Important
          "notify_url": "http://sample.com/notify",
          "order_id": obj["id"],
          "items": obj["item"],
          "amount": amount + ".00",
          "currency": "LKR",
          "hash": obj["hash"], // *Replace with generated hash retrieved from backend
          "first_name": obj["name"],
          "last_name": "",
          "email": mail,
          "phone": obj["mobile"],
          "address": obj["address"],
          "city": obj["city"],
          "country": "Sri Lanka",
          "delivery_address": obj["address"],
          "delivery_city": obj["city"],
          "delivery_country": "Sri Lanka",
          "custom_1": "",
          "custom_2": ""
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };



      }



    }



  }

  request.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
  request.send();
}


function saveInvoice(orderId, id, mail, amount, qty) {

  var form = new FormData();
  form.append("o", orderId);
  form.append("i", id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(response);
      }
    }
  }

  request.open("POST", "saveInvoiceProcess.php", true);
  request.send(form);

}

function printInvoice() {
  var restorePage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}

function sendtoemail() {

  var msg = document.getElementById("page").innerHTML;


  var form = new FormData();

  form.append("msg", msg);


  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;
      if (response == "Success") {
        alert("Invoice sent to the email");
      } else {
        alert(response);
      }
    }

  }

  request.open("POST", "sendinvoice.php", true);
  request.send(form);

}






function adminverification() {


  var email = document.getElementById("email").value;

  var form = new FormData();

  form.append("email", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      if (response == "Success") {

        alert("verification code sending successfully.");
        document.getElementById("login1").style.visibility = "hidden";
        document.getElementById("login2").style.visibility = "visible";

      } else {
        alert(response);
      }
    }
  }
  request.open("POST", "sendadminverificarionprocess.php", true);
  request.send(form);

}


function adminlogin() {


  var vcode = document.getElementById("code").value;

  var form = new FormData();

  form.append("vc", vcode);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      if (response == "success") {

        window.location = "adminpanel.php";
      } else {
        alert(response);
      }

    }

  }

  request.open("POST", "adminloginprocess.php", true);
  request.send(form);

}

function adminsignout() {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {

        window.location = "adminlogin.php";
      }
    }
  }

  request.open("GET", "adminsignOutProcess.php", true);
  request.send();

}

function send_msg() {

  var recever_mail = "0";

  var r2 = document.getElementById("select_user");

  if (r2 == 0) {
    var r1 = document.getElementById("rmail");
    recever_mail = r1.innerHTML;
  } else {
    recever_mail = r2.value;
  }

  var msg_txt = document.getElementById("msg_txt");

  var form = new FormData();
  form.append("rm", recever_mail);
  form.append("mt", msg_txt.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        alert("sent");
        window.location.reload();
      } else {
        alert(response);
      }
    }
  }

  request.open("POST", "sendMsgProcess.php", true);
  request.send(form);

}

function viewMessage(email) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;
      document.getElementById("chat_box").innerHTML = response;

    }
  }

  request.open("GET", "viewmessageprocess.php?e=" + email, true);
  request.send();

}


var mm;
function feedback(id) {
  var feedbackModal = document.getElementById("feedback" + id);
  mm = new bootstrap.Modal(feedbackModal);
  mm.show();
}


function sendfeed(id) {

  var type;

  if (document.getElementById("type1").checked) {
    type = 1;
  } else if (document.getElementById("type2").checked) {
    type = 2;
  } else if (document.getElementById("type3").checked) {
    type = 3;
  }

  var feed = document.getElementById("content").value;


  var form = new FormData();

  form.append("pid", id);
  form.append("type", type);
  form.append("con", feed);


  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      if (response == "success") {

        window.location.reload();

      } else {
        alert(response);

      }





    }

  }

  request.open("POST", "sendfeedbackprocess.php", true);
  request.send(form);


}



function removecart(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      if (response = "success") {


        window.location.reload();

      } else {
        alert(response);

      }
    }

  }

  request.open("GET", "removecartprocess.php?id=" + id, true);
  request.send();

}

function removewatch(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      if (response = "success") {


        window.location.reload();

      } else {
        alert(response);

      }
    }

  }

  request.open("GET", "removewatchprocess.php?id=" + id, true);
  request.send();


}

function removehis(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;

      if (response = "success") {


        window.location.reload();

      } else {
        alert(response);

      }
    }

  }

  request.open("GET", "removehisprocess.php?id=" + id, true);
  request.send();


}


function blockuser(email, status) {


  var form = new FormData();

  form.append("e", email);
  form.append("s", status);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 && request.status == 200) {

      var response = request.responseText;

      if (response == "success") {

        window.location.reload();

      } else {
        alert(response);
      }




    }

  }

  request.open("POST", "blockuser.php", true);
  request.send(form);

}

function blockproduct(id, status) {

  var form = new FormData();


  form.append("i", id);
  form.append("s", status);


  var request = new XMLHttpRequest();


  request.onreadystatechange = function () {

    if (request.readyState == 4 && request.status == 200) {

      var response = request.responseText;

      if (response == "success") {
        window.location.reload();
      } else {
        alert(response);
      }



    }


  }

  request.open("POST", "blockproduct.php", true);
  request.send(form);

}


function changeorderstatus(id, status) {

  var form = new FormData();

  form.append("i", id);
  form.append("s", status);


  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 && request.status == 200) {

      var response = request.responseText;

      if (response == "success") {

        window.location.reload();

      } else {
        alert(response);
      }




    }


  }

  request.open("POST", "changeorderstatus.php", true);
  request.send(form);


}

function cartbuy(price) {



  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {

    if (request.readyState == 4 & request.status == 200) {

      var response = request.responseText;


      var obj = JSON.parse(response);

      var mail = obj["umail"];
      var amount = obj["amount"];

      if (response == 1) {
        alert("Please Login.");
        window.location = "index.php";
      } else if (response == 2) {
        alert("Please update your profile.");
        window.location = "userprofile.php";
      } else {

        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          alert("Payment completed. OrderID:" + orderId);
          savecartInvoice(orderId, mail, amount);

        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          "sandbox": true,
          "merchant_id": obj["mid"],    // Replace your Merchant ID
          "return_url": "http://localhost/trendz/home.php",     // Important
          "cancel_url": "http://localhost/trendz/home.php",     // Important
          "notify_url": "http://sample.com/notify",
          "order_id": obj["id"],
          "items": obj["item"],
          "amount": amount + ".00",
          "currency": "LKR",
          "hash": obj["hash"], // *Replace with generated hash retrieved from backend
          "first_name": obj["name"],
          "last_name": "",
          "email": mail,
          "phone": obj["mobile"],
          "address": obj["address"],
          "city": obj["city"],
          "country": "Sri Lanka",
          "delivery_address": obj["address"],
          "delivery_city": obj["city"],
          "delivery_country": "Sri Lanka",
          "custom_1": "",
          "custom_2": ""
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };



      }





    }



  }

  request.open("GET", "buynowcartprocess.php?id=" + price, true);
  request.send();

}


function saveInvoice(orderId, mail, amount){

  var form = new FormData();
  form.append("o", orderId);
 
  form.append("m", mail);
  form.append("a", amount);
  

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 & request.readyState == 4) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(response);
      }
    }
  }

  request.open("POST", "saveCartInvoiceProcess.php", true);
  request.send(form);

}





















