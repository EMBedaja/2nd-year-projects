<div class="header">
  <h3>Food Order Reservation</h3>
</div>
<div id="form-block" >
    <form method="POST" action="processes/process.orders.php?action=insert">
        <div id="form-block-center">
          <ul>
            <label for="sname">Customer's Name</label><br>
            <input type="text" id="sname" class="input" name="sname" placeholder="Customer's name..">
             <br><br>
            <label for="phone">Phone Number</label><br>
            <input type="tel" id="phone" class="input" name="phone" placeholder="Number.."  >
            <br><br>
            <label for="rdate">Pick-up Date</label><br>
            <input type="date" id="rdate" class="input" name="rdate" placeholder="Date..">
            <br><br>
            <label for="rdate">Pick-up Time</label><br>
            <input type="time" id="rtime" class="input" name="rtime" placeholder="Time..">
</ul>
              </div>
        <div id="button-block">
        <input type="submit" value="Create">
        </div>
  </form>
</div>