<?php

$connect = new PDO("mysql:host=localhost; dbname=db_barang", "root", "");
$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->action == 'fetchall')

{

$query = "SELECT * FROM barang";

$statement = $connect->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))

{
$data[] = $row;

}

echo json_encode($data);
}

if($received_data->action == 'insert')

{
$data = array(

:kode' => $received_data->kode,

:nama' => $received_data->nama,
:kategori' => $received_data->kategori,

:stok' => $received_data->stok,

:harga' => $received_data->harga,

);

$query = "

INSERT INTO barang

VALUES (null, :kode, :nama, :kategori, :stok, :harga)

$statement = $connect->prepare($query);

$statement->execute($data);

$output = array(

'message' => 'Data berhasil ditambahkan'
);

echo json_encode($output);

}

if($received_data->action == 'delete')

{

$query = "

DELETE FROM barang

WHERE id = "".$received_data->id."

$statement = $connect->prepare($query);

$statement->execute();

$output = array(

'message' => 'Data berhasil dihapus'
);

echo json_encode($output);

}

?>