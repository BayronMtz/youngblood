<?php
/*
*	Clase para manejar la tabla clientes de la base de datos. Es clase hija de Validator.
*/
class Clientes extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombres = null;
    private $apellidos = null;
    private $correo = null;
    private $telefono = null;
    private $dui = null;
    private $nacimiento = null;
    private $direccion = null;
    private $usuario = null;
    private $clave = null;
    private $alias = null;
    private $estado = null; // Valor por defecto en la base de datos: true

    /*
    *   Métodos para validar y asignar valores de los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombres = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDUI($value)
    {
        if ($this->validateDUI($value)) {
            $this->dui = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAlias($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->alias = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNacimiento($value)
    {
        if ($this->validateDate($value)) {
            $this->nacimiento = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccion($value)
    {
        if ($this->validateString($value, 1, 200)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getDUI()
    {
        return $this->dui;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    /*
    *   Métodos para gestionar la cuenta del cliente.
    */

    //Consulta para grafica de clientes registrados en el ultimo semestre por mes
    public function clienteMes()
    {
        $sql = 'SELECT COUNT(id_cliente) as cantidad, EXTRACT(MONTH FROM fecha_registro) as mes FROM clientes
                GROUP BY mes ORDER BY mes ASC LIMIT 6';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Consulta para obtener a los menores de edad (Personas nacidas despues del 2004-01-01)
    public function menoresEdad()
    {
        $sql = 'SELECT COUNT(id_cliente) as menoresEdad FROM clientes WHERE nacimiento_cliente > \'2004-01-01\'';
        $params = null;
        return Database::getRow($sql, $params);
    }

    //Consulta para obtener a los mayores de edad (Personas nacidas antes del 2003-12-31)
    public function mayoresEdad()
    {
        $sql = 'SELECT COUNT(id_cliente) as mayoresEdad FROM clientes WHERE nacimiento_cliente < \'2003-12-31\'';
        $params = null;
        return Database::getRow($sql, $params);
    }

    public function checkUser($correo)
    {
        $sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, estado_cliente, alias_usuario FROM clientes WHERE correo_cliente = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_cliente'];
            $this->estado = $data['estado_cliente'];
            $this->usuario = $data['alias_usuario'];
            $this->nombres = $data['nombres_cliente'];
            $this->apellidos = $data['apellidos_cliente'];
            $this->correo = $correo;
            return true;
        } else {
            return false;
        }
    }

    public function readProfile()
    {
        $sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente, alias_usuario 
                FROM clientes 
                WHERE id_cliente = ?';
        $params = array($_SESSION['id_cliente']);
        return Database::getRow($sql, $params);
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT clave_cliente FROM clientes WHERE id_cliente = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['clave_cliente'])) {
            return true;
        } else {
            return false;
        }
    }

    //Registrar dispositivo
    public function registerDevice()
    {
        $sql = 'INSERT INTO dispositivos_cliente(dispositivo, fecha, hora, id_cliente) VALUES (?,current_date,current_time,?)';
        $params = array(php_uname(), $_SESSION['id_cliente']);
        return Database::executeRow($sql, $params);
    }

    //Verificar si el dispositivo ya existe
    public function checkDevice()
    {
        $sql = 'SELECT*FROM dispositivos_cliente WHERE dispositivo = ? AND id_cliente = ?';
        $params = array(php_uname(), $_SESSION['id_cliente']);
        return Database::getRow($sql, $params);
    }

    //Obtener las sesiones de un dispositivo
    public function getDevices()
    {
        $sql = 'SELECT*FROM dispositivos_cliente WHERE id_cliente = ?';
        $params = array($_SESSION['id_cliente']);
        return Database::getRows($sql, $params);
    }

    //Carga los intentos fallidos
    public function readFails()
    {
        $sql = 'SELECT*FROM bitacora WHERE id_cliente = ?';
        $params = array($_SESSION['id_cliente']);
        return Database::getRows($sql, $params);
    }

    //Cuenta los intentos fallidos
    public function countFails()
    {
        $sql = 'SELECT COUNT(id_bitacora) as intentos FROM bitacora WHERE id_cliente = ?';
        $params = array($_SESSION['id_cliente']);
        return Database::getRow($sql, $params);
    }

    //Actualizar preferencia del usuario
    public function updateAuth($value)
    {
        $sql = 'UPDATE clientes SET dobleverificacion = ? WHERE id_cliente = ?';
        $params = array($value, $_SESSION['id_cliente']);
        return Database::executeRow($sql, $params);
    }

    //Capturar preferencia del usuario
    public function checkAuth()
    {
        $sql = 'SELECT dobleverificacion FROM clientes WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function changePassword()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE clientes SET clave_cliente = ? WHERE id_cliente = ?';
        $params = array($hash, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE clientes
                SET nombres_cliente = ?, apellidos_cliente = ?, correo_cliente = ?, dui_cliente = ?, telefono_cliente = ?, nacimiento_cliente = ?, direccion_cliente = ?, alias_usuario = ?
                WHERE id_cliente = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->dui, $this->telefono, $this->nacimiento, $this->direccion, $this->usuario, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function editProfile2()
    {
        $sql = 'UPDATE clientes
                SET nombres_cliente = ?, apellidos_cliente = ?, correo_cliente = ?, alias_usuario = ?
                WHERE id_cliente = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $_SESSION['id_cliente']);
        return Database::executeRow($sql, $params);
    }

    public function changeStatus()
    {
        $sql = 'UPDATE clientes
                SET estado_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente, dui_cliente, telefono_cliente, nacimiento_cliente, direccion_cliente
                FROM clientes
                WHERE apellidos_cliente ILIKE ? OR nombres_cliente ILIKE ? OR correo_cliente ILIKE ?
                ORDER BY apellidos_cliente';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO clientes(nombres_cliente, apellidos_cliente, correo_cliente, dui_cliente, telefono_cliente, nacimiento_cliente, direccion_cliente, clave_cliente, fecha_registro, alias_usuario,intentos,fecha_clave,dobleverificacion)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, current_date, ?,?,current_date, ?)';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->dui, $this->telefono, $this->nacimiento, $this->direccion, $hash, $this->usuario,0, 'no');
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente, dui_cliente, telefono_cliente, nacimiento_cliente, direccion_cliente, alias_usuario
                FROM clientes
                ORDER BY apellidos_cliente';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente, dui_cliente, telefono_cliente, nacimiento_cliente, direccion_cliente, estado_cliente, alias_usuario
                FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE clientes
                SET nombres_cliente = ?, apellidos_cliente = ?, dui_cliente = ?, estado_cliente = ?, telefono_cliente = ?, nacimiento_cliente = ?, direccion_cliente = ?, alias_usuario = ?
                WHERE id_cliente = ?';
        $params = array($this->nombres, $this->apellidos, $this->dui, $this->estado, $this->telefono, $this->nacimiento, $this->direccion, $this->usuario, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function verificarEstado(){
        if ($this->estado == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarIntentos(){
        $sql = 'SELECT intentos
        FROM clientes
        WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function actualizarIntentos($intentos)
    {
        $sql = 'UPDATE clientes 
                SET intentos = ?
                WHERE id_cliente = ?';
        $params = array($intentos, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function actualizarEstado($estado)
    {
        $sql = 'UPDATE clientes
                SET estado_cliente = ?
                WHERE id_cliente = ?';
        $params = array($estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function accionCliente($observacion)
    {
        $sql = 'INSERT INTO bitacora(id_cliente,fecha,hora,observacion) 
                VALUES(?,current_date,current_time,?)';
        $params = array($this->id, $observacion);
        return Database::executeRow($sql, $params);
    }

    public function verificar90dias(){
        $sql = 'SELECT fecha_clave FROM clientes 
                WHERE id_cliente = ? AND fecha_clave > (SELECT current_date - 90)';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function changePasswordOut()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE clientes SET clave_cliente = ? WHERE id_cliente = ?';
        $params = array($hash, $_SESSION['id_cliente_tmp']);
        return Database::executeRow($sql, $params);
    }

    public function actualizarFecha()
    {
        $sql = 'UPDATE clientes 
                SET fecha_clave = current_date
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function checkEmail()
    {
        $sql = 'SELECT correo_cliente,id_cliente FROM clientes WHERE correo_cliente = ?';
        $params = array($this->correo);
        return Database::getRow($sql, $params);
    }
}
