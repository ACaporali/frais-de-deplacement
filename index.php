<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=api;charset=utf8', 'root', '');
        //$bdd = new PDO('mysql:host=alicecapdvroot.mysql.db;dbname=alicecapdvroot;charset=utf8', 'alicecapdvroot', '7Cbxsr1995');
	}catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
	}
if(isset($_GET['city1']) && isset($_GET['city2'])){
    $get_data = $bdd->query("SELECT * FROM `api_cities_distance` WHERE `id_cityStart` = '".$_GET['city1']."' and `id_cityEnd` = '".$_GET['city2']."'");
    $data = $get_data->fetchAll();
    echo json_encode($data);
}else{
    echo 'Veuillez ajouter ?city1=voiron&city2=grenoble dans l\'URL';
}
?>
