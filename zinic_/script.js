var rating_star;
var bmf;
function getFeedbackModal(order_id, id) {
  m = document.getElementById("feedback_modal" + order_id + "_" + id);
  bmf = new bootstrap.Modal(m);
  bmf.show();
}

function ratingMyProduct(x, order_id, id) {
  rating_star = parseInt(x);
  for (var y = 1; y <= rating_star; y++) {
    document.getElementById(
      "starRatind_" + order_id + "_" + id + "_" + y
    ).classList = "bi bi-star-fill text-warning";
  }

  for (var z = 1; z <= parseInt(5 - rating_star); z++) {
    document.getElementById(
      "starRatind_" + order_id + "_" + id + "_" + parseInt(rating_star + z)
    ).classList = "bi bi-star";
  }
}

function saveFeedback(id, order_id) {
  var msg = document.getElementById("feedbackMsg_" + order_id + "_" + id);
  var f = new FormData();
  f.append("msg", msg.value);
  f.append("star", rating_star);
  f.append("pid", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      bmf.hide();
      alert(t);
    }
  };
  r.open("POST", "saveFeedbackProcess.php", true);
  r.send(f);
}

$(".mySelect").chosen({
  disable_search_threshold: 1,
  no_results_text: "Oops, nothing found!",
  width: "100%",
});

function signUp() {
  var fname = document.getElementById("fname_signup");
  var lname = document.getElementById("lname_signup");
  var email = document.getElementById("email_signup");
  var mobile = document.getElementById("mobile_signup");
  var pw = document.getElementById("password_signup");
  var cpw = document.getElementById("cpassword_signup");
  var alert = document.getElementById("alert_signup");
  var msg = document.getElementById("alert_msg_signup");
  var dis = document.getElementById("district_signup");

  if (pw.value == cpw.value) {
    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("mob1", mobile.value);
    f.append("pw", pw.value);
    f.append("dis", dis.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
          window.location = "signIn.php";
        } else {
          alert.classList = "alert alert-warning alert-dismissible fade show";
          msg.innerHTML = t;
        }
      }
    };

    r.open("POST", "signUpProcess.php", true);
    r.send(f);
  } else {
    alert.classList = "alert alert-danger alert-dismissible fade show";
    msg.innerHTML = "Password is not match";
  }
}

function signUpAlertClose() {
  var alert = document.getElementById("alert_signup");
  alert.classList = "d-none";
}

function signInAlertClose() {
  var alert = document.getElementById("alert_signin");
  alert.classList = "d-none";
}

function signIn() {
  var email = document.getElementById("email_signin");
  var pw = document.getElementById("password_signin");
  var remember = document.getElementById("remember-me");
  var alt = document.getElementById("alert_signin");
  var msg = document.getElementById("alert_msg_signin");
  var rem;
  if (remember.checked) {
    rem = "check";
  } else {
    rem = "no";
  }

  var f = new FormData();
  f.append("email", email.value);
  f.append("pw", pw.value);
  f.append("remember", rem);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "index.php";
      } else {
        alt.classList = "alert alert-warning alert-dismissible fade show";
        msg.innerHTML = t;
      }
    }
  };

  r.open("POST", "signInProcess.php", true);
  r.send(f);
}

