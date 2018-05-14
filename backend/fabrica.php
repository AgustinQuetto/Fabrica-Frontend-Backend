<?php
    require_once 'empleado.php';
    require_once 'interfaces.php';
    
    class Fabrica 
    {
        private $_cantidadMaxima;
        private $_empleados=array();
        private $_razonSocial;

        public function __construct($razonSocial,$cantidadMaxima=5)
        {
            $this->_cantidadMaxima=$cantidadMaxima;
            $this->_empleados=array();
            $this->_razonSocial=$razonSocial;
        }

        public function AgregarEmpleado($empleado)
        {
            if(count($this->_empleados)<$this->_cantidadMaxima)
            {
                array_push($this->_empleados,$empleado);
                $this->EliminarEmpleadosRepetidos();
                return true;
            }
            return false;
        }

        public function CalcularSueldos()
        {
            $sueldos=0;
            foreach($this->_empleados as $empleado)
            {
                $sueldos += $empleado->GetSueldo();
            }
            return $sueldos;
        }

        public function EliminarEmpleado($empleado)
        {
            $index = array_search($empleado,$this->_empleados);
            if($index != false)
            {
                unset($this->_empleados[$index]);
                return true;
            }
            return false;
        }
        
        public function EliminarEmpleadoPorLegajo($legajo)
        {
            foreach($this->_empleados as $key => $value) {
                if($value->GetLegajo() === $legajo) {
                    unset($this->_empleados[$key]);
                    return true;
                }
            }
        }  

        public function EliminarEmpleadosRepetidos()
        {
            if(count($this->_empleados)>=2)
            {
                $this->_empleados = array_unique($this->_empleados);
            }
        }

        public function ToString()
        {
            $stringRetorno=$this->_razonSocial.' -  Cantidad Maxima de Empleados: '.$this->_cantidadMaxima.' - Cantidad Actual de Empleados:  '.count($this->_empleados).'</br>';
            foreach($this->_empleados as $empleado)
            {
                $stringRetorno = $stringRetorno.'</br>'.$empleado->ToString();
            }
            return $stringRetorno;
        }

        public function GetEmpleados()
        {
            return $this->_empleados;
        }

        public function GuardarEnArchivo($rutaArchivo) {
            $elArchivo = fopen($rutaArchivo,'w');
            $auxString = '';
            foreach($this->_empleados as $unEmpleado)
            {
                $auxString .= $unEmpleado->ToString().PHP_EOL;
            }
            if(!fwrite($elArchivo, $auxString))
            {
                fclose($elArchivo);
                return false;
            }
            fclose($elArchivo);        
            return true;
        }

        public function TraerDeArchivo($rutaArchivo = '../archivos/empleados.txt')
        {
            $elArchivo = fopen($rutaArchivo,'r');
            while(!feof($elArchivo))
            {
                $empleadoString = trim(fgets($elArchivo));
                if($empleadoString != '')
                {
                    $datoEmpleado = explode(' - ',$empleadoString);
                    $empleado = new Empleado($datoEmpleado[0],$datoEmpleado[1],$datoEmpleado[2],$datoEmpleado[3],$datoEmpleado[4],$datoEmpleado[5],$datoEmpleado[6]);
                    $empleado->SetPathFoto($datoEmpleado[7]);
                    $this->AgregarEmpleado($empleado);
                }
            }
            fclose($elArchivo);
        }

        public function TraerDeArchivoPorDni($rutaArchivo = '../archivos/empleados.txt', $dni)
        {
            $elArchivo = fopen($rutaArchivo,'r');
            while(!feof($elArchivo))
            {
                $empleadoString = trim(fgets($elArchivo));
                if($empleadoString != '')
                {
                    $datoEmpleado = explode(' - ',$empleadoString);
                    if ($datoEmpleado[2] == $dni) {
                        fclose($elArchivo);
                        return $datoEmpleado;
                    }
                }
            }
            fclose($elArchivo);
        }
    }
?>