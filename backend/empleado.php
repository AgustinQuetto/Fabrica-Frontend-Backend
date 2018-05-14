<?php
    require_once 'persona.php';

    class Empleado extends Persona
    {
        protected $_legajo;
        protected $_sueldo;
        protected $_turno;
        protected $_pathFoto;
        
        public function __construct($apellido,$nombre,$dni,$sexo,$legajo,$sueldo,$turno)
        {
            parent::__construct($apellido,$nombre,$dni,$sexo);
            $this->_legajo=$legajo;
            $this->_sueldo=$sueldo;
            $this->_turno=$turno;
            $this->_pathFoto = null;
        }

        public function GetLegajo()
        {
            return $this->_legajo;
        }

        public function GetSueldo()
        {
            return $this->_sueldo;
        }

        public function GetTurno()
        {
            return $this->_turno;
        }

        public function GetPathFoto()
        {
            return $this->_pathFoto;
        }

        public function SetPathFoto($pathFoto)
        {
            $this->_pathFoto=$pathFoto;
        }

        public function Hablar($idioma)
        {
            return 'El empleado habla '.$idioma;
        }

        public function ToString()
        {
            return parent::ToString().' - '.$this->_legajo.' - '.$this->_sueldo.' - '.$this->_turno.' - '.$this->_pathFoto;
        }

        public function __toString() {
            return $this->ToString();
        }
    }
?>