$(document).ready(function () {
  $("#imageuploadFiles").on("change", function () {
    if (this.files.length <= 3) {
      document.getElementById("imageUploadErrorMsg").classList = "d-none";

      for (let x = 0; x < this.files.length; x++) {
        var img = this.files[x];
        var url = window.URL.createObjectURL(img);
        document.getElementById("uploaded_img" + x).src = url;
      }
    } else {
      document.getElementById("imageUploadErrorMsg").classList =
        "alert alert-warning alert-dismissible fade show";
    }
  });

  $("#imageUploadErrorMsgClose").on("click", function () {
    document.getElementById("imageUploadErrorMsg").classList = "d-none";
  });

  $("#saveAddProductAlertCloseBtn").on("click", function () {
    document.getElementById("saveAddProductAlert").classList = "d-none";
  });

  $("#saveProduct").on("click", function () {
    var categpry = document.getElementById("AddProductCategory");
    var brand = document.getElementById("AddProductBrand");
    var model = document.getElementById("AddProductModel");
    var brand_new = document.getElementById("AddProductB");
    var used = document.getElementById("AddProductU");
    var clr = document.getElementById("AddProductClr");
    var qty = document.getElementById("AddProductQty");
    var des = document.getElementById("AddProductDes");
    var title = document.getElementById("AddProductTitel");
    var cost = document.getElementById("AddProductCost");
    var file = document.getElementById("imageuploadFiles");

    var f = new FormData();

    if (file.files.length > 0) {
      document.getElementById("imageUploadErrorMsg").classList = "d-none";

      f.append("category", categpry.value);
      f.append("brand", brand.value);
      f.append("model", model.value);
      f.append("clr", clr.value);
      f.append("qty", qty.value);
      f.append("des", des.value);
      f.append("title", title.value);
      f.append("cost", cost.value);

      for (let x = 0; x < file.files.length; x++) {
        const img = file.files[x];
        f.append("img" + x, img);
      }

      if (brand_new.checked) {
        f.append("condition", "Brand New");
      } else if (used.checked) {
        f.append("condition", "Used");
      }

      $.ajax({
        type: "POST",
        url: "addProductProcess.php",
        data: f,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "") {
            document.getElementById("saveAddProductAlert").classList =
              "alert alert-success alert-dismissible fade show";
            document.getElementById("saveAddProductAlertMsg").innerHTML =
              "<i class='bi bi-check-circle-fill'></i>&nbsp; Add your Product and active for user";
          } else {
            document.getElementById("saveAddProductAlert").classList =
              "alert alert-warning alert-dismissible fade show";
            document.getElementById("saveAddProductAlertMsg").innerHTML =
              "<i class='bi bi-x-circle-fill'></i>&nbsp;" + response;
          }
        },
      });
    } else {
      document.getElementById("imageUploadErrorMsg").classList =
        "alert alert-warning alert-dismissible fade show";
    }
  });

  $("#AddCategoryBtn").on("click", function () {
    var cat = document.getElementById("AddCategory");
    if (cat.value != "") {
      $.ajax({
        type: "GET",
        url: "addCustom.php?cat=" + cat.value,
        dataType: false,
        success: function (response) {
          if (response == "Success") {
            document.getElementById("addCatBarndModelAlert").classList =
              "alert alert-success alert-dismissible fade show";
            document.getElementById("addCatBarndModelAlertMsg").innerHTML =
              "<i class='bi bi-check-circle-fill'></i>&nbsp; Success";
          } else if (response == "added") {
            document.getElementById("addCatBarndModelAlert").classList =
              "alert alert-warning alert-dismissible fade show";
            document.getElementById("addCatBarndModelAlertMsg").innerHTML =
              "<i class='bi bi-x-circle-fill'></i>&nbsp; Already Add";
          } else {
            alert(response);
          }
        },
      });
    } else {
      document.getElementById("addCatBarndModelAlert").classList =
        "alert alert-warning alert-dismissible fade show";
      document.getElementById("addCatBarndModelAlertMsg").innerHTML =
        "<i class='bi bi-exclamation-triangle-fill'></i></i>&nbsp; Null Value";
    }
  });

  $("#AddBrandBtn").on("click", function () {
    var brand = document.getElementById("AddBrand");
    if (brand.value != 0) {
      $.ajax({
        type: "GET",
        url: "addCustom.php?brand=" + brand.value,
        dataType: false,
        success: function (response) {
          if (response == "Success") {
            document.getElementById("addCatBarndModelAlert").classList =
              "alert alert-success alert-dismissible fade show";
            document.getElementById("addCatBarndModelAlertMsg").innerHTML =
              "<i class='bi bi-check-circle-fill'></i>&nbsp; Success";
          } else if (response == "added") {
            document.getElementById("addCatBarndModelAlert").classList =
              "alert alert-warning alert-dismissible fade show";
            document.getElementById("addCatBarndModelAlertMsg").innerHTML =
              "<i class='bi bi-x-circle-fill'></i>&nbsp; Already Add";
          } else {
            alert(response);
          }
        },
      });
    } else {
      document.getElementById("addCatBarndModelAlert").classList =
        "alert alert-warning alert-dismissible fade show";
      document.getElementById("addCatBarndModelAlertMsg").innerHTML =
        "<i class='bi bi-exclamation-triangle-fill'></i></i>&nbsp; Null Value";
    }
  });

  $("#AddModelBtn").on("click", function () {
    var model = document.getElementById("AddModel");
    var brand = document.getElementById("AddModelBrand");
    if (brand.value != 0) {
      if (model.value != "") {
        $.ajax({
          type: "GET",
          url: "addCustom.php?model=" + model.value + "&bid=" + brand.value,
          dataType: false,
          success: function (response) {
            if (response == "Success") {
              document.getElementById("addCatBarndModelAlert").classList =
                "alert alert-success alert-dismissible fade show";
              document.getElementById("addCatBarndModelAlertMsg").innerHTML =
                "<i class='bi bi-check-circle-fill'></i>&nbsp; Success";
            } else if (response == "added") {
              document.getElementById("addCatBarndModelAlert").classList =
                "alert alert-warning alert-dismissible fade show";
              document.getElementById("addCatBarndModelAlertMsg").innerHTML =
                "<i class='bi bi-x-circle-fill'></i>&nbsp; Already Add";
            } else {
              alert(response);
            }
          },
        });
      } else {
        document.getElementById("addCatBarndModelAlert").classList =
          "alert alert-warning alert-dismissible fade show";
        document.getElementById("addCatBarndModelAlertMsg").innerHTML =
          "<i class='bi bi-exclamation-triangle-fill'></i></i>&nbsp; Null Value";
      }
    } else {
      document.getElementById("addCatBarndModelAlert").classList =
        "alert alert-warning alert-dismissible fade show";
      document.getElementById("addCatBarndModelAlertMsg").innerHTML =
        "<i class='bi bi-x-circle-fill'></i>&nbsp; please select brand";
    }
  });

  $("#addCatBarndModelAlertCloseBtn").on("click", function () {
    document.getElementById("addCatBarndModelAlert").classList = "d-none";
  });

  $("#newColorAdd").on("click", function () {
    var clr = document.getElementById("clr_in").value;
    if (clr != "") {
      $.ajax({
        type: "GET",
        url: "addCustom.php?clr=" + clr,
        dataType: false,
        success: function (response) {
          if (response == "Success") {
            document.getElementById("addCatBarndModelAlert").classList =
              "alert alert-success alert-dismissible fade show";
            document.getElementById("addCatBarndModelAlertMsg").innerHTML =
              "<i class='bi bi-check-circle-fill'></i>&nbsp; Success";
          } else if (response == "added") {
            document.getElementById("addCatBarndModelAlert").classList =
              "alert alert-warning alert-dismissible fade show";
            document.getElementById("addCatBarndModelAlertMsg").innerHTML =
              "<i class='bi bi-x-circle-fill'></i>&nbsp; Already Add";
          } else {
            alert(response);
          }
        },
      });
    } else {
      document.getElementById("addCatBarndModelAlert").classList =
        "alert alert-warning alert-dismissible fade show";
      document.getElementById("addCatBarndModelAlertMsg").innerHTML =
        "<i class='bi bi-exclamation-triangle-fill'></i></i>&nbsp; Null Value";
    }
  });

  $("#removeQuantitySingleProductView").click(function () {
    var qty = $("#productQuantitySingleProductView").val();
    if (parseInt(qty) > 1) {
      qty = parseInt(qty) - 1;
      $("#productQuantitySingleProductView").val(qty);
    } else {
      alert("Minimum quantity achived");
    }
  });

  $("#addQuantitySingleProductView").click(function () {
    var qty = $("#productQuantitySingleProductView").val();
    var avaQty = $("#availableQty").html();
    if (parseInt(avaQty) > parseInt(qty)) {
      qty = parseInt(qty) + 1;
      $("#productQuantitySingleProductView").val(qty);
    } else {
      alert("maximun qunatity achived");
    }
  });

  $("UpdateProductImage").on("change", function () {
    var img = $("#UpdateProductImage");
    for (var x = 0; x < img.files.length; x++) {
      var file = img.files[x];
      var url = window.URL.createObjectURL(file);
    }
  });
});

