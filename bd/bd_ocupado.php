<?php
	//error_reporting( E_ALL );
	//ini_set( 'display_errors' , true );
	//ini_set( 'display_startup_errors' , true );
	/*
		-------------------------------------
		Archivo de: Alejandro Díez
		GitHub: @adilosa95
		Proyecto: the-connect-house
		Nombre del archivo: bd_ocupado.php
		-------------------------------------
	*/
	class Ocupado extends Conexion
	{
		//
		//Nombre de la tabla
		private $sTabla = '`ocupados`';
		//
		function addOcupado( $Num , $Sexo , $idPiso )
		{
			$cSql = 'INSERT INTO '.$this->sTabla.'( Num , Sexo , idPsio ) VALUES (? , ? , ? )';
			$stmt = $this->prepare( $cSql );
			$stmt->bind_param( 'isi' , $Num , $Sexo , $idPiso);
			$bResultado = $stmt->execute();
			//$stmt->error;
			if(!$bResultado)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}