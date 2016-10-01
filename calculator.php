<?php
class Calculator{
    private $answer;
    private $equation;

    public function setOperations($equation){
        $this->equation = str_replace(' ', '', $equation);
        $this->equation = str_replace('-', '+-', $this->equation);
        $this->equation = str_replace('/', '*1/', $this->equation);
    }

    public function runCalculation(){
        //$this->prefix;
        $allowedOpperands = ['*','+'];
        $lastVal = null;
        foreach ($allowedOpperands as $opperand) {
            $token = strtok($this->equation, $opperand);
            while ($token !== false){
                if(isset($lastVal)){
                    echo "\n$token";
                    $lastVal = Calculator::runOpperand ($token, $lastVal, $opperand);
                }else{
                    $lastVal = 0;
                }

                $token = strtok($opperand);


            }
        }

        $this->answer = $lastVal;
    }

    public function getAnswer(){
        return "The answer is:".$this->answer."\n";
    }

    private static function runOpperand($firstVal, $secondVal, $operation){
        echo "\nRunning operation:$firstVal $operation $secondVal";
        if($operation == '+')
            return $firstVal + $secondVal;
        else if ($operation == '*')
            return $firstVal * $secondVal;
    }
}

// Check to see if required arguments have been set
if (!isset($argv[1])) {
    echo("Please pass an equation to the calculator to solve!\n");
    exit;
} else if (isset($argv[2])) {
    echo("Please enclose your argument in quotes!\n");
    exit;
}

$calculator = new Calculator();
$calculator->setOperations($argv[1]);
$calculator->runCalculation();

echo($calculator->getAnswer());
?>