function addToCart(pid) {
  setInterval(headerRefesher, 100);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "signin") {
        window.Location = "signIn.php";
      } else if (t == "something went wromg") {
        alert(t);
      }
    }
  };

  r.open("GET", "addCartProcess.php?pid=" + pid, true);
  r.send();
}

function deleteFromCart(cid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "somthing went wromg") {
        alert(t);
      } else if (t == "signin") {
        window.location = "signIn.php";
      } else {
        window.location.reload();
      }
    }
  };

  r.open("GET", "deleteFromCartProcess.php?cid=" + cid, true);
  r.send();
}

function addToWatchlist(id) {
  setInterval(headerRefesher, 100);

  var r = new XMLHttpRequest();
  var w = document.getElementsByClassName("watchlist" + id);
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "something went wromg") {
        alert(t);
      } else if (t == "signin") {
        window.location = "signIn.php";
      } else if (t == "liked") {
        for (var x = 0; x < w.length; x++) {
          w[x].innerHTML =
            '<i class="bi bi-heart-fill text-danger"></i>';
        }
      } else if (t == "unliked") {
        for (var y = 0; y < w.length; y++) {
          w[y].innerHTML = '<i class="bi bi-heart-fill"></i>';
        }
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addToWatchlistProcess.php?pid=" + id, true);
  r.send();
}

