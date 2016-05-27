<?php
//Conexion.class.php se encarga de crear la instancia unica del objeto

require_once "config.php";
class Conexion {

private static $_instancia;
private $_db;

 public static function getInstance() {
  if(!self::$_instancia) {
   self::$_instancia = new self();

                 }
  return self::$_instancia;
 }


   private function __construct() {

        $this->db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
        // selecting database

        if (!$this->db) {
            die('No pudo conectarse: ' . mysql_error());
        }
        mysqli_select_db($this->db,DB_DATABASE);

   }


   public function insertar($sql)
   {

     if(!is_null($this->db)){

       //$stmt = $this->db->query($sql);
        if ($this->db->query($sql) === TRUE)
        {
            //echo "Nuevo contacto agregado<br>";
            return true;
        } else {
            //echo "Error: " . $sql . "<br>" . $this->db->error;
            return $this->db->error;
        }


          try{
            $this->CloseConnection();
            //echo "conexion cerrada";
          }
          catch(Exception $e){
            echo $e.getmessage();
          }
        }
      }

  public function consultar($sql){
    if(!is_null($this->db))
    {
      $tildes = $this->db->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
      $result = mysqli_query($this->db,$sql);

         try{
           $this->CloseConnection();
           //echo "conexion cerrada";
           return $result;
         }
         catch(Exception $e){
           echo $e.getmessage();
           return null;
         }
       }
  }
  public function eliminar($sql){
    if(!is_null($this->db)){

       $this->db->query($sql);
      $stmt= $this->db->affected_rows;

       if ($stmt>0)
       {
           return true;
       } else {
           //echo "Error: " . $sql . "<br>" . $this->db->error;
           return false;
       }
         try{
           $this->CloseConnection();
           //echo "conexion cerrada";
         }
         catch(Exception $e){
           return $e.getmessage();
         }
       }
  }
  public function modificar($sql)
  {

    if(!is_null($this->db)){

      //$stmt = $this->db->query($sql);
        $this->db->query($sql);
        $stmt= $this->db->affected_rows;
       if ($stmt>0)
       {
           return true;
       } else {
           return false;
       }


         try{
           $this->CloseConnection();
           //echo "conexion cerrada";
         }
         catch(Exception $e){
          return  $e.getmessage();

         }
       }
     }

   public function getConnection() {
     return $this->db;
 }

    public function CloseConnection(){
        //return $this->db=null;
          return $this->db->close();
    }

    public function __clone(){
         trigger_error('No esta permitido clonar esta clase', E_USER_ERROR);
    }

    public function __wakeup(){
         trigger_error("No puede deserializar una instancia de ". get_class($this) ." class.", E_USER_ERROR );
    }
}
?>
