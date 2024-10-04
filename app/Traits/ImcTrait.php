<?php

namespace App\Traits;

trait ImcTrait
{

    public function calculateIMC($peso, $estatura)
    {

        if($estatura == 0 || $peso == 0){
            return [
                'titleImc' => 'Error',
                'url' => 'error.png'
            ];
        }

        $estatura = $estatura / 100;
        $imc = round($peso / ($estatura * $estatura));

        return $this->clasificacionIMC($imc);
    }


    protected function clasificacionIMC($imc)
    {

        $imcData = [];

        if ($imc < 18.5) {
            $imcData =  [
                'titleImc' => 'Bajo peso',
                'url' => 'bajo-peso.png'
            ];
        } elseif ($imc >= 18.5 && $imc <= 24.9) {
            $imcData =  [
                'titleImc' => 'Normal',
                'url' => 'normal.png'
            ];
        } elseif ($imc >= 25 && $imc <= 29.9) {
            $imcData =  [
                'titleImc' => 'Sobrepeso',
                'url' => 'sobrepeso.png'
            ];
        } elseif ($imc >= 30) {
            $imcData =  [
                'titleImc' => 'Obesidad',
                'url' => 'obesidad.png'
            ];
        } else {
            $imcData =  [
                'titleImc' => 'Error',
                'url' => 'error.png'
            ];
        }

        return $imcData;
    }
    
}
