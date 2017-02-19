@extends('layouts.app')
@section('content')
    <h1>Portfolio</h1>
	<div class="container">	
	<h2>Customer</h2>
        <table class="table table-striped table-bordered table-hover">
			<tbody>
            <tr class="bg-info">
            <tr>
                <td>Cust Number</td>
                <td><?php echo ($customer['cust_number']); ?></td>
            </tr>
			<tr>
                <td>Name</td>
                <td><?php echo ($customer['name']); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo ($customer['address']); ?></td>
            </tr>
            <tr>
                <td>City </td>
                <td><?php echo ($customer['city']); ?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo ($customer['state']); ?></td>
            </tr>
            <tr>
                <td>Zip </td>
                <td><?php echo ($customer['zip']); ?></td>
            </tr>
			<tr>
                <td>Primary Email</td>
                <td><?php echo ($customer['email']); ?></td>
            </tr>
            <tr>
                <td>Home Phone</td>
                <td><?php echo ($customer['home_phone']); ?></td>
            </tr>
            <tr>
                <td>Cell Phone</td>
                <td><?php echo ($customer['cell_phone']); ?></td>
            </tr>
            </tbody>  
			</tbody>
        </table>
    </div>
	<?php
    $stocks_sum_current = 0;
	$initial_value = 0;
    ?>
	<div class="container">	
	<br>
	<h2>Stocks</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Symbol</th>
                <th>Name</th>
                <th>Shares</th>
                <th>Purchase Price</th>
                <th>Purchase Date</th>
				<th>Initial value</th>
                <th>Latest Price</th>
				<th>Current value</th>
               </tr>
            </thead>
            <tbody>
                @foreach($customer->stocks as $stock)
                    <tr>
                        <td>{{ $stock->symbol }}</td>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->shares }}</td>
                        <td>{{ $stock->purchase_price }}</td>
                        <td>{{ $stock->purchased }}</td>
						<td> <?php echo $stock['shares']*$stock['purchase_price'];
                           $initial_value = $initial_value + $stock['shares'] * $stock['purchase_price']?>
                       </td>
						<td>
							<?php
								$URL="http://finance.google.com/finance/info?client=ig&q=" . $stock->symbol;
								$file = fopen("$URL", "r");
								$r = "";
								do {
								$data = fread($file, 500);
								$r .= $data;
								} while (strlen($data) != 0);
								$json = str_replace("\n", "", $r);
								$data = substr($json, 4, strlen($json) - 5);
								$json_output = json_decode($data, true);
								$currentStockVal = "\n" . $json_output['l'];
								echo $currentStockVal;
							?>$  
						</td>
                        <td> <?php echo $stock['shares']*$currentStockVal;
                            $stocks_sum_current = $stocks_sum_current + $stock['shares'] * $currentStockVal?>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
		<h4> Initial value of stocks = <?php echo '$'."$initial_value" ?></h4>
		<h4> Current value of stocks = <?php echo '$'."$stocks_sum_current" ?></h4>
    </div>
<br>
<?php
    $ini_inv_total = 0;
    ?>
	<?php
    $cur_inv_total = 0;
    ?>
	<?php
    $total_assets = 0;
    ?>
	
	<div class="container">	
	<h2>Investments </h2>
            <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Category </th>
                <th>Description</th>
                <th>Acquired Value </th>
                <th>Acquired Date</th>
                <th>Recent Value </th>
				<th>Recent Date</th>
               </tr>
            </thead>
            <tbody>
                @foreach($customer->investments as $investment)
                    <tr>
                        <td>{{ $investment->category }}</td>
                        <td>{{ $investment->description }}</td>
                        <td>{{ $investment->acquired_value }}
						<?php $ini_inv_total = $ini_inv_total + $investment['acquired_value'] ?>
						</td>
                        <td>{{ $investment->acquired_date }}</td>
                        <td>{{ $investment->recent_value }}
						<?php
                        $cur_inv_total = $cur_inv_total + $investment['recent_value']
                        ?>
						</td>		
                        <td>{{ $investment->recent_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
		<div class="table table-striped table-bordered table-hover">
		<h4> Summation of Acquired Value Of Investments = <?php echo '$'."$ini_inv_total" ?></h4>
		<h4> Summation of Current Value Of Investments = <?php echo '$'."$cur_inv_total" ?></h4>
		<?php $total_assets = $cur_inv_total + $stocks_sum_current ?>
		<h4> Summation of all Stocks and Acquired Value Of Investments = <?php echo '$'."$total_assets" ?></h4>
		</div>
    </div>	
	@stop