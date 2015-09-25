<?php

require_once __DIR__ . '/../../modelo/9box/Evaluacion.php';
require_once __DIR__ . '/../../modelo/9box/Pregunta.php';
require_once __DIR__ . '/../../modeloNegocio/core/ModeloNegocioBase.php';

class EvaluacionNegocio extends ModeloNegocioBase {

    public function getAll($evaluacionId, $usuarioId) {
        return Evaluacion::create()->getAll($evaluacionId, $usuarioId);
    }

    public function save($anioId, $usuarioId, $estado, $usuarioCreacion) {
        return Evaluacion::create()->save($anioId, $usuarioId, $estado, $usuarioCreacion);
    }

    public function delete($evaluacionId) {
        return Evaluacion::create()->delete($evaluacionId);
    }

    public function getAllPreguntas($evaluacionId) {
        return Pregunta::create()->getAll($evaluacionId);
    }

    public function savePregunta($formatoId, $evaluacionId, $valor, $estado, $usuarioCreacion) {
        return Pregunta::create()->save($formatoId, $evaluacionId, $valor, $estado, $usuarioCreacion);
    }

    public function savePreguntas($evaluacionId, $preguntas, $enviar, $usuarioCreacion) {
        if (ObjectUtil::isEmpty($preguntas))
            throw new WarningException("No se especificaron preguntas para guardar");
        $valida = Evaluacion::create()->valida($evaluacionId);
        if (ObjectUtil::isEmpty($valida)) {
            throw new WarningException("No se puedo validar");
        } else {
            if ($valida[0]["vout_estado"] == 0) {
                throw new WarningException($valida[0]["vout_mensaje"]);
            }
        }
        foreach ($preguntas as $pregunta) {
            Pregunta::create()->save($pregunta['formato_id'], $evaluacionId, $pregunta['valor'], 1, $usuarioCreacion);
        }
        if ($enviar) {
            $this->setMensajeEmergente(Evaluacion::create()->finaliza($evaluacionId));
        } else
            $this->setMensajeEmergente("Las preguntas se registraron de manera correcta");
    }

    public function reporteGetInmediato($usuarioId) {
        return Evaluacion::create()->reporteGetInmediato($usuarioId);
    }

    public function reporteGetTotal($usuarioId) {
        $evaluaciones = Evaluacion::create()->reporteGetInmediato($usuarioId);
        foreach ($evaluaciones as $evaluacion) {
            $evaluacionesHijos = $this->reporteGetTotal($evaluacion['usuario_id']);
            $evaluaciones = $this->reporteGetTotalAdd($evaluaciones, $evaluacionesHijos);
        }
        return $evaluaciones;
    }

    public function reporteGetRRHH($usuarioId) {
        return Evaluacion::create()->reporteGetRRHH($usuarioId);
    }

    private function reporteGetTotalAdd($evaluaciones, $evaluacionesHijos) {
        if (!ObjectUtil::isEmpty($evaluacionesHijos)) {
            foreach ($evaluacionesHijos as $evaluacionHijo) {
                array_push($evaluaciones, $evaluacionHijo);
            }
        }
        return $evaluaciones;
    }

