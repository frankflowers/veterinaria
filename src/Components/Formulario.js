import React,{Fragment,useState} from 'react';
import  shortid  from 'shortid';
import PropTypes from "prop-types";
const Formulario = ({crearCita}) => {
    //Crear state de citas
    const[cita,actualizarCita] = useState({

        mascota: '',
        Propietario:'',
        Fecha:'',
        hora:'',
        Sintomas:''
    });
    const [error,actualizarError] =useState (false)

//funcion que se ejecuta cada que el usuario escribe en un input
const actualizarState = e => {
    actualizarCita({
        ...cita,

[e.target.name]: e.target.value

    })
}
//Extraer valores
const {mascota,Propietario,Fecha,hora,Sintomas}= cita;
// Cuando el usuario presiona agregar cita
const submitCita= e=>{
e.preventDefault();
  
    //validar
if(mascota.trim()=== '' ||Propietario.trim()=== ''|| Fecha.trim()=== ''|| hora.trim()=== '' || 
Sintomas.trim()=== '' ){

    actualizarError(true);
    return;
}
//Eliminar el mensaje previo
actualizarError(false);

    //asignar un ID
    cita.id = shortid();
   


    //crear la cita
    crearCita(cita);
    //Reiniciar el form
    actualizarCita({
        mascota: '',
        Propietario:'',
        Fecha:'',
        hora:'',
        Sintomas:''
    })
}

    return (  
  <Fragment>
    <h2>Crear Cita</h2>
    {error ? <p className= 'alerta-error'>Todos los campos son Obligatorios</p>  
     : null}
    <form
    onSubmit={submitCita}
    
    >
        <label>Nombre Mascota</label>
        <input
        type = "text"
        name = "mascota" 
        className= "u-full-width"
        placeholder = "Nombre Mascota"
        onChange= {actualizarState}
        value={mascota}
        />
        <label>Nombre Dueño</label>
        <input
        type = "text"
        name = "Propietario" 
        className= "u-full-width"
        placeholder = "Nombre del Dueño de la Mascota"
        onChange= {actualizarState}
        value={Propietario}
       />
             <label>Fecha</label>
        <input
        type = "date"
        name = "Fecha" 
        className= "u-full-width"
        onChange= {actualizarState}
        value={Fecha}
        />
         <label>Hora</label>
        <input
        type = "time"
        name = "hora" 
        className= "u-full-width"
        onChange= {actualizarState}
        value={hora}
       
        />
         <label>Sintomas</label>
        <textarea
        className= "u-full-width"
        name="Sintomas"
        onChange= {actualizarState}
        value={Sintomas}
        ></textarea>
        <button
        type="submit"
        className= "u-full-width button-primary"
       
       >Agregar Cita</button>
        </form>
    </Fragment>
    );
}
Formulario.propTypes ={
    crearCita:PropTypes.func.isRequired
}
export default Formulario;