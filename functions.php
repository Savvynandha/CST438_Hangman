<!--
*
*Name: Tejus Nandha 
*
*Class: CST 438 
*
*Abstract: This Project was made for CST 438, it is a simple hangman game which is hosted on 
*		   Amazon AWS, specificaly on a Linux distro running Apache. Its made using PHP 
*          and some Javascript along with the obvious HTML. 
*
-->
<?php
/*
   The function insertArr has data type $WORD in index. 
*/
    function insertArr($inputFile)
    {
        $file = fopen($inputFile ,'r'); //open file 
           if ($file)
        {
            $next_pos = null;
            $line = null;
            $itter = 0;
            while (($line = fgets($file)) !== false) 
            {
                $itter++;
                if(rand() % $itter == 0) 
                {
                      $next_pos = trim($line);
                }
        }
        if (!feof($file)) 
        {
            fclose($file);
            return null;
        }else 
        {
            fclose($file);
        }
    }
        $input = str_split($next_pos);
        return $input; //return $input. 
    }

// The following functions conceals the charactrers of the chosen word. 

    function concealChar($input) //parameter of concealChar is $input which is the return type of the previous function
    {
        $totalConcealChars = floor((sizeof($input)/2) + 1);
        $itter = 0;
        $conceal = $input;
        while ($itter < $totalConcealChars )
        {
            $new_letter = rand(0,sizeof($input)-2);
            if( $conceal[$new_letter] != '_' )
            {
                $conceal = str_replace($conceal[$new_letter],'_',$conceal,$new_count);
                $itter = $itter + $new_count;
            }
        }
        return $conceal;
    }
	
	
    function incpectChange($inputLetter, $conceal, $input)
    {
        $i = 0;
        $incorrectAns  = true;
        while($i < count($input))
        {
            if ($input[$i] == $inputLetter) //checks if the input is true. 
            {
                $conceal[$i] = $inputLetter;
                $incorrectAns = false;
            }
            $i = $i + 1;
        }
        if (!$incorrectAns) $_SESSION['trys'] = $_SESSION['trys'] - 1;
        return $conceal;
    }
    
    

 // The function gameEnd keeps track of user progress. 

    function gameEnd ($TURNS,$userAttempts, $input, $conceal)
    {
        if ($userAttempts >= $TURNS) // If the user excedes the limit of trys then this executes. 
            {
                echo "Game Over. The correct word was ";
                foreach ($input as $letter) echo $letter;
                echo '<br><form action = "" method = "post"><input type = "submit" name' . 
                  ' = "next" value = "Try another Word"/></form><br>';
                die();
            }
            if ($conceal == $input) //Runs if the user wins.
            {
                echo "You won, you guessed the word: "; //lets the user know they won. 
                foreach ($input as $letter) echo $letter;
                echo '<br><form action = "" method = "post"><input ' . 
                  'type = "submit" name = "next" value = "Try another Word"/></form><br>';
                die();
				
            }
    }
?>