    public function reporteGetNineBox($evaluacionValor, $prpValor) {
        if (ObjectUtil::isEmpty($evaluacionValor) || !is_numeric($evaluacionValor))
            throw new WarningException("El valor de la evaluación no es correcto");
        if (ObjectUtil::isEmpty($prpValor) || !is_numeric($prpValor))
            throw new WarningException("El valor de PRP no es correcto");
        
        if ($evaluacionValor > 80) {
            if ($prpValor == 1 || $prpValor == 2) {
                return $this->reporteGetNineBoxReturn("B3", "B3 NEW AT THE POSITION", "USUALLY, THIS IS THE SITUATION OF AN EMPLOYEE WHO IS NEW AT THE POSITION. SO, HE/SHE PRESENTS LOW PERFORMANCE – DUE TO HIS/HER ADAPTATION – BUT HIGH POTENTIAL. IF THE EMPLOYEE IS NOT NEW AT THE POSITION, IT IS IMPORTANT TO INVESTIGATE THE INTERNAL AND EXTERNAL FACTORS THAT MAY BE INTERFERING ON THEIR PERFORMANCE. IT IS NECESSARY TO DEFINE AN ACTION PLAN TO SOLVE ANY PROBLEMS.");
            } else if ($prpValor == 3) {
                return $this->reporteGetNineBoxReturn("B6", "B6 POSSIBLE PROGRESSION AFTER ACHIEVING POTENTIAL", "THE EMPLOYEE HAS POTENTIAL, BUT THERE IS EVIDENCE OF NECESSARY IMPROVEMENTS ON HIS/HER PERFORMANCE. THUS, THE EMPLOYEE HAS THE POSSIBILITY OF PROGRESSING IN HIS/HER CAREER, BUT FIRST HE/SHE MUST GIVE CLEAR SIGNS OF BEING TURNING SUCH POTENTIAL INTO PERFORMANCE.");
            } else if ($prpValor == 4 || $prpValor == 5) {
                return $this->reporteGetNineBoxReturn("B9", "B9 POTENTIAL BEYOND THE POSITION", "HERE ARE THE HIGH-POTENTIAL PROFESSIONALS, THAT IS, THOSE GREAT TALENTS IN THE COMPANY. BESIDES THEIR HIGH PERFORMANCE, THEY ARE ABLE TO GROW EVEN MORE. THOSE PROFESSIONALS ARE READY TO TAKE NEW POSITIONS WITH HIGHER COMPLEXITY.");
            }
        } else if ($evaluacionValor > 51) {
            if ($prpValor == 1 || $prpValor == 2) {
                return $this->reporteGetNineBoxReturn("B2", "B2 POTENTIAL TO IMPROVE THE PERFORMANCE", "THE EMPLOYEE DOES NOT DELIVERY WHAT IS EXPECTED OF HIM/HER, BUT THERE IS EVIDENCE OF DEVELOPMENT POTENTIAL. THUS, IT IS RECOMMENDED TO INVEST ON TRAINING THE EMPLOYEE.");
            } else if ($prpValor == 3) {
                return $this->reporteGetNineBoxReturn("B5", "B5 POSSIBILITY TO CHANGE TO ANOTHER EQUALLY COMPLEX POSITION AFTER ACHIEVING POTENTIAL", "THE EMPLOYEE IS ON THE RIGHT TRACK, BUT IT IS NECESSARY TO TURN THE POTENTIAL INTO PERFORMANCE, TO DESERVE THE GROWTH AND RECOGNITION. ONCE AGAIN, THE IMPORTANCE OF THE LEADER’S FOLLOW-UP AND GUIDANCE IS HUGE.");
            } else if ($prpValor == 4 || $prpValor == 5) {
                return $this->reporteGetNineBoxReturn("B8", "B8 POSSIBLE CHANGE TO ANOTHER POSITION WITH THE SAME LEVEL OF COMPLEXITY", "THE EMPLOYEE HAS HIGH PERFORMANCE AND AVERAGE POTENTIAL. THIS MEANS THAT, BESIDES BEING RECOMMENDED TO PROVIDE THE EMPLOYEE WITH SALARY RECOGNITION, AS PART OF A POSITION AND SALARY PLAN, THERE MAY BE A POSITIONAL CHANGE, SUCH AS TRANSFERRING THE EMPLOYEE TO ANOTHER POSITION WITH THE SAME LEVEL OF COMPLEXITY.");
            }
        } else {
            if ($prpValor == 1 || $prpValor == 2) {
                return $this->reporteGetNineBoxReturn("B1", "B1 MAINTAINING THE EMPLOYEE IS AT RISK", "THE LEADERSHIP MUST INVEST ON VERY CLOSE FOLLOW-UP AND TRAINING TO THE EMPLOYEE, BEING ATTENTIVE TO ANY SIGNS OF EVOLUTION. IF NO EVOLUTION IS PRESENTED, THE EMPLOYEE MUST BE FIRED. MAYBE THE EMPLOYEE IS ON THE WRONG POSITION. ANALYZE THE POSSIBILITY AND REPLACE HIM/HER.");
            } else if ($prpValor == 3) {
                return $this->reporteGetNineBoxReturn("B4", "B4 AN GOOD EXPERT AT THE POSITION", "THIS EMPLOYEE IS FOCUSED ON THE EXECUTION OF HIS/HER ACTIVITIES, BUT HAS LITTLE POTENTIAL TO GROW. HERE, IT IS IMPORTANT TO BE ATTENTIVE TO THE EMPLOYEE’S AMBITION TO GROW. IF HE/SHE HAS AMBITION, BUT NO ACTION, THAT MAY BECOME A PROBLEM DUE TO HIS/HER AVERAGE PERFORMANCE AND LOW POTENTIAL. HIGH AMBITION + LOW POTENTIAL = FRUSTRATION. THE MANAGER MUST FOLLOW UP THE EMPLOYEE IN THIS CASE.");
            } else if ($prpValor == 4 || $prpValor == 5) {
                return $this->reporteGetNineBoxReturn("B7", "B7 SPECIALIST IN CRITICAL SITUATION", "SIMILAR TO B4, WE HAVE A TASK-ORIENTED EMPLOYEE, WHO DOES NOT HAVE A HIGH PERFORMANCE AND IT IS PROBABLY DIFFICULT TO REPLACED HIM/HER. SINCE HIS/HER POTENTIAL IS LOW, HIS/HER MANAGER MUST BE ATTENTIVE TO IDENTIFY THE FACTORS THAT KEEP HIM/HER MOTIVATED. IT IS RECOMMENDED TO PROVIDE THE EMPLOYEE WITH SALARY RECOGNITION, AS PART OF A POSITION AND SALARY PLAN, BUT NOT THE CHANGE TO A MORE COMPLEX ROLE.");
            }
        }
        throw new WarningException("Los valores especificados no son válidos");
    }