function addToWatchlist_2(id) {
  setInterval(headerRefesher, 100);

  var r = new XMLHttpRequest();
  var w = document.getElementsByClassName("watchlist" + id);
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "something went wromg") {
        alert(t);
      } else if (t == "signin") {
        window.location = "signIn.php";
      } else if (t == "liked") {
        for (var x = 0; x < w.length; x++) {
          w[x].innerHTML =
            '<i class="bi bi-heart-fill text-danger"></i> Add to Watchlist';
        }
      } else if (t == "unliked") {
        for (var y = 0; y < w.length; y++) {
          w[y].innerHTML = '<i class="bi bi-heart-fill"></i> Add to Watchlist';
        }
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addToWatchlistProcess.php?pid=" + id, true);
  r.send();
}

function headerRefesher() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      var obj = JSON.parse(t);
      document.getElementById("cartCount").innerHTML = obj["cart_num"];
      document.getElementById("watchlistCount").innerHTML =
        obj["watchlist_num"];
    }
  };

  r.open("GET", "cartCounter.php", true);
  r.send();
}

function UpdateProductchangeImg() {
  var img = document.getElementById("UpdateProductImage");
  var l = img.files.length;

  for (var x = 0; x < l; x++) {
    var i = img.files[x];
    var url = window.URL.createObjectURL(i);
    document.getElementById("updateImg" + x).src = url;
  }
}

function updateProduct(id) {
  var title = document.getElementById("title_update");
  var qty = document.getElementById("qty_update");
  var price = document.getElementById("cost_update");
  var des = document.getElementById("des_update");
  var img = document.getElementById("UpdateProductImage");

  var f = new FormData();
  f.append("title", title.value);
  f.append("qty", qty.value);
  f.append("price", price.value);
  f.append("des", des.value);
  f.append("pid", id);

  for (var x = 0; x < img.files.length; x++) {
    var i = img.files[x];
    f.append("img" + x, i);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t != "") {
        alert(t);
      }
    }
  };

  r.open("POST", "updateProductProcess.php", true);
  r.send(f);
}

function deleteProduct(id) {
  if (confirm("Are you Sure")) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
          window.location.reload();
        } else {
          alert(t);
        }
      }
    };

    r.open("GET", "deleteProductProcess.php?pid=" + id, true);
    r.send();
  }
}

