<?php
class Modelo{

  private $customers;
  private $db;

  public function __construct(){
      $this->customers=array();
      $this->db=new PDO('mysql:host=localhost;dbname=consultorio',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT * FROM customers";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->customers[]=$tabla;
      }
      return $this->customers;
    }
    public function insertar($data) {
        try {
            // Consulta SQL para insertar datos
            $query = "INSERT INTO customers (dnipa, nombrep, apellidop, seguro, tele, sexo, cargo, estado, fecha_create, fecha_nacimiento) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
            
            // Preparar y ejecutar la consulta con los parámetros adecuados
            $stmt = $this->db->prepare($query);
            $stmt->execute(array(
                $data->dnipa,
                $data->nombrep,
                $data->apellidop,
                $data->seguro,
                $data->tele,
                $data->sexo,
                $data->cargo,
                $data->estado,
                $data->fecha_nacimiento
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
  public function actualizar($tabla,$data,$condicion){
      $consulta="UPDATE $tabla SET $data WHERE $condicion";
      $resultado=$this->db->query($consulta);
      if($resultado){
          return true;
      }else{
          return false;
      }
  }
}

 ?>
