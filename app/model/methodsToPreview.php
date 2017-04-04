<?php 

/**
* View
* Method generate to 'preview class';
* This class generate all methods getters, setters and contruct for preview.
* The model class generate for this class is formatted. (colors methos, colors attibutes, color construct)
*/
class GeneratePreviewMethods{

    private $atributos = array(); //Array attributes
    private $className; //Class name

    /*
    * Construct
    * @className name of the class (get from front form)
    */
    function __construct($className)
    {
        $this->className = $className;  
    }

    /*
    * setter attibutes
    * @variaveis attributes array
    */
    public function setVariaveis($variaveis){
        $this->atributos = $variaveis;
    }
    /*
    public function toUperFirstChar(){
        foreach ($this->atributos as $variavel) {
            echo strtoupper(substr($variavel,0,1));
        }
    }*/

    //return array attributes
    public function getVariaveis(){
        return $this->atributos;
    }

    //return class name
    public function getClassName(){
        return $this->className;
    }

    /*
    * This method create a default construct (void construct)
    * return 'string' default construct formated [void]
    */
    public function generateDefaultConstruct(){
        $constructEachLine = $this->identationSpace(4)."<strong>function __construct</strong>(){<br>".$this->identationSpace(4)."}<br><br>";
        return $constructEachLine;
    }

    /*
    * This method create a contruct from attributes
    * return 'array' 
    */
    public function generateConstruct(){
        $Constructparameters = null; //parameters of the construct (function __construct(<p1,p2...>))
        $constructArray = array(); //formated construct
        $cont = 0; //array counter
        $constructEachLine; //each line from construct array

        foreach ($this->atributos as $value) {
            $value = "$".$value;
            $Constructparameters = $Constructparameters.",".$value; //construct parameters formated ($p1, $2...)
        }

        //construct head "function __construct($p1,$p2)"
        $constructEachLine = $this->identationSpace(4)."<strong>function __construct</strong>(".$Constructparameters."){";
        
        //loop on all attributes from model
        foreach ($this->atributos as $variavel) {
            //attributes formated " $this->p1 = $p1;"
            //identation attributes [8]
            $constructEachLine = $constructEachLine."<br>".$this->identationSpace(8).'$this->'.$variavel." = $".$variavel.";";
        }

        //last line from construct - indentation line [4] '}'
        $constructArray[$cont] = $constructEachLine."<br>".$this->identationSpace(4)."}<br><br>";
        $cont++;
        return $constructArray;
    }

    /**
    * Generate the setters methods
    */
    public function generateSetters(){
        $settersArray = array(); //formated setter
        $cont = 0; //counter array
        $setterEachLine; //each line from setter formated method

        //loop on all attributes from model
        foreach ($this->atributos as $variavel) {
            //head setter
            $setterEachLine = $this->identationSpace(4).'<strong>public function set'.ucfirst($variavel).'</strong>($'.$variavel.'){
                <br>'.$this->identationSpace(8).'$this->'.$variavel.' = $'.$variavel.'; <!-- attributes formated line - indent [8] -->
                <br>'.$this->identationSpace(4).'}<br>'; //last line - indentation [4]
            $settersArray[$cont] = $setterEachLine;
            $cont++;
        }
        return $settersArray;
    }

    /*
    * Generate getters methos
    */
    public function generateGetters(){
        $gettersArray = array(); //formated getter
        $cont = 0; //counter array

        foreach ($this->atributos as $variavel) {
            //head method
            $resul = $this->identationSpace(4).'<strong>public function get'.ucfirst($variavel).'()</strong>{
                <br>'.$this->identationSpace(8)
                .'<strong>return</strong> $this->'.$variavel.';<br>' //return line
                .$this->identationSpace(4).'}<br>'; //last line
            $gettersArray[$cont] = $resul;
            $cont++;
        }
        return $gettersArray;
    }

    /**
    * Indentation SPACE method
    * &nbsp space
    * \t TAB
    */
    public function identationSpace($indentationNumber){
        return str_repeat("&nbsp",$indentationNumber);
    }

    /**
    * Indentation TAB method
    * &nbsp space
    * \t TAB
    */
    public function identationTab($indentationNumber){
        return str_repeat("\t",$indentationNumber);
    }   
}
?>