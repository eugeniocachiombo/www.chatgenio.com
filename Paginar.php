 <?php
 
     Class Paginar {

   private int $num;
      private int $activo;

   function __construct(){
    $this->num = 0;
     $this->activo = false;
   }
   public function setNum(int $num){
        $this->num = $num;
   }

   public function getNum(){
         return $this->num;
    }

    public function setActivo(int $activo){
     $this->activo = $activo;
}

     public function getActivo(){
      return $this->activo;
     }

   
    

    }

    ?>