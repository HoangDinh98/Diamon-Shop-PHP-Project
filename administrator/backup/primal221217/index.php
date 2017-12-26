<?php
include 'include.php';
include 'header.php';
?>


<div id="page" class="dashboard">
        <div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          Welcome to the <strong>Admin Lab</strong> Theme. Please don't forget to check all the pages! </div>
        <div class="row-fluid circle-state-overview">
          <div class="span2 responsive clearfix" data-tablet="span3" data-desktop="span2">
            <div class="circle-wrap">
              <div class="stats-circle turquoise-color"><i class="icon-user"></i></div>
              <p><strong>+30</strong> New Users </p>
            </div>
          </div>
          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
            <div class="circle-wrap">
              <div class="stats-circle red-color"><i class="icon-tags"></i></div>
              <p><strong>+970</strong> Sales </p>
            </div>
          </div>
          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
            <div class="circle-wrap">
              <div class="stats-circle green-color"><i class="icon-shopping-cart"></i></div>
              <p><strong>+320</strong> New Order </p>
            </div>
          </div>
          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
            <div class="circle-wrap">
              <div class="stats-circle gray-color"><i class="icon-comments-alt"></i></div>
              <p><strong>+530</strong> Comments </p>
            </div>
          </div>
          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
            <div class="circle-wrap">
              <div class="stats-circle purple-color"><i class="icon-eye-open"></i></div>
              <p><strong>+430</strong> Unique Visitor </p>
            </div>
          </div>
          <div class="span2 responsive" data-tablet="span3" data-desktop="span2">
            <div class="circle-wrap">
              <div class="stats-circle blue-color"><i class="icon-bar-chart"></i></div>
              <p><strong>+230</strong> Updates </p>
            </div>
          </div>
        </div>

        <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
        <!-- Show firt table -->
        <div class="row-fluid">
          <div class="span12">
            <div class="widget">
              <div class="widget-title">
                <h4><i class="icon-envelope"></i> Mailbox</h4>
                <div class="tools pull-right mtop7 mail-btn">
                  <div class="btn-group"><a class="btn btn-small element" data-original-title="Share" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-share-alt"></i></a><a class="btn btn-small element" data-original-title="Report" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-exclamation-sign"></i></a><a class="btn btn-small element" data-original-title="Delete" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-trash"></i></a></div>
                  <div class="btn-group"><a class="btn btn-small element" data-original-title="Move to" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-folder-close"></i></a><a class="btn btn-small element" data-original-title="Tag" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-tag"></i></a></div>
                  <div class="btn-group"><a class="btn btn-small element" data-original-title="Prev" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-chevron-left"></i></a><a class="btn btn-small element" data-original-title="Next" href="#" data-toggle="tooltip" data-placement="top"><i class="icon-chevron-right"></i></a></div>
                </div>
              </div>
              <div class="widget-body">
                <table class="table table-condensed table-striped table-hover no-margin">
                  <thead>
                    <tr>
                      <th style="width:3%"><input type="checkbox" class="no-margin" /></th>
                      <th style="width:17%"> Sent by </th>
                      <th class="hidden-phone" style="width:55%"> Subject </th>
                      <th class="right-align-text hidden-phone" style="width:12%"> Labels </th>
                      <th class="right-align-text hidden-phone" style="width:12%"> Date </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="checkbox" class="no-margin" /></td>
                      <td> Dulal khan </td>
                      <td class="hidden-phone"><strong> Senior Creative Designer </strong><small class="info-fade"> Vector Lab </small></td>
                      <td class="right-align-text hidden-phone"><span class="label label label-info"> Read </span></td>
                      <td class="right-align-text hidden-phone"> Yesterday </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="no-margin" /></td>
                      <td> Mosaddek Hossain </td>
                      <td class="hidden-phone"><strong> Senior UI Engineer </strong><small class="info-fade"> Vector Lab International </small></td>
                      <td class="right-align-text hidden-phone"><span class="label label label-success"> New </span></td>
                      <td class="right-align-text hidden-phone"> Today </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="no-margin" /></td>
                      <td> Sumon Ahmed </td>
                      <td class="hidden-phone"><strong> Manager </strong><small class="info-fade"> ABC International </small></td>
                      <td class="right-align-text hidden-phone"><span class="label label"> Imp </span></td>
                      <td class="right-align-text hidden-phone"> Yesterday </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="no-margin" /></td>
                      <td> Rafiqul Islam </td>
                      <td class="hidden-phone"><strong> Verify your email </strong><small class="info-fade"> lorem ipsum dolor imit </small></td>
                      <td class="right-align-text hidden-phone"><span class="label label label-info"> Read </span></td>
                      <td class="right-align-text hidden-phone"> 18-04-2013 </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="no-margin" /></td>
                      <td> Dkmosa </td>
                      <td class="hidden-phone"><strong> Statement for January 2012 </strong><small class="info-fade"> Director </small></td>
                      <td class="right-align-text hidden-phone"><span class="label label label-success"> New </span></td>
                      <td class="right-align-text hidden-phone"> 10-02-2013 </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="no-margin" /></td>
                      <td> Mosaddek </td>
                      <td class="hidden-phone"><strong> You're In! </strong><small class="info-fade"> Frontend developer </small></td>
                      <td class="right-align-text hidden-phone"><span class="label label"> Imp </span></td>
                      <td class="right-align-text hidden-phone"> 21-01-2013 </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="no-margin" /></td>
                      <td> Dulal khan </td>
                      <td class="hidden-phone"><strong> Support </strong><small class="info-fade"> XYZ Interactive </small></td>
                      <td class="right-align-text hidden-phone"><span class="label label label-info"> New </span></td>
                      <td class="right-align-text hidden-phone"> 19-01-2013 </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
</div>

<?php
include 'footer.php';
?>
