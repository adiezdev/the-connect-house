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
		/**
		 * Funcion añadir una ocupación
		 *
		 * @param $Num
		 * @param $Sexo
		 * @param $idPiso
		 *
		 * @return bool
		 */
		function addOcupado( $Num , $Sexo , $idPiso )
		{
			$cSql = 'INSERT INTO '.$this->sTabla.'( Num , Sexo , idPiso ) VALUES (? , ? , ? )';
			$stmt = $this->prepare( $cSql );
			$stmt->bind_param( 'ssi' , $Num , $Sexo , $idPiso);
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
		/**
		 * Devuelve la gente que hay en un piso por la ID
		 *
		 * @param $nIdPsio
		 *
		 * @return array
		 */
		function getById( $nIdPiso )
		{
			$aOcupado = array();
			$cSql = 'SELECT * FROM '.$this->sTabla.' WHERE idPiso = ? ORDER BY Sexo';
			$stmt = $this->prepare($cSql);
			$stmt->bind_param('i', $nIdPiso );
			$stmt->execute();
			$oResultado = $stmt->get_result();
			while( $oRecord = $oResultado->fetch_object())
			{
				$aOcupado[] = $oRecord;
			}
			return $aOcupado;
		}
	}