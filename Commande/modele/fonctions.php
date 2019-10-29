<?php 

	function connect ()
	{
		$pdo = new PDO
				(
				 'mysql:host=localhost;dbname=model',
				 'root',
				 '',
				 [
				 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				  	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				  ]
				);
	$pdo->exec("SET NAMES UTF8");

	return $pdo;

	}
	
    
    // liste des commandes

    function listCommande(){
        $bd = connect();
        $query = $bd -> prepare("SELECT * FROM orders");

        $query -> execute();
        $list = $query -> fetchAll();

        return $list;
	}
	

	// details des commandes

	function detailCommande($idcmde){
        $bd = connect();
        $query = $bd -> prepare("
		SELECT *, round(quantityOrdered*priceEach, 2) AS total 
		FROM orderdetails 
		INNER JOIN orders ON orders.orderNumber=orderdetails.orderNumber
		INNER JOIN products ON products.productCode=orderdetails.productCode		
		WHERE orders.orderNumber = ?
		");

        $query -> execute([$idcmde]);
        $list = $query -> fetchAll();

        return $list;
	}


	// details des clients

	function Client($idcmde){
		$bd = connect();
		$query = $bd -> prepare("
		SELECT * 
		FROM customers
		INNER JOIN orders ON orders.customerNumber=customers.customerNumber
		WHERE orders.orderNumber= :numcde ");
		$query -> bindValue(':numcde', $idcmde);
		$query -> execute();
        $list = $query -> fetchAll();

        return $list;
	}