<style>
.table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.td, .th {
    border: 0px solid #000000;
    text-align: left;
    padding: 2px;
    font-size: 75%;
}

.table1 {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.td1, .th1 {
    border: 1px solid #000000;
    text-align: left;
    padding: 2px;
    font-size: 75%;
}

.font {
    text-align: left;
    font-size: 60%;
}

.td2, .th2 {
    border: 0px solid #000000;
    text-align: center;
    padding: 2px;
    font-size: 75%;
}

.half {
    width:100%;
    height:45%;
}

* {
 font-family: Courier;
}
</style>




<div class="container">
<div class="half">
<h4>SURAT JALAN &amp; ORDER</h4>
<table class="form-control table">
  <tr>
    <td class="td">No: <?php echo $header['order_number'] ?></td>
    <td class="td"></td>
    <td class="td"></td>
    <td class="td">Nama: <?php echo $header['name'] ?></td>
  </tr>
  <tr>
    <td class="td">Tanggal: <?php echo $header['date'] ?></td>
    <td class="td"></td>
    <td class="td"></td>
    <td class="td">Alamat: <?php echo $header['address'] ?></td>
  </tr>
  <tr>
    <td class="td"></td>
    <td class="td"> </td>
    <td class="td"> </td>
    <td class="td">No. Telp: <?php echo $header['phone_number'] ?></td>
  </tr>
 </table>

 <table class="form-control table1">
  <tr>
    <th class="th1">No</th>
    <th class="th1">Qty</th>
    <th class="th1">Nama Barang</th>
    <th class="th1">Size</th>
    <th class="th1">Satuan</th>
  </tr>
  <?php
  	$no = 1;
  	foreach($child as $val)
  	{
  	?>
  		<tr>
		    <td class="td1"><?php echo $no ?></td>
		    <td class="td1"><?php echo $val['qty'] ?></td>
		    <td class="td1"><?php echo $val['ItemName'] ?></td>
		    <td class="td1"><?php echo $val['size'] ?></td>
		    <td class="td1"><?php echo $val['UnitName'] ?></td>
		</tr>
  	<?php
  	$no +=1;
  	}
  	?>
 

 </table>

 <p class="font">NOTE: BARANG YANG SUDAH DITERIMA TIDAK DAPAT DITUKAR ATAU DIKEMBALIKAN, BARANG TELAH DITERIMA DENGAN BAIK DAN LENGKAP</p>

 <table class="form-control table">
  <tr>
    <td class="td2">Dibuat oleh ,</td>
    <td class="td2">Diperiksa,</td>
    <td class="td2">Dikirim,</td>
    <td class="td2">Diterima,</td>
  </tr>
  <tr>
    <td class="td2"&nbsp;></td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
  </tr>
  <tr>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
  </tr>
  <tr>
    <td class="td2">(&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</td>
    <td class="td2">(&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</td>
    <td class="td2">(&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</td>
    <td class="td2">(&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</td>
  </tr>
 </table>
</div>

<br>

<div class="half">
<h4>FAKTUR</h4>
<table class="form-control table">
  <tr>
    <td class="td">No: <?php echo $header['order_number'] ?></td>
    <td class="td"></td>
    <td class="td"></td>
    <td class="td">Nama: <?php echo $header['name'] ?></td>
  </tr>
  <tr>
    <td class="td">Tanggal: <?php echo $header['date'] ?></td>
    <td class="td"></td>
    <td class="td"></td>
    <td class="td">Alamat: <?php echo $header['address'] ?></td>
  </tr>
  <tr>
    <td class="td"></td>
    <td class="td"> </td>
    <td class="td"> </td>
    <td class="td">No. Telp: <?php echo $header['phone_number'] ?></td>
  </tr>
 </table>

 <table class="form-control table1">
  <tr>
    <th class="th1">No</th>
    <th class="th1">Qty</th>
    <th class="th1">Nama Barang</th>
    <th class="th1">Size</th>
    <th class="th1">Harga Satuan</th>
    <th class="th1">Total Harga</th>
  </tr>
  <?php
  	$no = 1;
  	foreach($child as $val)
  	{
  	?>
  		<tr>
		    <td class="td1"><?php echo $no ?></td>
		    <td class="td1"><?php echo $val['qty'] ?></td>
		    <td class="td1"><?php echo $val['ItemName'] ?></td>
		    <td class="td1"><?php echo $val['size'] ?></td>
		    <td class="td1">Rp <?php echo number_format($val['price']) ?></td>
		    <td class="td1">Rp <?php echo number_format($val['price']*$val['qty']*$val['size']) ?></td>
		</tr>
  	<?php
  	$no +=1;
  	}
  	?>
  	<tr>
	    <td class="td1" style="text-align: center;" colspan="5">TOTAL</td>
	    <td class="td1">Rp <?php echo $header['grand_total'] ?></td>
	</tr>
 

 </table>

 <p class="font">NOTE: BARANG YANG SUDAH DITERIMA TIDAK DAPAT DITUKAR ATAU DIKEMBALIKAN</p>

 <table class="form-control table">
  <tr>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2" style="text-align: left;">Jakarta,</td>
  </tr>
  <tr>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
  </tr>
  <tr>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
    <td class="td2">&nbsp;</td>
  </tr>
  <tr>
    <td class="td2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
    <td class="td2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
    <td class="td2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
    <td class="td2" style="text-align: left;">(&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</td>
  </tr>
 </table>

</div>

</div>