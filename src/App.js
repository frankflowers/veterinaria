import React,{Fragment,useState,useEffect} from 'react';

import  Formulario  from "./Components/Formulario";
import  Cita  from "./Components/Cita";
function App() {
//citas en local storage
let citasInciales = JSON.parse(localStorage.getItem('citas'));
if(!citasInciales){

  citasInciales=[];
}
//arreglo de citas
const [citas,guardarCitas]= useState(citasInciales);
//use effec para realizar citas
useEffect(() => {
  let citasInciales = JSON.parse(localStorage.getItem('citas'));
if(citasInciales){
  localStorage.setItem('citas',JSON.stringify(citas))
}else{
  localStorage.setItem('citas',JSON.stringify([]));
}


},[citas]); 




  //funcion que tome las citas actuales y agregue la nueva
  const crearCita = cita=> {
guardarCitas([ ...citas,cita]);
  
  }
  
const eliminarCita = id =>{
  const nuevasCitas = citas.filter(cita =>cita.id !== id)
guardarCitas(nuevasCitas);
}
  
const titulo = citas.length === 0 ? 'No hay citas ' : 'Administra tus citas';

  return (
    <Fragment>
    <h1>Administrador de Pacientes</h1>
 <div className= 'container'>
    <div className="row">
      <div className= "one-half column">
        <Formulario
        crearCita={crearCita}
        />
      </div>
      <div className='one-half column'>
        <h2>{titulo}</h2>
        {citas.map(cita=>(
          <Cita
          key={cita.id}
          cita={cita}
          eliminarCita = {eliminarCita}

          />
        ))}
        </div>
    </div>
 </div>
 </Fragment>
    );
}

export default App;
