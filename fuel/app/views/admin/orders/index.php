<h2>Orders</h2>

<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Date</th>
			<th>User</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $orders as $order ) : ?>
			<tr>
				<td><?= $order->id ?></td>
				<td><?= date( 'd/m/Y', $order->created_at ) ?></td>
				<td><?= ucfirst( $order->user->first_name ) ?> <?= strtoupper( $order->user->last_name ) ?></td>
				<td><?= $order->total ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>