<!DOCTYPE html>
<?php   
//include 'function/activitydatafuntion.php'; 
include 'function/connection.php';
?>
<html lang="en">
<head>
  <title>Sample</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Plugins/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="Plugins/node_modules/datatables/media/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="Plugins/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="Plugins/node_modules/bootstrap4-tagsinput/tagsinput.css">
  <!-- <link rel="stylesheet" href="Plugins/node_modules/moment/moment.js"> -->
  <link rel="stylesheet" href="Plugins/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<style>
  .notvalid {
    border-color:red;
  }

</style>

  <script src="Plugins/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="Plugins/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="Plugins/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="Plugins/node_modules/bootstrap4-tagsinput/tagsinput.js"></script>
  <script src="Plugins/node_modules/moment/moment.js"></script>
  <script src="Plugins/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-xs navbar-expand-sm bg-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Activities</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
  </ul>
</nav>

<div class="container-fluid" style="">
  <div class="page-heading" style="text-align:center">
  <h2>Quarantine Daily Actitivities</h2>
  </div>
  <div class="page-body">
    <div class="panel panel-default">
      <div class="panel-body" style="padding: 0px 0px"> 
        <div class="row clearfix">
          <div class="page-heading">
              <div class="col-sm-12 col-xs-12" style="text-align: right;">
                  <button type="button" class="btn btn-primary mainbtn add-btn" data-toggle="tooltip" title="Add New Member"><i class="fas fa-plus fa-icon-plus"></i></button>
                  <button type="button" class="btn btn-success mainbtn edit-btn" data-toggle="tooltip" title="Edit Member"><i class="fas fa-edit fa-edit-square"></i></button>
                  <button type="button" class="btn btn-info mainbtn activate-btn" style="display:none" data-toggle="tooltip" title="Activate Member"><i class="fas fa-check"></i></button>
                  <button type="button" class="btn btn-danger mainbtn deactivate-btn" style="display:none" data-toggle="tooltip" title="Deactivate Member"><i class="fas fa-times"></i></button>
              </div>
          </div>
          <div class='col-xs-12 col-sm-12'>
            <table id="dailyactivitytbl" class="table js-exportable table-condensed table-hover table-bordered table-striped">
              <thead>
                  <tr>
                      <th></th>
                      <th>Title</th>
                      <th>Date</th>
                  </tr>
              </thead>	
            </table> 
          </div>       
      </div>
  </div>
</div>
</div>
<!-- Modal content--> 
<div id="myModal"   class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ano ang ginawa mo ngayong araw?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
      <div class="form-group">
          <small id="" class="form-text text-muted"> Make sure you fill up all fields to ensure all  </small>
        </div>
        <div class="form-group">
          <label for="labelforTitle">Tittle</label>
          <input type="text" class="form-control" id="title" aria-describedby="Titlehelp" placeholder="Enter summary title.">
          <small id="Titlehelp" class="form-text text-muted">A great day requires a great title. </small>
        </div>
        <div class="form-group">
          <label for="labelforActivities">Activities</label>
          <input type="text" class="form-control" id="activity" data-role="tagsinput" aria-describedby="Activitieshelp" placeholder="Enter activities you did.">
          <small id="Activitieshelp" class="form-text text-muted">Dont fool yourself. </small>
        </div>
        <div class="form-group">
          <label for="labelforDate">Date</label>
          <input type="text" class="form-control" id="dateofActivity" placeholder="Date">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-btn">Save</button>
      </div>  
    </div>
  </div>
</div>
</body>

<!-- <script src="js/index.js"><script>   -->
<script>

var visitorslistTbl = $('#dailyactivitytbl').DataTable({
    fixedheader:{
        header:true
    },
    processing :true,
    responsive:true,
    paging:false,
    info:false,
    bLengthChange:false,
    bAutoWidth: true,
    pagelength:10,
    ordering:false,
    buttons: [
        'copy', 'excel', 'pdf'
    ],
ajax:{
    url:"function/activitydatafuntion.php",
    type:'get'
},
columns: [
    { defaultContent: "Lezter "},
    { data: "title" },
    { data: "date" }
]
});
$(document).ready(function(){
  var dateNow = new Date();
  console.log(dateNow);
  $('.add-btn').click(function(){
    $('#myModal').modal();
  });

  console.log(moment().format('YYYY/DD/MM'));
  $('#dateofActivity').val(moment().format('YYYY/DD/MM'));

  $('#dateofActivity').datepicker({
    defaultDate: new Date(),
    autoclose: true,  
    forceParse: false,
    todayHighlight: true,
    format: 'mm/dd/yyyy',
    endDate: 'today'
}).datepicker('setDate',new Date())
});

$('.save-btn').click(function(){
    var title = inputvalidation('title');
    var activities = inputvalidation('activity');
    var date =inputvalidation('dateofActivity');

    if(title && activities && date){
      console.log($('#activity').val());
      $.ajax({
        type:"POST",
        url:"function/insertactivitiesfunction.php",
        data:{
            title:$('#title').val(),
            activity:$('#activity').val(),
            date:$('#dateofActivity').val()
        },
        success:function(data){
          console.log(data);
          if(data){
            alert('success');
          }else{
            alert(data);

          }
        }
      });
    }

});

function inputvalidation(ID){
  console.log(ID);
        var field = $('#' + ID);
        var val = field.val();
        if (val && val !== '') {
          field.removeClass('notvalid');
          return true;
        } else {
          field.addClass('notvalid');
          return false;
        }
}


</script>
</html>