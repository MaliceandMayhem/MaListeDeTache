<?php

/** Header php obligatoire **/
header("Content-type: text/css");

$font_family = 'Montserrat, sans-serif';
$font_size = '0.7em';
$border = '1px solid';
?>

body {
    padding: 0px;
    margin: 0px;
    font-family:"montserrat", sans-serif;
    font-size:90%;
    background-color: #FF983B;

 }



.title-word {
  animation: color-animation 4s linear infinite;
}

.title-word-1 {
  --color-1: #EE5397;
  --color-2: #634490;
  --color-3: #3466A5;
}

.title-word-2 {
  --color-1: #FF983B;
  --color-2: #AA3A39;
  --color-3: #FE4E4E;
}

.title-word-3 {
  --color-1: #00C4D4;
  --color-2: #3466A5;
  --color-3: #EE5397;
}

.title-word-4 {
  --color-1: #634490;
  --color-2: #FE4E4E;
  --color-3: #00C4D4;
}

@keyframes color-animation {
  0%    {color: var(--color-1)}
  32%   {color: var(--color-1)}
  33%   {color: var(--color-2)}
  65%   {color: var(--color-2)}
  66%   {color: var(--color-3)}
  99%   {color: var(--color-3)}
  100%  {color: var(--color-1)}
}

.banniere {
  display: flex;
  flex-direction: row;  
  justify-content: center;
  background-color: white;
}

.titre {
  font-family: "Montserrat", sans-serif;
  font-size: 30px;
  font-weight: 800;
  text-transform: uppercase;
}


form{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    margin-left: 5px;
    margin-top: 5px;

}

.bloc {
    padding:4px;
    width:250px;
    margin-bottom:12px;
    border-radius: 20px;
    box-shadow: 10px 5px 5px rgba(0, 0, 255, .2);
    color: white;
    text-align: center;
}

#ajout {
    background-color:#FE4E4E;

 }

#maj {
    background-color:#EE5397;
    height: 80px;
 }

#supprimer {
    background-color:#634490;
    height: 120px;
 }

#archivage {
    background-color:#3466A5;
    height: 120px;
 }

#destroy {
    background-color:#00C4D4;
    height: 55px;
 }

input, textarea, select, option {
  background-color: rgba(0, 0, 255, .2);
  color: white;
  box-shadow: 10px 5px 5px rgba(0, 0, 255, .1);
 }
input, textarea, select {
 padding:3px;
 border: none;
 width:200px;
 }

input[type=submit]{
  border-radius: 10px;
  border: 4px;
  color: white;
  background-color: #778899;
  text-align: center;
  font-size: 90%;
  padding: 5px;
  width: 150px;
  cursor: pointer;
  box-shadow: 10px 5px 5px rgba(0, 0, 255, .2);
 }

#nom{
  margin: 20px;
  color: white;
  background-color: #AA3A39;
  width: 30%;
  padding-left: 10px;
  margin-left: 500px;
}
