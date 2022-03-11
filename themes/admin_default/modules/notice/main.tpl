<!-- BEGIN: main -->
<table class="table">
  <thead style="display: table;
  width: 100%;
  table-layout: fixed;">
    <tr>
       <th>STT</th>
        <th>Sender</th>
        <th>Message</th>
        <th>Created at</th>
    </tr>
  </thead>
  <tbody style="display: block; overflow-Y:scroll; max-height:50vh">
    <tr>
      <!-- BEGIN: loop -->
        <tr style="display: table;
  width: 100%;
  table-layout: fixed;">
            <td>{NOTICE.id}</td>
            <td>{NOTICE.sender}</td>
            <td style="overflow-X: hidden; text-overflow:ellipsis;">{NOTICE.message}</td>
            <td>{NOTICE.created_at}</td>
        </tr>
        <!-- END: loop -->
    </tr>
</tbody>
<!-- END: main -->