    private function reporteGetNineBoxReturn($valor, $titulo, $descripcion) {
        $nineBox = new stdClass();
        $nineBox->valor = $valor;
        $nineBox->titulo = $titulo;
        $nineBox->descripcion = $descripcion;
        return $nineBox;
    }
    
    public function updateComentario($evaluacionId, $comentario){
        return Evaluacion::create()->updateComentario($evaluacionId, $comentario);
    }
    
    public function graficoGetTotal($usuarioId, $anioId) {
        $nineBox = $this->graficoGetTotalRecursive($usuarioId, $anioId);
        if (ObjectUtil::isEmpty($nineBox)){
            throw new WarningException("No se encontraron valores");
        }else{
            return $this->graficoGetInmediatoResponse($nineBox);
        }
    }
    public function graficoGetTotalRecursive($usuarioId, $anioId){
        $nineBox = Evaluacion::create()->graficoGetInmediato($usuarioId, $anioId);
        foreach ($nineBox as $nBItem) {
            $nineBoxHijos = $this->graficoGetTotalRecursive($nBItem['usuario_id'], $anioId);
            $nineBox = $this->graficoGetTotalAdd($nineBox, $nineBoxHijos);
        }
        return $nineBox;
    }
    private function graficoGetTotalAdd($nineBox, $nineBoxHijos){
        foreach($nineBoxHijos as $hijo){
            array_push($nineBox, $hijo);
        }
        return $nineBox;
    }
    
    public function graficoGetInmediato($usuarioId, $anioId){
        // obtenemos los valores de base de datos
        $nineBox = Evaluacion::create()->graficoGetInmediato($usuarioId, $anioId);
        if (ObjectUtil::isEmpty($nineBox)){
            throw new WarningException("No se encontraron valores");
        }else{
            return $this->graficoGetInmediatoResponse($nineBox);
        }
    }
    private function graficoGetInmediatoResponse($nineBox){
        $usuariosTotal = count($nineBox); // Numero total de usuarios a cargo
        $usuariosFaltantes = array();
        $response = array();
        foreach($nineBox as $itemBox){
            if (ObjectUtil::isEmpty($itemBox["evaluacion_valor"]) || ObjectUtil::isEmpty($itemBox["prp_valor"])){
                array_push($usuariosFaltantes, $itemBox["cod_ad"]);
            }else{
                $valor = $this->reporteGetNineBox($itemBox["evaluacion_valor"], $itemBox["prp_valor"]);
                $response = $this->grafigoGetInmediatoArray($response, $valor->valor, $itemBox["usuario_id"], $itemBox["cod_ad"]);
            }
        }
        $response = ObjectUtil::arrayOrderBy($response, 'valor', SORT_ASC);
        $responseFinal = new stdClass();
        $responseFinal->usuariosTotal = $usuariosTotal;
        $responseFinal->usuariosFaltantes = $usuariosFaltantes;
        $responseFinal->nineBox = $response;
        return $responseFinal;
    }
    private function grafigoGetInmediatoArray($response, $valor, $usuarioId, $usuarioCodAd){
        if (ObjectUtil::isEmpty($response)){
            array_push($response, $this->grafigoGetInmediatoArrayObjectNew($valor, $usuarioId, $usuarioCodAd));
            return $response;
        }else{
            $actualizo = false;
            foreach($response as $index=>$itemResponse){
                if ($itemResponse["valor"] == $valor){
                    $response[$index]["cantidad"] += 1;
                    array_push($response[$index]["usuarios"], array("id" => $usuarioId, "cod_ad"=>$usuarioCodAd));
                    $actualizo = true;
                    break;
                }
            }
            if(!$actualizo){
                array_push($response, $this->grafigoGetInmediatoArrayObjectNew($valor, $usuarioId, $usuarioCodAd));
            }
            return $response;
        }   
    }
    private function grafigoGetInmediatoArrayObjectNew($valor, $usuarioId, $usuarioCodAd){
        $usuarios = array();
        array_push($usuarios, array("id" => $usuarioId, "cod_ad"=>$usuarioCodAd));
//        $nineBox = new stdClass();
//        $nineBox->valor = $valor;
//        $nineBox->usuarios = $usuarios;
//        $nineBox->cantidad = 1;
//        $nineBox = new stdClass();
        $nineBox = array();
        $nineBox["valor"] = $valor;
        $nineBox["usuarios"] = $usuarios;
        $nineBox["cantidad"] = 1;
        return $nineBox;
    }
}
