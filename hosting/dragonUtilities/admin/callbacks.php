<?php
require_once("../models/config.php");

$callbacks = fetchCallbacks();
$countCallbacks = countCallbacks();

require_once("includes/header.php");
require_once("includes/sidebar.php");

echo "
<main class='mdl-layout__content mdl-color--grey-100 page ng-scope' ng-view=''><section ng-controller='DashboardController' class='ng-scope'>

<div class='demo-header-color relative clear ' style='min-height: 220px;'>
<div class='f-right m-30 hide-from-tablet'>

</div>
<div class='p-20'>
<h4 class='mdl-color-text--white m-t-20 m-b-5'>Callbacks</h4>
<h5 class='mdl-color-text--white m-b-25 no-m-t w100'></h5>
</div>
</div>

<div class='mdl-grid mdl-grid--no-spacing mdl-grid-p-15 cards-top' style='padding-bottom: 0px;'>
    <div class='mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet p-r-10-tablet'>
      <div class='mdl-card mdl-shadow--0dp  mdl-color--cyan'>
        <div class='mdl-card__title block'>
          <h4 class='mdl-card__title-text mdl-color-text--white f15 w600'>Count:</h4>
        </div>
        <div class='p-15'>
			<h2 class='no-margin mdl-color-text--white '>".$countCallbacks."</h2>
        </div>
      </div>
    </div> 

  </div>
  
<table class='table table-hover'>
	<thead>
		<tr>
			<th>#ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Status</th>
			<th>Agent ID</th>
		</tr>
	</thead>
	<tbody>";
	
foreach ($callbacks as $c1){
	echo "<th scope='row'> ".$c1['id']."</th>";	
	echo "<td>".$c1['name']."</th>";		
	echo "<td>".$c1['email']."</th>>";	
	echo "<td>".$c1['phonenumber']."</th>";
	echo "<td>".$c1['status']."</th>";
	echo "<td>".$c1['agentId']."</th>";
}
		
echo "</tbody>
</table>
";

require_once("includes/footer.php");

?>