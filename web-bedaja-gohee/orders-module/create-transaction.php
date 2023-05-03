<div class="header">
  <h3>Food Order Reservation</h3>
</div>
<div id="form-block" >
    <form method="POST" action="processes/process.orders.php?action=insert">
        <div id="form-block-center">
          <ul>
            <label for="sname">Customer's Name</label>
            <input type="text" id="sname" class="input" name="sname" placeholder="Customer's name.." style="width:500px;margin-bottom:20px;">

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" class="input" name="phone" placeholder="Number.."  style="width:500px;margin-bottom:20px;">
            <br>
            <label for="rdate">Pick-up Date</label><br><br>
            <input type="date" id="rdate" class="input" name="rdate" placeholder="Date.."style="width:300px;margin-top:-10px;">
            <br><br>
            <label for="rdate">Pick-up Time</label><br><br>
            <input type="time" id="rtime" class="input" name="rtime" placeholder="Time.."style="width:300px;margin-top:-10px;">
</ul>
              </div>
        <div id="button-block">
        <input type="submit" value="Create" style="width:98px;margin-top:-10px">
        </div>
  </form>
</div>