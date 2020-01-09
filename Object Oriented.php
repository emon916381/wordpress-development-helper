<?php
#------ Akhane object oriented php sokol code and document likoto thakbe -------#

//---- __get() magic mathode
class Name{
   public function __get($proparty){
        //-- Proparty ofcorse string hota hobe.. int. or any type not suppoted.
        echo $proparty;
    }
}
$get_object = new Name;
$get_object -> Emon ;




//----- Set() magic method calling
class Set_class{
    //set STRACTURE IS ($Proparty , $Valu)    proparty is not int it  always string
    function __set( $Name , $Age ){

        echo "MY NAME IS ".$Name.".<br>I AM ".$Age." YEARS OLD.";

    }
}

$object_get_class = new Set_class;
$object_get_class -> EMON = 20 ;





//--- Call() magic method calling----
class Call_class{
    //Call STRACTURE IS ($Proparty , $Valu) proparty is not int it  always string
    function __call( $Name , $Age ){
        //---- this function return data array() akare  imploade function print array data--- stracture is implode( separetor, arrayData )
       return implode("<br>",$Age)."<br>";

    }
}

$object_get_class = new Call_class;
$output = $object_get_class -> EMON("Emon", "Shepon", "Nahi", "Abdullah");
//var_dump($output);
echo $output;




//--- SUB CLASS  &  CLASS CHECK ----
class Call_class{
    public $classfound = "He is right";
}

//Check class with class_exists("class_Name") dia 
if( class_exists( "Call_class" ) ){
        # extends use kora Call_class er sub class admin make korachi  and $classfound proparty ka overright kora hoica 
        class admin extends Call_class{
            public $classfound2 = "subclass make korla main class baira thaka access kora jai na";
        }

}
//kono class er subclass make korla sub class dia access korta hoi
$class_found = new admin;
echo $class_found -> classfound2;
#[NOTE: subclass make korla main class baira thaka access kora jai na]





//spl_autoload_register()  this function load classes name automatic. We can use it load php file jei file tar nam class er sata milia rakbo;
    spl_autoload_register( function($class_name){
        include $class_name.".php";
    } );
    $cal = new functions;
    echo $cal -> calculator( 3,4 );

#[note: we also use __autoload but it not standerd]





//----- Methode chain process    of course function er vitor return $this or echo ues korta hoba
class Methode_chaining{
    public $name;
    public $age;
    public $result;

    function Biodata( $name, $age ){
        $this -> name = $name;
        $this -> age = $age;
        return $this;
    }
    function result(){
       return $this -> result = "My name".$this -> name.$this -> age ;
    }
}
$mathodeChain = new Methode_chaining;
echo $mathodeChain -> Biodata("Emon", 30) -> result();
#[NOTE: Same process to multiple proparty nia kaj kora "*echo $mathodeChain -> Biodata("Emon", 30) -> result*"]
