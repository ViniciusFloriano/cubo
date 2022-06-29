<?php
    include_once '../conf/Conexao.php';
    require_once '../conf/conf.inc.php';
    require_once "quadrado.class.php";
    class Cubo extends Quadrado{
        private $idcubo;
        private $cor;
        private $cor2;
        private $cor3;
        private $cor4;
        private $cor5;
        private $cor6;
        private static $contador;

        public function __construct($idcubo, $id, $lado, $cor, $cor2, $cor3, $cor4, $cor5, $cor6) {
            parent::__construct($id, $lado, '', '');
            $this->setidcubo($idcubo);
            $this->setcor($cor);
            $this->setcor2($cor2);
            $this->setcor3($cor3);
            $this->setcor4($cor4);
            $this->setcor5($cor5);
            $this->setcor6($cor6);
            self::$contador = self::$contador + 1;
        }

        public function getidcubo(){ 
            return $this->idcubo; 
        }

        public function setidcubo($idcubo){ 
            $this->idcubo = $idcubo;
        }      

        public function getcor() {
            return $this->cor;
        }

        public function setcor($cor) {
            if (strlen($cor) > 0)    
                $this->cor = $cor;
        }

        public function getcor2() {
            return $this->cor2;
        }

        public function setcor2($cor2) {
            if (strlen($cor2) > 0)    
                $this->cor2 = $cor2;
        }

        public function getcor3() {
            return $this->cor3;
        }

        public function setcor3($cor3) {
            if (strlen($cor3) > 0)    
                $this->cor3 = $cor3;
        }

        public function getcor4() {
            return $this->cor4;
        }

        public function setcor4($cor4) {
            if (strlen($cor4) > 0)    
                $this->cor4 = $cor4;
        }

        public function getcor5() {
            return $this->cor5;
        }

        public function setcor5($cor5) {
            if (strlen($cor5) > 0)    
                $this->cor5 = $cor5;
        }

        public function getcor6() {
            return $this->cor6;
        }

        public function setcor6($cor6) {
            if (strlen($cor6) > 0)    
                $this->cor6 = $cor6;
        }

        public function __toString() {
            return  "[Cubo]<br>Id do Quadrado: ".$this->getid()."<br>".
                    "Id do Cubo: ".$this->getidcubo()."<br>".
                    "Cor 1: ".$this->getcor()."<br>".
                    "Cor 2: ".$this->getcor2()."<br>".
                    "Cor 3: ".$this->getcor3()."<br>".
                    "Cor 4: ".$this->getcor4()."<br>".
                    "Cor 5: ".$this->getcor5()."<br>".
                    "Cor 6: ".$this->getcor6()."<br>".
                    "Área do cubo: ".round($this->Areacubo(),2)." metros²<br>".
                    "Perimetro do cubo: ".round($this->Perimetrocubo(),2)."<br>".
                    "Diagonal do cubo: ".round($this->Diagonalcubo(),2)."<br>".
                    "Volume do cubo: ".round($this->Volumecubo(),2)."<br>".
                    "Contador: ".self::$contador."<br>";
        }

        public function Areacubo() {
            $area = 6 * pow($this->getLado(),2);
            return $area;
        }

        public function Perimetrocubo() {
            $perimetro = $this->getLado() * 12;
            return $perimetro;
        }

        public function Diagonalcubo() {
            $diagonal = $this->getLado() * sqrt(3);
            return $diagonal;
        }

        public function Volumecubo() {
            $volume = pow($this->getLado(),3);
            return $volume;
        }
        
        public function inserir(){
            $sql = 'INSERT INTO recuperacao.cubo (cor, idquadrado, cor2, cor3, cor4, cor5, cor6) 
            VALUES(:cor, :idquadrado, :cor2, :cor3, :cor4, :cor5, :cor6)';
            $parametros = array(":cor"=>$this->getCor(), 
                                ":idquadrado"=>$this->getId(),
                                ":cor2"=>$this->getCor2(),
                                ":cor3"=>$this->getCor3(),
                                ":cor4"=>$this->getCor4(),
                                ":cor5"=>$this->getCor5(),
                                ":cor6"=>$this->getCor6());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM recuperacao.cubo WHERE idcubo = :idcubo';
            $parametros = array(":idcubo"=>$this->getidcubo());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE recuperacao.cubo 
            SET cor = :cor, idquadrado = :idquadrado, cor2 = :cor2, cor3 = :cor3, cor4 = :cor4, cor5 = :cor5, cor6 = :cor6
            WHERE idcubo = :idcubo';
            $parametros = array(":cor"=>$this->getCor(),
                                ":idquadrado"=>$this->getId(),
                                ":cor2"=>$this->getCor2(),
                                ":cor3"=>$this->getCor3(),
                                ":cor4"=>$this->getCor4(),
                                ":cor5"=>$this->getCor5(),
                                ":cor6"=>$this->getCor6(),
                                ":idcubo"=>$this->getidcubo());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM cubo";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE idcubo like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE cor like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE idquadrado like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE cor2 like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE cor3 like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " WHERE cor4 like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(7): $sql .= " WHERE cor5 like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(8): $sql .= " WHERE cor6 like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public function divisao(){
            return $this->getlado() / 2;
        }

        public function magica(){
            return $this->getlado() / 3;
        }

        public function desenha(){
            $str = "<div style='width: ".$this->getlado()."px; height: ".$this->getlado()."px; animation: rotate 10s infinite alternate; transform-style: preserve-3d;'>
                        <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->getlado()."px; height: ".$this->getlado()."px; 
                        position: absolute; transform: translateZ(".$this->divisao()."px);'>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor().", ".$this->getcor()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateY(90deg) translateZ(".$this->divisao()."px);'>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor2().", ".$this->getcor2()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>    
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateY(180deg) translateZ(".$this->divisao()."px);'>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor3().", ".$this->getcor3()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateY(-90deg) translateZ(".$this->divisao()."px);'>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor4().", ".$this->getcor4()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>    
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateX(90deg) translateZ(".$this->divisao()."px);'>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor5().", ".$this->getcor5()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>   
                        </div>
                        <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->getlado()."px; height: ".$this->getlado()."px; 
                            position: absolute; transform: rotateX(-90deg) translateZ(".$this->divisao()."px);'>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:33%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>
                            <div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:0%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:33%; transform: translateZ(".$this->divisao()."px);'></div>
                                <div style='background: linear-gradient(45deg, ".$this->getcor6().", ".$this->getcor6()."); border: 2px solid black; display: flex; width: ".$this->magica()."px; height: ".$this->magica()."px; 
                                    position: absolute; top:66.3%; right:66.3%; transform: translateZ(".$this->divisao()."px);'></div>
                            </div>  
                        </div>
                    </div><br><br><br>";
            return $str;
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Conexao::getInstance();
            $sql= "SELECT $rows FROM cubo";
            if($where != null) {
                $sql .= " WHERE $where";
                if($search != null) {
                    if(is_numeric($search) == false) {
                        $sql .= " LIKE '%". trim($search) ."%'";
                    } else if(is_numeric($search) == true) {
                        $sql .= " <= '". trim($search) ."'";
                    }
                }
            }
            if($order != null) {
                $sql .= " ORDER BY $order";
            }
            if($group != null) {
                $sql .= " GROUP BY $group";
            }
            $sql .= ";";
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>