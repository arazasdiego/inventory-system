  <div class="modal fade" id="po_damage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">Returned Products</h4>
	</div>
							
	<div class="modal-body">
	<table class="table" style="font-size: 16px; ">
	<thead>
	<tr class="success">
		<th>Product</th>
		<th width="10%">Returned Goods</th>
		<th>Reason</th>
		<th>Description</th>
		<th>Date Added</th>
		<th>Action</th>

	</tr>	
	</thead>
	<tbody>
	<?php
	while ($row2 = $sql2->fetch_assoc()) {
		echo '<tr>';

		echo '<td>' .$row2['ProdName']. '</td>';

		echo '<td>' .$row2['Qty']. '</td>';

		echo '<td>' .$row2['ReasonName']. '</td>';

		echo '<td>' .$row2['DamagedDesc']. '</td>';

		echo '<td>' .$row2['DateAdded']. '</td>';

		echo '<td><a href="po_damage-exec.php?damagedid=' .$row2['DamagedID']. '&poid=' .$poid. '">

		<img src="icons/delete.png" style="width: 25px; height: 25px;" title="Cancel damage report" />
		</a></td>';

		echo '</tr>';
	}
	?>		

	</tbody>
	</table>	
	

    </div>
	
   	


	<div class="modal-footer">
	

	</form>
	
	</div>


	</div>
	<!-- /.modal-content -->
	
	</div><!-- /.modal-dialog -->
	
	</div>