function statusChange(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t != "success") {
        alert(t);
      }
    }
  };

  r.open("GET", "statusCahngeProcess.php?pid=" + id, true);
  r.send();
}

function changeSingleProductImg(id) {
  var Minmg = document.getElementById("mainImg");
  var img = document.getElementById("imgView" + id).src;
  Minmg.src = img;
}

function addToCartSingleProduct(pid) {
  setInterval(headerRefesher, 100);

  var qty = document.getElementById("productQuantitySingleProductView").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "signin") {
        window.Location = "signIn.php";
      } else if (t == "something went wromg") {
        alert(t);
      }
    }
  };

  r.open("GET", "addCartProcess.php?pid=" + pid + "&qty=" + qty, true);
  r.send();
}

function payNow(pid) {
  var qty = document.getElementById("productQuantitySingleProductView");
  var r = new XMLHttpRequest();
  var f = new FormData();
  f.append("qty", qty.value);
  f.append("pid", pid);
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "something went wromg") {
        alert(t);
      } else if (t == "signin") {
        alert(t);
      } else if (t == "Product was Deactive") {
        alert(t);
      } else if (t == "Please update your address") {
        window.location = "userProfile.php";
      } else {
        var obj = JSON.parse(t);

        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);
          // Note: validate the payment and show success or failure page to the customer
          createInvoice(qty, pid, obj["oid"]);
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
          createInvoice(qty, pid, obj["oid"]);
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
          createInvoice(qty, pid, obj["oid"]);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: "1222857", // Replace your Merchant ID
          return_url: "http://localhost/zinic/singleProductView.php?pid=" + pid, // Important
          cancel_url: "http://localhost/zinic/singleProductView.php?pid=" + pid, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["oid"],
          items: "Door bell wireles",
          amount: obj["amount"],
          currency: "LKR",
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: obj["email"],
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["district"],
          country: "Sri Lanka",
          delivery_address: "warakapola, Kegalle",
          delivery_city: "warakapola",
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        document.getElementById("payhere-payment").onclick = function (e) {
          payhere.startPayment(payment);
        };
      }
    }
  };

  r.open("POST", "payNowProcess.php", true);
  r.send(f);
}

function createInvoice(qty, pid, oid) {
  var f = new FormData();
  f.append("qty", qty.value);
  f.append("pid", pid);
  f.append("oid", oid);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "invoice.php?order_id=" + oid;
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "createInvoiceProcess.php", true);
  r.send(f);
}

function printInvoice() {
  var page = document.getElementById("page").innerHTML;
  var body = document.body.innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

function payCartNow() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "There was deactive product") {
        alert(t);
      } else if (t == "Please update your address") {
        window.location = "userProfile.php";
      } else {
        var obj = JSON.parse(t);
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);
          // Note: validate the payment and show success or failure page to the customer
          createCartInvoice(obj["oid"]);
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
          createCartInvoice(obj["oid"]);
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
          createCartInvoice(obj["oid"]);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: "1222857", // Replace your Merchant ID
          return_url: "http://localhost/zinic/cart.php", // Important
          cancel_url: "http://localhost/zinic/cart.php", // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["oid"],
          items: "Door bell wireles",
          amount: obj["amount"],
          currency: "LKR",
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: obj["email"],
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["district"],
          country: "Sri Lanka",
          delivery_address: "warakapola, Kegalle",
          delivery_city: "warakapola",
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        document.getElementById("payhere-payment").onclick = function (e) {
          payhere.startPayment(payment);
        };
      }
    }
  };

  r.open("GET", "payCartNowProcess.php", true);
  r.send();
}

function createCartInvoice(oid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "invoice.php?order_id=" + oid;
      }
    }
  };
  r.open("GET", "createCartInvoiceProcess.php?oid=" + oid, true);
  r.send();
}

function removeFromWatchlist(wid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "removeFromWatchlistProcess.php?wid=" + wid, true);
  r.send();
}

