import React from 'react';
import PropTypes from "prop-types";
const Cita = ({cita,eliminarCita}) => (
    <div className='cita'>
        <p>Mascota:<span>{cita.mascota}</span> </p>
        <p>Dueño:<span>{cita.Propietario}</span> </p>
        <p>Fecha:<span>{cita.Fecha}</span> </p>
        <p>Hora:<span>{cita.hora}</span> </p>
        <p>Sintomas:<span>{cita.Sintomas}</span> </p>
  <button
      className= "button eliminar u-full-width"
       onClick={()=>eliminarCita(cita.id)}
       >Eliminar &times;  </button>

    </div>
);
 Cita.propTypes={
     cita: PropTypes.func.isRequired
 }
export default Cita;