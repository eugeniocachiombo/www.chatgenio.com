 <?php
 
class Paginar {

     private $num;
     private  $activo;

     function __construct(){
          $this->num = 0;
          $this->activo = false;
     }

     public function setNum ($num){
        $this->num = $num;
     }

     public function getNum(){
         return $this->num;
     }

     public function setActivo( $activo){
          $this->activo = $activo;
     }

     public function getActivo(){
          return $this->activo;
     }

}

?>