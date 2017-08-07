<?php

require 'vendor/autoload.php';
require 'libs/NotOrm.php';

$app = new \Slim\app;

$app->get('/', function(){
    echo "hello restjurnal";
});

//menambahkan data univ
$app->post('/universitas', function($request){
    require_once('db.php');

    $q = "insert into tbl_univ (nama_univ,telp,alamat,jurnal_root) values(?,?,?,?)";
    $input = $db->prepare($q);
    $input->bind_param("sssi", $nama, $telp, $alamat, $jroot);
    $nama = $request->getParsedBody()['nama'];
    $telp = $request->getParsedBody()['telp'];
    $alamat = $request->getParsedBody()['alamat'];
    $jroot = $request->getParsedBody()['jurnal_root'];
    $input->execute();

    if($input){
        echo json_encode(array(
            'status'    => (bool) $input,
            'message'   => 'Data berhasl ditambahkan'
        ));
    }else{
        echo json_encode(array(
            'status'    => (bool) $input,
            'message'   => 'Gagal menambahkan data'
        ));
    }
});

//tambah data jurnal
$app->post('/jurnal', function($request){
    require_once('db.php');

    $q = "insert into tbl_jurnal (id_univ,nama_jurnal,url_jurnal) values(?,?,?)";
    $input = $db->prepare($q);
    $input->bind_param("iss", $id_univ, $nama_jurnal, $url_jurnal);
    $id_univ = $request->getParsedBody()['id_univ'];
    $nama_jurnal = $request->getParsedBody()['nama_jurnal'];
    $url_jurnal = $request->getParsedBody()['url_jurnal'];


    $input->execute();

    if($input){
        echo json_encode(array(
            'status'    => (bool) $input,
            'message'   => 'Data berhasl ditambahkan'
        ));
    }else{
        echo json_encode(array(
            'status'    => (bool) $input,
            'message'   => 'Gagal menambahkan data'
        ));
    }
});

//melihat jurnal tertentu
$app->get('/jurnal/{id_jurnal}', function($request){
    require_once('db.php');
    $id = $request->getAttribute('id_jurnal');
    $query = 'select * from tbl_jurnal where id='.$id;
    $res = $db->query($query);

    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }
    echo json_encode($data);
});

//menampilkan data univ
$app->get('/universitas', function(){
    require_once('db.php');
    $query = "select * from tbl_univ";
    $res = $db->query($query);

    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }

    echo json_encode($data);
});

//menampilkan data jurnal root
$app->get('/jurnal_root', function(){
    require_once('db.php');
    $q = 'select * from tbl_jurnal_root';
    $res = $db->query($q);

    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }

    echo json_encode($data);
});

//menampilkan data jurnal
$app->get('/jurnal', function(){
    require_once('db.php');
    $q = 'select * from tbl_jurnal';
    $res = $db->query($q);

    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }

    echo json_encode($data);
});

//menampilkan data jurnal berdasarkan univ
$app->get('/jurnal/univ/{id_univ}', function($request){
    require_once('db.php');
    $id = $request->getAttribute('id_univ');
    $query = "select a.* from tbl_jurnal a join tbl_univ b on a.id_univ=b.id where b.id=$id";
    $res = $db->query($query);

    while($row = $res->fetch_assoc()){
        $data[] = $row;
    }

    if($res->num_rows>0){
        echo json_encode($data);
    }else{
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Data tidak ditemukan'
        ));
    }
});

//update data univ
$app->put('/universitas/{id_univ}', function($request){
    require_once('db.php');
    $id = $request->getAttribute('id_univ');
    $query = 'update tbl_univ set nama_univ=?,telp=?,alamat=?,jurnal_root=? where id='.$id;
    $req = $db->prepare($query);
    $req->bind_param("sssi", $nama, $telp, $alamat,$jroot);
    $nama = $request->getParsedBody()['nama_univ'];
    $telp = $request->getParsedBody()['telp'];
    $alamat = $request->getParsedBody()['alamat'];
    $jroot = $request->getParsedBody()['jurnal_root'];
    $req->execute();

    if($req){
        echo json_encode(array(
            'status'    => true,
            'message'   => 'Data berhasil diupdate'
        ));
    }else{
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Gagal update data'
        ));
    }
});

//update data jurnal
$app->put('/jurnal/{id_jurnal}', function($request){
    require_once('db.php');
    $id = $request->getAttribute('id_jurnal');
    $query = 'update tbl_jurnal set id_univ=?,nama_jurnal=?,url_jurnal=? where id='.$id;
    $req = $db->prepare($query);
    $req->bind_param("iss", $id_univ, $nm_jurnal, $url_jurnal);
    $id_univ = $request->getParsedBody()['id_univ'];
    $nm_jurnal = $request->getParsedBody()['nm_jurnal'];
    $url_jurnal = $request->getParsedBody()['url_jurnal'];

    $req->execute();

    if($req){
        echo json_encode(array(
            'status'    => true,
            'message'   => 'Data berhasil diupdate'
        ));
    }else{
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Gagal update data'
        ));
    }
});

//hapus data univ
$app->delete('/universitas/{id_univ}', function($request){
    require_once('db.php');
    $id = $request->getAttribute('id_univ');
    $query = 'delete from tbl_univ where id='.$id;
    $res = $db->query($query);

    if($res){
        echo json_encode(array(
            'status'    => true,
            'message'   => 'Data berhasil dihapus'
        ));
    }else{
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Gagal hapus data'
        ));
    }
});

//hapus data jurnal
$app->delete('/jurnal/{id_jurnal}', function($request){
    require_once('db.php');
    $id = $request->getAttribute('id_jurnal');
    $query = 'delete from tbl_jurnal where id='.$id;
    $res = $db->query($query);

    if($res){
        echo json_encode(array(
            'status'    => true,
            'message'   => 'Data berhasil dihapus'
        ));
    }else{
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Gagal hapus data'
        ));
    }
});



$app->run();



// NotOtm
/* 
$dbname = "restjurnal";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";

$dbmeth = "mysql:dbname=";

$dsn = $dbmeth.$dbname;

$pdo = new PDO($dsn, $dbuser, $dbpass);
$db  = new NotOrm($pdo);


$app->get('/universitas', function() use($app, $db){
    foreach($db->tbl_univ() as $data){
        $univ['pt'][] = array(
            'id_univ'   => $data['id'],
            'nama_univ' => $data['nama_univ'],
            'alamat'    => $data['alamat'],
            'telp'      => $data['telp'],
            'jurnal_root'   => $data['jurnal_root']
        );
    }

    echo json_encode($univ);
});

$app->get('/rootjurnal', function() use($app, $db){
    foreach($db->tbl_jurnal_root() as $data){
        $root['jurnal'][] = array(
            'id_jurnal' => $data['id'],
            'nama'      => $data['nama_jurnal'],
            'url'       => $data['url_jurnal']
        );
    }
    echo json_encode($root);
});

$app->get('/jurnal/{id}', function($request, $response, $args) use($app, $db){
    $jurnal = $db->tbl_jurnal()->order('tbl_univ.id');
    if($res = $jurnal->fetch()){
        echo json_encode(array(
            'id_jurnal' => $res['id'],
            'id_univ'   => $res['id_univ'],
            'nama'      => $res['nama_jurnal'],
            'url'       => $res['url_jurnal']
        ));
    }else{
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Data tidak ditemukan'
        ));
    }

});

*/