function blockUnblockUser(email) {
  var btn = document.getElementById("userBlockUnblockBtn" + email);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "blocked") {
        btn.classList = "btn btn-primary";
        btn.innerHTML = "Unblock";
      } else if (t == "unblocked") {
        btn.classList = "btn btn-danger";
        btn.innerHTML = "Block";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "blockUnblockUserProcess.php?uemail=" + email, true);
  r.send();
}

function changeOrderStatus(oid) {
  var btn = document.getElementById("changeOrderStatusBtn" + oid);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == 1) {
        btn.classList = "btn btn-primary";
        btn.innerHTML = "Couriered";
      } else if (t == 2) {
        btn.classList = "btn btn-danger disabled";
        btn.innerHTML = "Deliverd";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "changeOrderStatusProcess.php?oid=" + oid, true);
  r.send();
}

function manageProductChangePage(page) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("adminManageProductView").innerHTML = t;
    }
  };

  r.open("GET", "adminManageProductChangePage.php?page=" + page, true);
  r.send();
}

function searchByInvoice() {
  var search = document.getElementById("searchInvoiceByInId");
  var f = new FormData();
  f.append("txt", search.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("purchasProductTable").innerHTML = t;
    }
  };

  r.open("POST", "searchByInvoiceProcess.php", true);
  r.send(f);
}

function searchByEmail() {
  var search = document.getElementById("searchEmailByEmail");
  var f = new FormData();
  f.append("txt", search.value);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("purchasProductTable").innerHTML = t;
    }
  };

  r.open("POST", "searchByEmailProcess.php", true);
  r.send(f);
}

function findProduct() {
  var view = document.getElementById("adminProductView");
  var txt = document.getElementById("findAdminProduct");
  var r = new XMLHttpRequest();
  var f = new FormData();

  f.append("txt", txt.value);

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      view.innerHTML = t;
    }
  };

  r.open("POST", "findProductProcess.php", true);
  r.send(f);
}

function searchProduct() {

  var txt = document.getElementById("searchBarLarge_1").value;
  // var txt2 = document.getElementById("searchBarSmall").value;
  // var txt;
  // if (txt1 != "") {
  //   txt = txt1;
  // } 
  // else if (txt2 != "") {
  //   txt = txt2;
  // }
  var f = new FormData();
  f.append("txt", txt);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("sort_search_items").innerHTML = t;
    }
  };
  r.open("POST", "searchProductProcess.php", true);
  r.send(f);
}

function changeInvoiceUserStatus(pid, oid) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open(
    "GET",
    "changeInvoiceUserStatusProcess.php?pid=" + pid + "&oid=" + oid,
    true
  );
  r.send();
}

function updateProfile() {
  var fname = document.getElementById("fname_userProfile");
  var lname = document.getElementById("lname_userProfile");
  var mob2 = document.getElementById("mobile2_userProfile");
  var line1 = document.getElementById("line1_userProfile");
  var line2 = document.getElementById("line2_userProfile");
  var dis = document.getElementById("district_userProfile");
  var pcode = document.getElementById("pcode_userProfile");
  var img = document.getElementById("uppic");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("mob2", mob2.value);
  f.append("line1", line1.value);
  f.append("line2", line2.value);
  f.append("dist", dis.value);
  f.append("pcode", pcode.value);
  f.append("i", img.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else if (t == "signin") {
        window.location = "signIn.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "updateProfileProcess.php", true);
  r.send(f);
}

function changeDeliveryFee(id) {
  var fee = document.getElementById("currentFee" + id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if ((t = "success")) {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open(
    "GET",
    "changeDeliveryFeeProcess.php?fee=" + fee.value + "&id=" + id,
    true
  );
  r.send();
}
var abm;
var avm;
function adminSignin() {
  var m = document.getElementById("adminSignModal");
  abm = new bootstrap.Modal(m);
  abm.show();
}

var adminEmail;
function sendAdminVcode() {
  var email = document.getElementById("adminEmail");
  adminEmail = email.value;
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        abm.hide();
        var m = document.getElementById("adminVcodeModal");
        avm = new bootstrap.Modal(m);
        avm.show();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "sendAdminVcodeProcess.php?email=" + adminEmail, true);
  r.send();
}

function CheckAdminVcode() {
  var vcode = document.getElementById("adminVcode");
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        avm.hide();
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open(
    "GET",
    "CheckAdminVcodeProcess.php?email=" + adminEmail + "&vcode=" + vcode.value,
    true
  );
  r.send();
}

function changeUserStatus(email) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t != "") {
        alert(t);
      } else {
        document.getElementById("changeUserStatus" + email).innerHTML = "";
      }
    }
  };
  r.open("GET", "changeUserStatusProcess.php?email=" + email, true);
  r.send();
}

