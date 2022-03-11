<!-- BEGIN: main -->
<form action="{FORM_ACTION}" method="POST">
  <div class="form-group">
    <label >Your Name</label>
    <input type="text" name="fullName" class="form-control" placeholder="Enter your name" value="{POST.fullName}">
  </div>
  <div class="form-group">
    <label >Message</label>
    <textarea class="form-control" name="messages" rows="8">{POST.messages}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Notice</button>
</form>
<!-- END: main -->
