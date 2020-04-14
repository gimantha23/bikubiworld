<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>checkout</title>
<link rel="stylesheet" type="text/css" href="navbarStyle.css">
<link rel="stylesheet" type="text/css" href="checkoutStyle.css">

</head>

<body>
<div class="mainbody">
  <div class="logo">
  <a href="homepage.html"><img src="images/BKB.JPG" width="199" height="40" /></a>
  </div>
  <div class="navbarTop">
        <ul>
      		<li><a href="homepage.html">Home</a></li>
      		<li><a>Shop</a>
        <ul>
          <li><a>Popular products</a></li>
          <li><a>New arrivals</a></li>
        </ul>
      </li>
      <li><a>About</a>
        <ul>
          <li><a>Our team</a></li>
          <li><a>Mission and vision</a></li>
        </ul>
      </li>
      <li><a>Contact Us</a></li>
      <a href="#"><img src="images/search icon.png" width="42" height="38" /></a>
      <a href="cart.html"><img src="images/shp cart.jpg" width="42" height="38" /></a>
      <a href="user account.html"><img src="images/acc ic.png" width="42" height="38" /></a>
    </ul>
</div>
<p>&nbsp;</p>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form>
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label> Full Name</label>
            <input type="text" name="txtFullname" placeholder="Your name">
            <label>Email</label>
            <input type="text" name="txtEmail" placeholder="test@example.com">
            <label> Address</label>
            <input type="text" id="adr" name="txtAddress" placeholder="542 W. 15th Street">
            <label> City</label>
            <input type="text" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label>State</label>
                <input type="text" name="txtState" placeholder="NY">
              </div>
              <div class="col-50">
                <label>Zip</label>
                <input type="text" name="txtZip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label>Accepted Cards</label>
           	<img src="images/crdit crd.JPG" width="215" height="28" />
           	<label>Name on Card</label>
            <input type="text" name="txtCardname" placeholder="John More Doe">
            <label>Credit card number</label>
            <input type="text" name="txtCardnumber" placeholder="1111-2222-3333-4444">
            <label> Exp Month</label>
            <input type="text" name="txtExpmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label>Exp Year</label>
                <input type="text" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label>CVV</label>
                <input type="text" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" value="Place order" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4><img src="images/shp cart.jpg" width="27" height="30" />Cart <span class="price" style="color:black"><b>4</b></span></h4>
      <p><a href="#">Teddy bear</a> <span class="price">$16.00</span></p>
      <p><a href="#">Remote car</a> <span class="price">$90.00</span></p>
      <p><a href="#">Cricket bat</a> <span class="price">$100.00</span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b>$206.00</b></span></p>
    </div>
  </div>
<img src="images/cover11.jpg" width="1000" height="400" /> 
</div>
</body>
</html>