function changeProductStatus(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t != "") {
        alert(t);
      } else {
        document.getElementById("changeProductStatus" + id).innerHTML = "";
      }
    }
  };
  r.open("GET", "changeProductStatusProcess.php?pid=" + id, true);
  r.send();
}

function changePurchastStatus(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t != "") {
        alert(t);
      } else {
        document.getElementById("changePurchastStatus" + id).innerHTML = "";
      }
    }
  };
  r.open("GET", "changePurchastStatusProcess.php?id=" + id, true);
  r.send();
}

function changeFeedbacktStatus(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t != "") {
        alert(t);
      } else {
        document.getElementById("changeFeedbacktStatus" + id).innerHTML = "";
      }
    }
  };
  r.open("GET", "changeFeedbacktStatusProcess.php?id=" + id, true);
  r.send();
}
fsem;
function forgetPasswordModal() {
  var m = document.getElementById("forgetPasswordSendEmail");
  fsem = new bootstrap.Modal(m);
  fsem.show();
}
var fsvm;
var forgetPasswordEmail;
function fordetPasswordSendVcode() {
  forgetPasswordEmail = document.getElementById(
    "forgetPasswordUserEmail"
  ).value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        fsem.hide();
        m = document.getElementById("forgetPasswordSendVcode");
        fsvm = new bootstrap.Modal(m);
        fsvm.show();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "fordetPasswordSendVcode.php?e=" + forgetPasswordEmail, true);
  r.send();
}

function foegetPasswordSendVcode() {
  var vcode = document.getElementById("forgetPasswordVcode").value;
  var f = new FormData();
  f.append("email", forgetPasswordEmail);
  f.append("vcode", vcode);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        fsvm.hide();
        alert("Password Sent to Your Email Please Check Inbox and Spams");
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "forgetPasswordVcodeProcess.php", true);
  r.send(f);
}

function changeProPic() {
  var i = document.getElementById("uppic");
  var url = window.URL.createObjectURL(i.files[0]);
  document.getElementById("profileImg").src = url;
}

function logOutProcess() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = () => {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "logOutProcess.php", true);
  r.send();
}

function sortProduct(n1, n2) {
  var p_num = 1;
  for (var i = 1; i <= 4; i = i + 1) {
    var price = document.getElementById("sort_price_" + i).checked;
    if (price) {
      p_num = i;
    }
  }

  const c = [];
  for (var i = 1; i <= n1; i++) {
    var cat = document.getElementById("sort_cat_" + i).checked;
    if (cat) {
      c.push(i);
    }
  }
 
  const b = [];
  for (var i = 1; i <= n2; i++) {
    var brand = document.getElementById("sort_b_" + i).checked;
    if (brand) {
      b.push(i);
    }
  }

  var f= new FormData();
  f.append("price",p_num);
  f.append("cat",c)
  f.append("brand",b)

  var r = new XMLHttpRequest();
  r.onreadystatechange = () => {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("sort_search_items").innerHTML=t;
    }
  };
  r.open("POST", "sortProductProcess.php", true);
  r.send(f);
}

function showAddCard(id){
  document.getElementById("main_img_"+id).classList="col-10";
  document.getElementById("addCard_"+id).classList="col-2 d-flex align-items-center";
}

function hideAddCard(id){
  document.getElementById("addCard_"+id).classList="d-none";
  document.getElementById("main_img_"+id).classList="col-12";
}

function clearSortAll(){
  window.location.reload();
}