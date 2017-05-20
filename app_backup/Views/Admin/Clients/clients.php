<div class="row" style='margin-top:20px;'>
    <div class="col-lg-3 col-md-6">
        <div class="card-box" style="cursor:pointer" onclick="if (link) window.location ='<?php echo site_url("Admin/Clients") ?>'">
            <div class="widget-box-2">
                <div class="widget-detail-2">
                    <span class="badge badge-success pull-left m-t-20">Goal: 100 <i class="fa fa-arrow-right"></i> </span>
                    <h2 class="m-b-0"> <?php echo $data['clientCount'];?> </h2>
                    <p class="text-muted m-b-25">Clients</p>
                </div>
                <div class="progress progress-bar-success-alt progress-sm m-b-0">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $data['clientCount'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $data['clientCount'];?>%;">
                        <span class="sr-only"><?php echo $data['clientCount']; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <a href="<?php echo site_url("Admin/Clients/Create")?>" class="btn btn-success btn-md" style="width:100%;">
            <i class="fa fa-plus"></i> Add Client
        </a>
    </div>
</div>

<div class="row">
	<div class="col-sm-12">

		<div class="card-box table-responsive" style="margin-top:20px;">
                    <table id="datatable-buttons" class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Type</th>
						<th>Name</th>
						<th>Description</th>
						<th>URL</th>
					</tr>
				</thead>

				<?php

				foreach($clients as $client){
					echo "
					<tr style='cursor:pointer' onclick='if (link) window.location =\"".site_url("Admin/Clients/$client->id/Dashboard")."\"'>
						<td>".$client->id."</td>
						<td>".$client->type_title."</td>
						<td>".$client->name."</td>
						<td>".$client->description."</td>
						<td>".$client->url."</td>
					</tr>";
					//var_dump($client);
				}


				?>

				</tbody>
			</table>

		</div>
	</div>
</div>
